<?php
   if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }

   $version = "1.0.0"; 

   $googleAnalyticsId = isset($_GET['ggl']) ? $_GET['ggl'] : null;
   $facebookPixelId = isset($_GET['fbp']) ? $_GET['fbp'] : null;

   if (empty($_SESSION['csrf_token'])) {
      $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
   }
?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <!-- Mobile Metas -->
   <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
   <!-- Site Metas -->
   <title>Aven - Real Estate Responsive HTML5 Landing Page Template</title>

   <?php if ($googleAnalyticsId): ?>
      <!-- Google Analytics -->
      <script async src="https://www.googletagmanager.com/gtag/js?id=<?= htmlspecialchars($_GET['ggl']) ?>"></script>
      <script>
         window.dataLayer = window.dataLayer || [];
         function gtag(){dataLayer.push(arguments);}
         gtag('js', new Date());
         gtag('config', '<?= $googleAnalyticsId ?>');
      </script>
      <!-- Google Analytics -->
   <?php endif; ?>
   <?php if ($facebookPixelId): ?>
      <!-- Facebook Pixel -->
      <script>
         !function(f,b,e,v,n,t,s)
         {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
         n.callMethod.apply(n,arguments):n.queue.push(arguments)};
         if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
         n.queue=[];t=b.createElement(e);t.async=!0;
         t.src=v;s=b.getElementsByTagName(e)[0];
         s.parentNode.insertBefore(t,s)}(window, document,'script',
         'https://connect.facebook.net/en_US/fbevents.js');
         fbq('init', '<?= $facebookPixelId ?>');
         fbq('track', 'PageView');
      </script>
      <noscript>
         <img height="1" width="1" style="display:none" 
               src="https://www.facebook.com/tr?id=<?= $facebookPixelId ?>&ev=PageView&noscript=1"/>
      </noscript>
      <!-- Facebook Pixel -->
   <?php endif; ?>

   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- Site Icons -->
   <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="css/bootstrap.min.css?v=<?= $version ?>">
   <!-- Site CSS -->
   <link rel="stylesheet" href="css/style.css?v=<?= $version ?>">
   <!-- Colors CSS -->
   <link rel="stylesheet" href="css/colors.css?v=<?= $version ?>">
   <!-- ALL VERSION CSS -->
   <link rel="stylesheet" href="css/versions.css?v=<?= $version ?>">
   <!-- Responsive CSS -->
   <link rel="stylesheet" href="css/responsive.css?v=<?= $version ?>">
   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/custom.css?v=<?= $version ?>">
   
   <link rel="stylesheet" href="css/animate.css?v=<?= $version ?>">
   <link rel="stylesheet" href="css/flaticon.css?v=<?= $version ?>">
   <link rel="stylesheet" href="css/prettyPhoto.css?v=<?= $version ?>">
   <link rel="stylesheet" href="css/owl.carousel.css?v=<?= $version ?>">
   <link rel="stylesheet" href="css/font-awesome.min.css?v=<?= $version ?>">
   <!-- Modernizer for Portfolio -->
   <script src="js/modernizer.js?v=<?= $version ?>"></script>
</head>

<body class="realestate_version">
   <!-- LOADER -->
   <div id="preloader">
      <img class="preloader" src="images/loader-realestate.gif" alt="">
   </div>
   <!-- end loader -->
   <!-- END LOADER -->
   <header class="header header_style_01">
      <nav class="megamenu navbar navbar-default" data-spy="affix">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                  aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="index-real-estate.html"><img src="images/logo.png" width="220"
                     alt="image"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
               <ul class="nav navbar-nav navbar-right">
                  <li><a data-scroll="" href="#home">Home</a></li>
                  <li><a data-scroll="" href="#features">Features <span class="hidden-xs">*</span></a></li>
                  <li><a data-scroll="" href="#agent">The Agent</a></li>
                  <li><a data-scroll="" href="#gallery">Gallery</a></li>
                  <li><a data-scroll="" href="#testimonials">Testimonials</a></li>
                  <li><a data-scroll="" href="#support">Contact</a></li>
                  <li class="social-links"><a href="#"><i class="fa fa-twitter global-radius"></i></a></li>
                  <li class="social-links"><a href="#"><i class="fa fa-facebook global-radius"></i></a></li>
                  <li class="social-links"><a href="#"><i class="fa fa-linkedin global-radius"></i></a></li>
               </ul>
            </div>
         </div>
      </nav>
   </header>

   <div class="modal" id="modalContact" style="background-color: rgba(0, 0, 0, 0.5); display: none;">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Form</h1>
            </div>
            <div class="modal-body">
               <div id="message"></div>
               <div id="messageAlert" class="alert alert-success" role="alert" style="display: none;">
               </div>
               <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
               <div class="default-inp" style="margin-top: 10px;">
                  <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name">
               </div>
               <div class="default-inp" style="margin-top: 10px;">
                  <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name">
               </div>
               <div class="default-inp" style="margin-top: 10px;">
                  <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone">
               </div>
               <div class="default-inp" style="margin-top: 10px;">
                  <input type="email" id="email" name="email" class="form-control" placeholder="Your Email">
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary btnCloseModal" data-bs-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary btnSendModal">Send</button>
            </div>
         </div>
      </div>
   </div>

   <div id="home" class="parallax first-section" data-stellar-background-ratio="0.4"
      style="background-image:url('images/parallax.jpg');">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-sm-12">
               <div class="big-tagline clearfix">
                  <h2>Sell Your Property with Aven</h2>
                  <p class="lead">With Aven responsive landing page template, you can promote your all property &amp;
                     real estate projects. </p>
                  <a data-scroll="" href="#gallery" class="btn btn-light btn-radius grd1 btn-brd">View Gallery</a>
               </div>
            </div>
            <div class="col-md-6 wow slideInRight hidden-xs hidden-sm">
               <div class="contact_form">
                  <h3><i class="fa fa-envelope-o grd1 global-radius"></i> QUICK APPOINTMENT</h3>
                  <div id="message"></div>
                  <div id="messageAlert" class="alert alert-success" role="alert" style="display: none;">
                  </div>
                  <form id="headerCustomContactForm" class="row" action="server.php" name="headerCustomContactForm" method="post">
                     <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                     <fieldset class="row-fluid">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="first_name" id="first_name" class="form-control"
                              placeholder="First Name">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="last_name" id="last_name" class="form-control"
                              placeholder="Last Name">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label class="sr-only">Select Time</label>
                           <select name="select_service" id="select_service" class="selectpicker form-control"
                              data-style="btn-white">
                              <option value="selecttime">Select Time</option>
                              <option value="Weekdays">Weekdays</option>
                              <option value="Weekend">Weekend</option>
                           </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label class="sr-only">What is max price?</label>
                           <select name="select_price" id="select_price" class="selectpicker form-control"
                              data-style="btn-white">
                              <option value="$100 - $2000">$100 - $2000</option>
                              <option value="$2000 - $4000">$2000 - $4000</option>
                              <option value="$4000 - $10000">$4000 - $10000</option>
                           </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                           <button type="submit" value="SEND" id="submit1"
                              class="btn btn-light btn-radius btn-brd grd1 btn-block">Get an Appointment</button>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
         <!-- end row -->
      </div>
      <!-- end container -->
   </div>
   <!-- end section -->
   <div id="features" class="section wb">
      <div class="container">
         <div class="section-title row text-center">
            <div class="col-md-8 col-md-offset-2">
               <small>All Awesome Property Details</small>
               <h3>Property Details</h3>
               <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non
                  aliquam risus. Sed a tellus quis mi rhoncus dignissim.</p>
            </div>
            <!-- end col -->
         </div>
         <!-- end title -->
         <div class="property-detail row clearfix">
            <div class="col-md-2 col-sm-3 col-xs-6">
               <i class="flaticon-coupon effect-1"></i>
               <h4>Square Feet : 3200</h4>
            </div>
            <!-- end col -->
            <div class="col-md-2 col-sm-3 col-xs-6">
               <i class="flaticon-family-room effect-1"></i>
               <h4>Ideal for Family</h4>
            </div>
            <!-- end col -->
            <div class="col-md-2 col-sm-3 col-xs-6">
               <i class="flaticon-house effect-1"></i>
               <h4>Garage : 2</h4>
            </div>
            <!-- end col -->
            <div class="col-md-2 col-sm-3 col-xs-6">
               <i class="flaticon-full-bed effect-1"></i>
               <h4>Bedrooms : 3</h4>
            </div>
            <!-- end col -->
            <div class="col-md-2 col-sm-3 col-xs-6">
               <i class="flaticon-swimming-pool effect-1"></i>
               <h4>Pool : Yes</h4>
            </div>
            <!-- end col -->
            <div class="col-md-2 col-sm-3 col-xs-6">
               <i class="flaticon-calendar effect-1"></i>
               <h4>Build in : 2015</h4>
            </div>
            <!-- end col -->
         </div>
         <!-- end how-its-work -->
         <hr class="invis">
         <div class="row text-center">
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="service-widget">
                  <div class="post-media wow fadeIn">
                     <a href="uploads/estate_01.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i
                           class="flaticon-unlink"></i></a>
                     <img src="images/estate_01.jpg" alt="" class="img-responsive img-rounded">
                  </div>
                  <h3>Spacious and Large Garden</h3>
                  <p>Aliquam sagittis ligula et sem lacinia, ut facilisis enim sollicitudin. Proin nisi est, convallis
                     nec purus vitae, iaculis posuere sapien. Cum sociis natoque.</p>
               </div>
               <!-- end service -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="service-widget">
                  <div class="post-media wow fadeIn">
                     <a href="uploads/estate_03.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i
                           class="flaticon-unlink"></i></a>
                     <img src="images/estate_03.jpg" alt="" class="img-responsive img-rounded">
                  </div>
                  <h3>With its Own Pool</h3>
                  <p>Duis at tellus at dui tincidunt scelerisque nec sed felis. Suspendisse id dolor sed leo rutrum
                     euismod. Nullam vestibulum fermentum erat. It nam auctor. </p>
               </div>
               <!-- end service -->
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="service-widget">
                  <div class="post-media wow fadeIn">
                     <a href="uploads/estate_02.jpg" data-rel="prettyPhoto[gal]" class="hoverbutton global-radius"><i
                           class="flaticon-unlink"></i></a>
                     <img src="images/estate_02.jpg" alt="" class="img-responsive img-rounded">
                  </div>
                  <h3>In Forests- Fresh Clean Air</h3>
                  <p>Etiam materials ut mollis tellus, vel posuere nulla. Etiam sit amet lacus vitae massa sodales
                     aliquam at eget quam. Integer ultricies et magna quis.</p>
               </div>
               <!-- end service -->
            </div>
         </div>
         <!-- end row -->
      </div>
      <!-- end container -->
      <div class="sep1"></div>
   </div>
   <!-- end section -->
   <div id="agent" class="parallax section db parallax-off">
      <div class="container">
         <div class="section-title row text-center">
            <div class="col-md-8 col-md-offset-2">
               <h3>Agent Details</h3>
               <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non
                  aliquam risus. Sed a tellus quis mi rhoncus dignissim.</p>
            </div>
            <!-- end col -->
         </div>
         <!-- end title -->
         <div class="row">
            <div class="col-md-3">
               <div class="post-media wow fadeIn">
                  <img src="images/agent.jpg" alt="" class="img-responsive img-rounded">
                  <a href="https://www.youtube.com/watch?v=nrJtHemSPW4" data-rel="prettyPhoto[gal]"
                     class="playbutton"><i class="flaticon-play-button"></i></a>
               </div>
               <!-- end media -->
            </div>
            <!-- end col -->
            <div class="col-md-6">
               <div class="message-box">
                  <h4>The Agent</h4>
                  <h2>Jenny Martines</h2>
                  <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non
                     aliquam risus. Sed a tellus quis mi rhoncus dignissim.</p>
                  <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus
                     bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis
                     parturient montes, nascetur ridiculus mus. </p>
                  <a href="#contact" data-scroll="" class="btn btn-light global-radius btn-brd grd1 effect-1">Contact
                     Me</a>
               </div>
               <!-- end messagebox -->
            </div>
            <!-- end col -->
            <div class="col-md-3">
               <div class="agencies_meta clearfix">
                  <span><i class="fa fa-envelope "></i> <a
                        href="/cdn-cgi/l/email-protection#cfbcbabfbfa0bdbb8fbca6bbaaa1aea2aae1aca0a2"><span
                           class="__cf_email__"
                           data-cfemail="11626461617e636551627865747f707c743f727e7c">[email�&nbsp;protected]</span></a></span>
                  <span><i class="fa fa-link "></i> <a href="#">www.sitename.com</a></span>
                  <span><i class="fa fa-phone-square "></i> +1 232 444 55 66</span>
                  <span><i class="fa fa-print "></i> +1 232 444 55 66</span>
                  <span><i class="fa fa-facebook-square "></i> <a href="#">facebook.com/tagline</a></span>
                  <span><i class="fa fa-twitter-square "></i> <a href="#">twitter.com/tagline</a></span>
                  <span><i class="fa fa-linkedin-square "></i> <a href="#">linkedin.com/tagline</a></span>
               </div>
               <!-- end agencies_meta -->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
   </div>
   <div id="gallery" class="section wb">
      <div class="sep2"></div>
      <div class="container">
         <div class="section-title row text-center">
            <div class="col-md-8 col-md-offset-2">
               <h3>Property Gallery</h3>
               <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non
                  aliquam risus. Sed a tellus quis mi rhoncus dignissim.</p>
            </div>
            <!-- end col -->
         </div>
         <!-- end title -->
         <div id="da-thumbs" class="da-thumbs portfolio">
            <div class="post-media pitem item-w1 item-h1 cat1">
               <a href="uploads/home_01.jpg" data-rel="prettyPhoto[gal]">
                  <img src="images/home_01.jpg" alt="" class="img-responsive">
                  <div>
                     <i class="flaticon-unlink"></i>
                  </div>
               </a>
            </div>
            <div class="post-media pitem item-w1 item-h1 cat2">
               <a href="uploads/home_02.jpg" data-rel="prettyPhoto[gal]">
                  <img src="images/home_02.jpg" alt="" class="img-responsive">
                  <div>
                     <i class="flaticon-unlink"></i>
                  </div>
               </a>
            </div>
            <div class="post-media pitem item-w1 item-h1 cat1">
               <a href="uploads/home_03.jpg" data-rel="prettyPhoto[gal]">
                  <img src="images/home_03.jpg" alt="" class="img-responsive">
                  <div>
                     <i class="flaticon-unlink"></i>
                  </div>
               </a>
            </div>
            <div class="post-media pitem item-w1 item-h1 cat3">
               <a href="uploads/home_04.jpg" data-rel="prettyPhoto[gal]">
                  <img src="images/home_04.jpg" alt="" class="img-responsive">
                  <div>
                     <i class="flaticon-unlink"></i>
                  </div>
               </a>
            </div>
            <div class="post-media pitem item-w1 item-h1 cat2">
               <a href="uploads/home_05.jpg" data-rel="prettyPhoto[gal]">
                  <img src="images/home_05.jpg" alt="" class="img-responsive">
                  <div>
                     <i class="flaticon-unlink"></i>
                  </div>
               </a>
            </div>
            <div class="post-media pitem item-w1 item-h1 cat1">
               <a href="uploads/home_06.jpg" data-rel="prettyPhoto[gal]">
                  <img src="images/home_06.jpg" alt="" class="img-responsive">
                  <div>
                     <i class="flaticon-unlink"></i>
                  </div>
               </a>
            </div>
         </div>
         <!-- end portfolio -->
      </div>
      <!-- end container -->
   </div>
   <!-- end section -->
   <div id="testimonials" class="section lb">
      <div class="container">
         <div class="section-title row text-center">
            <div class="col-md-8 col-md-offset-2">
               <h3>Happy Customers</h3>
               <p class="lead">Quisque eget nisl id nulla sagittis auctor quis id. Aliquam quis vehicula enim, non
                  aliquam risus. Sed a tellus quis mi rhoncus dignissim.</p>
            </div>
            <!-- end col -->
         </div>
         <!-- end title -->
         <div class="row">
            <div class="col-md-12 col-sm-12">
               <div class="testi-carousel owl-carousel owl-theme">
                  <div class="testimonial clearfix">
                     <div class="desc">
                        <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                        <p class="lead">They have got my project on time with the competition with a sed highly skilled,
                           and experienced &amp; professional team.</p>
                     </div>
                     <div class="testi-meta">
                        <h4>James Fernando <small>- Manager of Racer</small></h4>
                     </div>
                     <!-- end testi-meta -->
                  </div>
                  <!-- end testimonial -->
                  <div class="testimonial clearfix">
                     <div class="desc">
                        <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                        <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising
                           pain was born and I will give you completed.</p>
                     </div>
                     <div class="testi-meta">
                        <h4>Jacques Philips <small>- Designer</small></h4>
                     </div>
                     <!-- end testi-meta -->
                  </div>
                  <!-- end testimonial -->
                  <div class="testimonial clearfix">
                     <div class="desc">
                        <h3><i class="fa fa-quote-left"></i> Great &amp; Talented Team!</h3>
                        <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure
                           itself, because it is very pursue pleasure. </p>
                     </div>
                     <div class="testi-meta">
                        <h4>Venanda Mercy <small>- Newyork City</small></h4>
                     </div>
                     <!-- end testi-meta -->
                  </div>
                  <!-- end testimonial -->
                  <div class="testimonial clearfix">
                     <div class="desc">
                        <h3><i class="fa fa-quote-left"></i> Wonderful Support!</h3>
                        <p class="lead">They have got my project on time with the competition with a sed highly skilled,
                           and experienced &amp; professional team.</p>
                     </div>
                     <div class="testi-meta">
                        <h4>James Fernando <small>- Manager of Racer</small></h4>
                     </div>
                     <!-- end testi-meta -->
                  </div>
                  <!-- end testimonial -->
                  <div class="testimonial clearfix">
                     <div class="desc">
                        <h3><i class="fa fa-quote-left"></i> Awesome Services!</h3>
                        <p class="lead">Explain to you how all this mistaken idea of denouncing pleasure and praising
                           pain was born and I will give you completed.</p>
                     </div>
                     <div class="testi-meta">
                        <h4>Jacques Philips <small>- Designer</small></h4>
                     </div>
                     <!-- end testi-meta -->
                  </div>
                  <!-- end testimonial -->
                  <div class="testimonial clearfix">
                     <div class="desc">
                        <h3><i class="fa fa-quote-left"></i> Great &amp; Talented Team!</h3>
                        <p class="lead">The master-builder of human happines no one rejects, dislikes avoids pleasure
                           itself, because it is very pursue pleasure. </p>
                     </div>
                     <div class="testi-meta">
                        <h4>Venanda Mercy <small>- Newyork City</small></h4>
                     </div>
                     <!-- end testi-meta -->
                  </div>
                  <!-- end testimonial -->
               </div>
               <!-- end carousel -->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <!-- end container -->
   </div>
   <!-- end section -->
   <div id="map"></div>
   <div id="loremipsum" class="section lb">
      <div class="container">
         <div class="section-title row text-center">
            <div class="col-md-8 col-md-offset-2">
               <h3>What is Lorem Ipsum?</h3>
               <p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                  Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown 
                  printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
            <!-- end col -->
         </div>
         <!-- end title -->
         <div class="row">
            <div class="col-md-4" style="margin-bottom: 20px;">
               <div class="text-center">
                  <img src="https://via.placeholder.com/300" style="margin-bottom: 10px;" alt="Card image cap">
                  <div>
                     <h3 class="card-title"><b>Card 1</b></h3>
                     <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                  </div>
                  <div>
                     <button class="btn btn-light btn-radius grd1 btn-brd btnContactModal" data-bs-toggle="modal">Contact Us</button>
                  </div>
               </div>
            </div>

            <div class="col-md-4" style="margin-bottom: 20px;">
               <div class="text-center">
                  <img src="https://via.placeholder.com/300" style="margin-bottom: 10px;" alt="Card image cap">
                  <div>
                     <h3 class="card-title"><b>Card 2</b></h3>
                     <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                  </div>
                  <div>
                     <button class="btn btn-light btn-radius grd1 btn-brd btnContactModal" data-bs-toggle="modal">Contact Us</button>
                  </div>
               </div>
            </div>

            <div class="col-md-4">
               <div class="text-center">
                  <img src="https://via.placeholder.com/300" style="margin-bottom: 10px;" alt="Card image cap">
                  <div>
                     <h3 class="card-title"><b>Card 3</b></h3>
                     <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                  </div>
                  <div>
                     <button class="btn btn-light btn-radius grd1 btn-brd btnContactModal" data-bs-toggle="modal">Contact Us</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div id="support" class="section wb">
      <div class="container">
         <div class="section-title text-center">
            <h3>Get an Appointment Today</h3>
            <p class="lead">Let us give you more details about the special offer website you want us. Please fill out
               the form below. <br>We have million of website owners who happy to work with us!</p>
         </div>
         <!-- end title -->
         <div class="row">
            <div class="col-md-8 col-md-offset-2">
               <div class="contact_form">
                  <div id="message"></div>
                  <div id="messageAlert" class="alert alert-success" role="alert" style="display: none;">
                  </div>
                  <form id="customContactForm" class="row" action="server.php" name="customContactForm" method="post">
                     <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                     <fieldset class="row-fluid">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="first_name" id="first_name" class="form-control"
                              placeholder="First Name">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="last_name" id="last_name" class="form-control"
                              placeholder="Last Name">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label class="sr-only">Select Time</label>
                           <select name="select_service" id="select_service" class="selectpicker form-control"
                              data-style="btn-white">
                              <option value="selecttime">Select Time</option>
                              <option value="Weekdays">Weekdays</option>
                              <option value="Weekend">Weekend</option>
                           </select>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                           <label class="sr-only">What is max price?</label>
                           <select name="select_price" id="select_price" class="selectpicker form-control"
                              data-style="btn-white">
                              <option value="$100 - $2000">$100 - $2000</option>
                              <option value="$2000 - $4000">$2000 - $4000</option>
                              <option value="$4000 - $10000">$4000 - $10000</option>
                           </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <textarea class="form-control" name="comments" id="comments" rows="6"
                              placeholder="Give us more details.."></textarea>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                           <button type="submit" value="SEND" id="submit"
                              class="btn btn-light btn-radius btn-brd grd1 btn-block">Get Appointment</button>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <!-- end container -->
   </div>
   <!-- end section -->
   <footer class="footer">
      <div class="container">
         <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
               <div class="widget clearfix">
                  <div class="widget-title">
                     <img src="images/logo.png" width="210" alt="">
                  </div>
                  <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus
                     bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis
                     montes.</p>
                  <p>Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
               </div>
               <!-- end clearfix -->
            </div>
            <!-- end col -->
            <div class="col-md-3 col-sm-3 col-xs-12">
               <div class="widget clearfix">
                  <div class="widget-title">
                     <h3>Contact Details</h3>
                  </div>
                  <ul class="footer-links">
                     <li><a href="/cdn-cgi/l/email-protection#c8eb"><span class="__cf_email__"
                              data-cfemail="5930373f361920362c2b2a302d3c773a3634">[email�&nbsp;protected]</span></a>
                     </li>
                     <li><a href="#">www.yoursite.com</a></li>
                     <li>PO Box 16122 Collins Street West Victoria 8007 Australia</li>
                     <li>+61 3 8376 6284</li>
                  </ul>
                  <!-- end links -->
               </div>
               <!-- end clearfix -->
            </div>
            <!-- end col -->
            <div class="col-md-3 col-sm-3 col-xs-12">
               <div class="widget clearfix">
                  <div class="widget-title">
                     <h3>Twitter Feed</h3>
                  </div>
                  <ul class="twitter-widget footer-links">
                     <li><a href="#"><i class="fa fa-twitter"></i> @Rt_miOnline o zaman en yakın Apple Store seni bekler
                           geçmiş olsun</a></li>
                     <li><a href="#"><i class="fa fa-twitter"></i> @Harry - Thanks you so much for your help. Still
                           waiting update for my Ticket!</a></li>
                     <li><a href="#"><i class="fa fa-twitter"></i> @MedyaPet - Welcome to the our community dude! You
                           are awesome!</a></li>
                  </ul>
                  <!-- end links -->
               </div>
               <!-- end clearfix -->
            </div>
            <!-- end col -->
            <div class="col-md-2 col-sm-2 col-xs-12">
               <div class="widget clearfix">
                  <div class="widget-title">
                     <h3>Social</h3>
                  </div>
                  <ul class="footer-links">
                     <li><a href="#"><i class="fa fa-facebook"></i> 22.543 Likes</a></li>
                     <li><a href="#"><i class="fa fa-github"></i> 128 Projects</a></li>
                     <li><a href="#"><i class="fa fa-twitter"></i> 12.860 Followers</a></li>
                     <li><a href="#"><i class="fa fa-dribbble"></i> 3312 Shots</a></li>
                     <li><a href="#"><i class="fa fa-pinterest"></i>3331 Pins</a></li>
                  </ul>
                  <!-- end links -->
               </div>
               <!-- end clearfix -->
            </div>
            <!-- end col -->
         </div>
         <!-- end row -->
      </div>
      <!-- end container -->
   </footer>
   <!-- end footer -->
   <div class="copyrights">
      <div class="container">
         <div class="footer-distributed">
            <div class="footer-left">
               <p class="footer-links">
                  <a href="#">Home</a>
                  <a href="#">Blog</a>
                  <a href="#">Pricing</a>
                  <a href="#">About</a>
                  <a href="#">Faq</a>
                  <a href="#">Contact</a>
               </p>
               <p class="footer-company-name">All Rights Reserved. <a href="https://html.design/">html.design</a> © 2021
               </p>
            </div>
            <div class="footer-right">
               <form method="get" action="#">
                  <input placeholder="Subscribe our newsletter.." name="search">
                  <i class="fa fa-envelope-o"></i>
               </form>
            </div>
         </div>
      </div>
      <!-- end container -->
   </div>
   <!-- end copyrights -->
   <a href="#home" data-scroll="" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>
   <!-- ALL JS FILES -->
   <script src="js/all.js?v=<?= $version ?>"></script>
   <!-- ALL PLUGINS -->
   <script src="js/custom.js?v=<?= $version ?>"></script>
   <script src="js/portfolio.js?v=<?= $version ?>"></script>
   <script src="js/hoverdir.js?v=<?= $version ?>"></script>
   <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
   <!-- MAP & CONTACT -->
   <script src="js/map.js"></script>

</body>

</html>