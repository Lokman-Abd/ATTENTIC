<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- SEO Meta Tags -->
    <meta name="description" content="">
    <meta name="author" content="ntic">
    <!-- Webpage Title -->
    <title>ATTENTIC</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('landingPageAssets/css/swiper.css')}}" rel="stylesheet">
    <link href="{{asset('landingPageAssets/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{asset('landingPageAssets/css/styles.css')}}" rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" href="img/logo/icon.png">
</head>

<body data-spy="scroll" data-target=".fixed-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <a class="navbar-brand logo-text page-scroll" href="#">ATTE<span style='color:rgba(0,172,193,1);'>NTIC</span></a>

            <!-- Image Logo -->
            <!-- <a class="navbar-brand " href="index.php"><img width='30px' height='30px' src="img/logo/logo_ntic.png" alt="alternative"></a>  -->

            <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#features">Features <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#details">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link page-scroll" href="#contact">Contact</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link page-scroll" href="#about">About</a>
                    </li> -->
                </ul>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->


    <!-- Header -->
    <section id='home' class="header">
        <div class="ocean">
            <div class="wave"></div>
            <div class="wave"></div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h1 class="h1-large">ATTE<span style='color:rgba(0,172,193,1);'>NTIC</span> is designed for NTIC department</h1>
                        <p class="p-large">Use ATTENTIC to Manage, See and Take attendance in an easy and perfect way</p>
                        <a class="btn-solid-lg" href="{{route('login')}}">Get Started</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid logo-image" src="{{asset('img/logo/logoRounded.png')}}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section> <!-- end of header -->


    <!-- Statement -->
    <div id="statement" class="basic-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container">
                        <h3>Our Platform is a solid management system</h3>
                        <p class="p-large">“we've designed this website based on Laravel, Bootstrap and MySQL. What's great about Attentic is that it can be used by anyone from absolute student to a responsible administrator”</p>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of basic-1 -->
    <!-- end of statement -->


    <!-- features -->
    <section id="features" class="basic-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-7">
                    <div class="image-container">
                        <img class="img-fluid" src="{{asset('landingPageAssets/images/easy.png')}}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-6 col-xl-5">
                    <div class="text-container">
                        <h2>Easy To Use</h2>
                        <p>ATTENTIC is a well structured website and very easy to use. You can get in and use with basic computer skills and mo matters your role!.</p>
                        <ul class="list-unstyled li-space-lg">
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><strong>For Teachers</strong> </div>
                            </li>
                            <li class="media">
                                <i class="fas fa-square"></i>
                                <div class="media-body"><strong>For Students</strong> </div>
                            </li>
                        </ul>
                        <a class="btn-solid-reg popup-with-move-anim" href="#details-lightbox">How to use?</a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
        <!-- end of feature 1 -->

        <!-- Details Lightbox -->
        <!-- Lightbox -->
        <div id="details-lightbox" class="lightbox-basic zoom-anim-dialog mfp-hide">
            <div class="row">
                <button title="Close (Esc)" type="button" class="mfp-close x-button">×</button>
                <div class="col-lg-8">
                    <div class="image-container">
                        <img class="img-fluid" src="{{asset('landingPageAssets/images/details-lightbox.jpg')}}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <h3>Goals Setting</h3>
                    <hr>
                    <p>The website can easily help teachers to track their students attendance, in the other hand, It keeps the student aware of his absences</p>
                    <h4>Steps</h4>
                    <p>It helps you save time and make your live easier. And it will help you to focus on the program.</p>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">Request your account login details from the administrator</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">login with your Email and Passwort</div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i>
                            <div class="media-body">Thats all!</div>
                        </li>
                        <!-- <li class="media">
                            <i class="fas fa-check"></i><div class="media-body"></div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i><div class="media-body"></div>
                        </li>
                        <li class="media">
                            <i class="fas fa-check"></i><div class="media-body"></div>
                        </li> -->
                    </ul>
                    <a class="btn-solid-reg mfp-close page-scroll" href="#contact">Contact Us</a> <button class="btn-outline-reg mfp-close as-button" type="button">Back</button>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of lightbox-basic -->
        <!-- end of lightbox -->
        <!-- end of details lightbox -->


        <!-- feature 2 -->
        <div class="basic-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-xl-5">
                        <div class="text-container">
                            <h2>Responsive Design</h2>
                            <p>We developped this platform to respond to all user's behavior and environment based on screen size, platform, orientation.</p>
                            <ul class="list-unstyled li-space-lg">
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body"><strong>For Conputers</strong> </div>
                                </li>
                                <li class="media">
                                    <i class="fas fa-square"></i>
                                    <div class="media-body"><strong>For Mobiles and Tablets</strong> </div>
                                </li>
                            </ul>
                            <!-- <a class="btn-solid-reg" href="#your-link">Details</a> -->
                        </div> <!-- end of text-container -->
                    </div> <!-- end of col -->
                    <div class="col-lg-6 col-xl-7">
                        <div class="image-container">
                            <img class="img-fluid" src="{{asset('landingPageAssets/images/responsiveDesign.png')}}" alt="alternative">
                        </div> <!-- end of image-container -->
                    </div> <!-- end of col -->
                </div> <!-- end of row -->
            </div> <!-- end of container -->
        </div> <!-- end of basic-3 -->
        <!-- end of feature 2 -->
    </section> <!-- end of basic-2 -->

    <!-- Features -->
    <section id="details" class="basic-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="text-box bg-gray">
                        <h4>Admin</h4>
                        <img class="img-fluid" src="{{asset('landingPageAssets/images/admin.png')}}" alt="alternative">
                    </div> <!-- end of text-box -->
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <div class="text-box bg-gray">
                        <h4>Teacher</h4>
                        <img class="img-fluid" src="{{asset('landingPageAssets/images/teacher.png')}}" alt="alternative">
                    </div> <!-- end of text-box -->
                </div> <!-- end of col -->
                <div class="col-lg-4">
                    <div class="text-box bg-gray">
                        <h4>Student</h4>
                        <img class="img-fluid" src="{{asset('landingPageAssets/images/student.png')}}" alt="alternative">
                    </div> <!-- end of text-box -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section> <!-- end of basic-4 -->
    <!-- end of features -->


    <!-- framwork -->
    <section id='framework' class="basic-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-container bg-gray">

                        <h4>Built with laravel which is a well established backend web development framework dedicated to creatives and makers</h4>
                        <a class="btn-solid-lg" href="{{route('login')}}"> <img class="img-fluid" src="{{asset('landingPageAssets/images/laravel.svg')}}" alt="alternative"></a>
                    </div> <!-- end of text-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section> <!-- end of basic-6 -->
    <!-- end of invitation -->


    <!-- Contact -->
    <section id="contact" class="form-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h2-heading">Contact details</h2>
                    <p class="p-heading">Don't hesitate to send your questions through the contact form or <a class="blue no-line" href="mailto:l3ti.daw@gmail.com">l3ti.daw@gmail.com</a></p>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-12">
                    <div id="alert_container">

                    </div>

                    <!-- Contact Form -->
                    <div class="form-container">
                        <img class="decoration" src="{{asset('landingPageAssets/images/contact-envelope.svg')}}" alt="alternative">
                        <form>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control-input" id="cname" required>
                                <label class="label-control" for="cname">Name</label>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email_address" class="form-control-input" id="cemail" required>
                                <label class="label-control" for="cemail">Email</label>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control-textarea" name="email_content" id="cmessage" required></textarea>
                                <label class="label-control" for="cmessage">Your message</label>
                            </div>
                            <div class="form-group">
                                <button type="button" id="submitEmail" class="form-control-submit-button">Submit Message</button>
                            </div>
                        </form>
                    </div> <!-- end of form-container -->
                    <!-- end of contact form -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section> <!-- end of form-1 -->
    <!-- end of contact -->


    <!-- Copyright -->
    <div class="copyright bg-gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">Copyright © </a></p>
                </div> <!-- end of col -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="p-small">designed by: Groupe1</p>
                </div> <!-- end of col -->
            </div>
            <!-- enf of row -->
        </div> <!-- end of container -->
    </div> <!-- end of copyright -->
    <!-- end of copyright -->


    <!-- Scripts -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> <!-- Bootstrap framework -->
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
    <script src="{{asset('landingPageAssets/js/swiper.min.js')}}"></script> <!-- Swiper for image and text sliders -->
    <script src="{{asset('landingPageAssets/js/jquery.magnific-popup.js')}}"></script> <!-- Magnific Popup for lightboxes -->
    <script src="{{asset('landingPageAssets/js/scripts.js')}}"></script> <!-- Custom scripts -->
    <script>
        $(document).ready(function() {
            $(document).on('click', '#submitEmail', function() {
                $("#alert_container").html(
                       `
                       <div class="alert alert-info alert-dismissible " role="alert" id="buttonAlert">
                           <strong> Please wait... </strong>
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       `
                       )
                let allData = {

                };

                $.each($('form').serializeArray(), function(i, field) {
                    allData[field.name] = field.value;
                });


                $.post("{{route('contactUs')}}", {
                    '_token': "{{csrf_token()}}",
                    'data': allData
                }, function(response) {
                   
                    if (response.status) {
                        $("#alert_container").html(
                        `
                        <div class="alert alert-success alert-dismissible " role="alert" id="buttonAlert">
                            <strong>Success! </strong>${response.message}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `
                        )
                    }else{
                        $("#alert_container").html(
                        `
                        <div class="alert alert-danger alert-dismissible " role="alert" id="buttonAlert">
                            <strong> Sorry ! </strong>${response.message}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        `
                        )
                    }
                })

            })
        })
    </script>
</body>

</html>