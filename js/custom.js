/******************************************
    File Name: custom.js
    Template Name: Aven
/****************************************** */

(function($) {
    "use strict";

    /* ==============================================
    AFFIX
    =============================================== */
    $('.megamenu').affix({
        offset: {
            top: 800,
            bottom: function() {
                return (this.bottom = $('.footer').outerHeight(true))
            }
        }
    })

    /* ==============================================
    BACK TOP
    =============================================== */
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 1) {
            jQuery('.dmtop').css({
                bottom: "75px"
            });
        } else {
            jQuery('.dmtop').css({
                bottom: "-100px"
            });
        }
    });

    /* ==============================================
       LOADER -->
        =============================================== */

    $(window).load(function() {
        $("#preloader").on(500).fadeOut();
        $(".preloader").on(600).fadeOut("slow");
    });

    /* ==============================================
     FUN FACTS -->
     =============================================== */

    function count($this) {
        var current = parseInt($this.html(), 10);
        current = current + 50; /* Where 50 is increment */
        $this.html(++current);
        if (current > $this.data('count')) {
            $this.html($this.data('count'));
        } else {
            setTimeout(function() {
                count($this)
            }, 30);
        }
    }
    $(".stat_count, .stat_count_download").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

    /* ==============================================
     TOOLTIP -->
     =============================================== */
    $('[data-toggle="tooltip"]').tooltip()
    $('[data-toggle="popover"]').popover()

    /* ==============================================
     CONTACT -->
     =============================================== */
    jQuery(document).ready(function() {
        $('#customContactForm, #headerCustomContactForm').submit(function(e) {
            e.preventDefault();
            
            $('.contact_form').find('#message, #messageAlert').each(function () {
                $(this).slideUp('slow');
            });
    
            const formBlock = $(this).closest('.contact_form');
            const formData = {
                csrf_token: formBlock.find('#csrf_token').val(),
                first_name: formBlock.find('#first_name').val().trim(),
                last_name: formBlock.find('#last_name').val().trim(),
                email: formBlock.find('#email').val().trim(),
                phone: formBlock.find('#phone').val().trim(),
                select_service: formBlock.find('#select_service').val() || '',
                select_price: formBlock.find('#select_price').val() || '',
                comments: formBlock.find('#comments').val() || '',
            };
            
            const commentsField = formBlock.find('#comments');
            if (commentsField.length) {
                formData.comments = commentsField.val().trim();
            }
    
            const validationResult = validateForm(formData);
            if (!validationResult.isValid) {
                formBlock.find('#message').html(validationResult.errors.join('<br>')).slideDown('slow');
                return;
            }
    
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    const parsedResponse = JSON.parse(response);
    
                    if (!parsedResponse.success) {
                        if (parsedResponse.errors) {
                            formBlock.find('#message').html(parsedResponse.errors.join('<br>')).slideDown('slow');
                        }
                    } else {
                        formBlock.find('#messageAlert').text(parsedResponse.message);
                        formBlock.find('#messageAlert').slideDown('slow');

                        const urlParams = new URLSearchParams(window.location.search);
                        const ggl = urlParams.get('ggl');
                        const fbp = urlParams.get('fbp');

                        if (ggl) {
                            if (window.gtag) {
                                gtag('event', 'form_submission', {
                                    'event_category': 'Form',
                                    'event_label': 'Google Analytics',
                                    'value': 1
                                });
                            }
                        }

                        if (fbp) {
                            if (window.fbq) {
                                fbq('track', 'Lead', {
                                    content_name: 'Form Submission',
                                    content_category: 'Lead Generation',
                                    value: 1,
                                    currency: 'USD'
                                });
                            }
                        }
                        // setTimeout(() => {
                        //     window.location.href = parsedResponse.redirect_url;
                        // }, 2000);
                    }
                },
                error: function() {
                    displayAlert(formBlock, 'Произошла ошибка при отправке данных.');
                }
            });
        });


        $('body').on('input', '#first_name, #last_name', function() {
            $(this).val($(this).val().replace(/[^a-zA-Zа-яА-Я]/g, ''));
        });
    
        $('body').on('input', '#email', function() {
            $(this).val($(this).val().replace(/[^a-zA-Z0-9@._-]/g, ''));
        });
    
        $('body').on('input', '#phone', function () {
            $(this).val($(this).val().replace(/[^0-9+]/g, ''));
        });
    
        $('body').on('click', '.btnContactModal', function() {
            $('#modalContact').fadeIn('slow');
        });
    
        $('body').on('click', '.btnCloseModal', function() {
            $('#modalContact').fadeOut('slow');
        });
    
        $('body').on('click', '.btnSendModal', function() {
            const modalContent = $(this).closest('.modal-content');
            const formData = {
                csrf_token: modalContent.find('#csrf_token').val() || '',
                first_name: modalContent.find('#first_name').val().trim(),
                last_name: modalContent.find('#last_name').val().trim(),
                email: modalContent.find('#email').val().trim(),
                phone: modalContent.find('#phone').val().trim(),
            };
    
            modalContent.find('#message, #messageAlert').slideUp('slow').empty();
    
            const validationResult = validateForm(formData);
            if (!validationResult.isValid) {
                modalContent.find('#message').html(validationResult.errors.join('<br>')).slideDown('slow');
                return;
            }
    
            $.ajax({
                url: 'server.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    try {
                        const parsedResponse = JSON.parse(response);
    
                        if (parsedResponse.success) {
                            modalContent.find('#messageAlert').text(parsedResponse.message).slideDown('slow');
                            setTimeout(() => {
                                modalContent.find('.btnCloseModal').trigger('click');
                            }, 2000);
                        } else {
                            modalContent.find('#message').html(parsedResponse.errors.join('<br>')).slideDown('slow');
                        }
                    } catch (e) {
                        modalContent.find('#message').text('Ошибка обработки ответа сервера.').slideDown('slow');
                    }
                },
                error: function() {
                    modalContent.find('#message').text('Ошибка отправки данных. Попробуйте позже.').slideDown('slow');
                }
            });
        });
    
        function validateForm(data) {
            const errors = [];
    
            if (!data.first_name) errors.push('Имя обязательно для заполнения.');
            if (!data.last_name) errors.push('Фамилия обязательна для заполнения.');
            if (!data.email) errors.push('Email обязателен для заполнения.');
            if (!data.phone) errors.push('Номер телефона обязателен для заполнения.');
    
            return {
                isValid: errors.length === 0,
                errors
            };
        }
    });

    /* ==============================================
     CODE WRAPPER -->
     =============================================== */

    $('.code-wrapper').on("mousemove", function(e) {
        var offsets = $(this).offset();
        var fullWidth = $(this).width();
        var mouseX = e.pageX - offsets.left;

        if (mouseX < 0) {
            mouseX = 0;
        } else if (mouseX > fullWidth) {
            mouseX = fullWidth
        }

        $(this).parent().find('.divider-bar').css({
            left: mouseX,
            transition: 'none'
        });
        $(this).find('.design-wrapper').css({
            transform: 'translateX(' + (mouseX) + 'px)',
            transition: 'none'
        });
        $(this).find('.design-image').css({
            transform: 'translateX(' + (-1 * mouseX) + 'px)',
            transition: 'none'
        });
    });
    $('.divider-wrapper').on("mouseleave", function() {
        $(this).parent().find('.divider-bar').css({
            left: '50%',
            transition: 'all .3s'
        });
        $(this).find('.design-wrapper').css({
            transform: 'translateX(50%)',
            transition: 'all .3s'
        });
        $(this).find('.design-image').css({
            transform: 'translateX(-50%)',
            transition: 'all .3s'
        });
    });

})(jQuery);