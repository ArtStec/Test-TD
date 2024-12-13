<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

try {
    $pdo = new PDO('sqlite:database.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $response = [
        'success' => false,
        'message' => "Ошибка подключения к базе данных: " . $e->getMessage()
    ];
    
    die(json_encode($response, JSON_UNESCAPED_UNICODE));
}

$data = $_POST;

$csrfToken = $_POST['csrf_token'] ?? '';

if (!validateCsrfToken($csrfToken)) {
    $response = [
        'success' => false,
        'message' => 'Недействительный CSRF-токен'
    ];
    logRequest($data, $response);

    ob_clean();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
} else {
    $errors = validateData($data);

    if (!empty($errors)) {
        $response = [
            'success' => false,
            'message' => implode('<br>', $errors)
        ];
        logRequest($data, $response);
        
        ob_clean();
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO orders (first_name, last_name, email, phone, select_service, select_price, comments) 
            VALUES (:first_name, :last_name, :email, :phone, :select_service, :select_price, :comments)");
        $stmt->execute([
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':phone' => $data['phone'],
            ':select_service' => $data['select_service'],
            ':select_price' => $data['select_price'],
            ':comments' => $data['comments']
        ]);

        $geoData = getGeoData($_SERVER['REMOTE_ADDR']);

        $response = [
            'success' => true,
            'message' => 'Данные успешно отправлены',
            'redirect_url' => 'thankyou.html',
            'geo' => $geoData
        ];
        
    } catch (PDOException $e) {
        $response = [
            'success' => false,
            'message' => 'Ошибка сохранения данных: ' . $e->getMessage()
        ];
    }

    logRequest($data, $response);
    
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

    ob_clean();
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

function logRequest($requestData, $responseData) {
    global $pdo;

    try {
        $stmt = $pdo->prepare("INSERT INTO logs (request_data, response_data) VALUES (:request_data, :response_data)");
        $stmt->execute([
            ':request_data' => json_encode($requestData, JSON_UNESCAPED_UNICODE),
            ':response_data' => json_encode($responseData, JSON_UNESCAPED_UNICODE)
        ]);
    } catch (PDOException $e) {
        error_log("Ошибка логирования: " . $e->getMessage());
    }
}

function validateData($data) {
    $errors = [];

    $requiredFields = [
        'first_name' => 'Имя обязательно для заполнения.',
        'last_name' => 'Фамилия обязательна для заполнения.',
        'email' => 'Email обязателен для заполнения.',
        'phone' => 'Номер телефона обязателен для заполнения.'
    ];

    foreach ($requiredFields as $field => $errorMessage) {
        if (empty($data[$field])) {
            $errors[] = $errorMessage;
        }
    }

    if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Введите корректный email.';
    }

    if (!empty($data['phone']) && !preg_match('/^\+?[0-9]{7,15}$/', $data['phone'])) {
        $errors[] = 'Введите корректный номер телефона.';
    }

    return $errors;
}

function getGeoData($ip) {
    $url = "http://ip-api.com/json/{$ip}";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response ? json_decode($response, true) : null;
}

function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}