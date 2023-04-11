<?php

include "config/database.php";

if(isset($_POST['submit'])){

	$tid = $_POST['tid'];




	if($tid == ""){

	echo "<script>alert('Please enter a tracking Number')</script>";

	}else{


		$sql= "SELECT * FROM track WHERE pid = '$tid'";
		$result = mysqli_query($link,$sql);
		if(mysqli_num_rows($result) > 0){
		  $row = mysqli_fetch_assoc($result);

		  $pid = $row['pid'];
		  if(isset($row['pid'])){

			  $pid = $row['pid'];



	if($tid == $pid){



	header("Location:users/Results.php?track=$tid");

	}

	else{

		echo "<script>alert('No record for the track number')</script>";
	}

}

}

}
}

?>






<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from trusttransport.themeebit.com/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 09:31:57 GMT -->
<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mediterranean Shippings</title>

    <!-- owl carousel css -->
    <link rel="stylesheet" href="css/owl.carousel.css"/>


    <!-- font icofont -->
    <link rel="stylesheet" href="css/font-awesome.min.css"/>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Montserrat:300,400,400i,700,900" rel="stylesheet">

    <!-- bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"/>

    <!-- animte css -->
    <link rel="stylesheet" href="css/animate.css"/>

    <!-- camera css goes here -->
    <link rel="stylesheet" href="css/camera.css">

    <!-- venobox css goes here -->
    <link rel="stylesheet" href="css/venobox.css">

    <!-- style css -->
    <link rel="stylesheet" href="style.css"/>

    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
</head>
<body class="home2">

    <!-- preloader -->
    <div class="preloader-bg">
        <div class="preloader-container">
            <div class="my-preloader"><img src="images/favicon.png" alt="preloader"></div>
        </div>
    </div>


    <!--================================
        START HEADER AREA
    =================================-->
    
    
    
    <div id="google_translate_element" style="margin-left:1%">

</div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    
    

    <!-- start header -->
    <header>
        <!-- container start -->
        <div class="container">
            <!-- .row start
            <div class="row">
                <div class="tiny_header clearfix">
                    <div class="col-md-12">
                        <div class="tiny_header_wrapper">
                            <div class="header_info">
                                <ul>
                                    <li><a href="#">Faq</a></li>
                                    <li><a href="#">Help Desk</a></li>
                                    <li><a href="#">Track Shipment</a></li>
                                </ul>
                            </div>

                            <div class="times">
                                <p><i class="fa fa-clock-o"></i> <span class="day">Sat - Thus</span>9 am - 6 pm</p>
                            </div>

                            <div class="social_links">
                                <ul>
                                    <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                    <li><a href="#"><span class="fa fa-pinterest-p"></span></a></li>
                                    <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                    <li><a href="#"><span class="fa fa-dribbble"></span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row end -->

            <!-- row start -->
            <div class="row">
                <div class="header_middle_wrapper clearfix">
                    <div class="col-md-3 xs_fullwidth col-xs-3">
                        <div class="logo_container">
                            <a href="index.php"><img src="images/logo.png" alt="logo Here"></a>
                        </div>
                    </div>

                   <div class="col-lg-5 xs_fullwidth col-xs-6 col-md-6 col-md-offset-0 col-lg-offset-1">
                        <div class="contact_info">
                            <div class="single_info_section">
                                <span class="fa fa-headphones v_middle"></span>
                                <div class="contact_numbers v_middle right_info">
                                    <p><a href="tel:+447441443940">+44 (74) 4144-3940</a></p>
                                </div>
                            </div>
                            <div class="single_info_section">
                                <span class="fa fa-envelope v_middle"></span>
                                <div class="contact_numbers right_info v_middle">
                                    <p><a href="mailto:support@mediterraneanshippings.com">support@mediterraneanshippings.com</a></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tc_title"><h4>(Please Enter Your Product Code And You Will See Your Product)</h4></div>
                    <div class="tc_form">










                        <form action="index.php" method="POST">
                            <div class="tc_input_wrapper">

                                <input name="tid" type="text" placeholder="Enter Your Tracking Code">

                                <span class="fa fa-truck"></span>

                                <button class="tc_btn" type="submit" name="submit">track</button>
                            </div>
                        </form>
                </div>
            </div><!-- /.row end -->


        </div><!-- /.container end -->
    </header><!-- start header -->
    <!--================================
        END HEADER AREA
    =================================-->

    <!--================================
        START SLIDER AREA
    =================================-->
    <section class="slider_area">

        <!-- slider starts  -->
        <div class="sliders">

            <!-- hero slides -->
            <div class="hero_sliders">

                <!-- single hero_slide -->
                <div class="hero_slide" data-src="images/home2slide1.jpg">
                    <div class="captions_wrapper right">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-4">
                                    <div class="single_slider_wrapper">
                                        <span class="small_title fadeInRightShort animated">FAST DELIVERY</span><br>
                                        <h1 class="big_title fadeInRightShort animated">Mediterranean Shippings is fast and reliable</h1>
                                        <div class="hero_btn">
                                            <a href="services.html" class="trust_btn" data-hover="see more">see more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- single hero_slide -->

                <!-- single hero_slide -->
                <div class="hero_slide" data-src="images/slider_1.jpg">
                    <div class="captions_wrapper left">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="single_slider_wrapper">
                                        <span class="small_title fadeInLeftShort animated">FAST DELIVERY</span><br>
                                        <h1 class="big_title fadeInLeftShort animated">Mediterranean Shippings is the world leading logistics service</h1>
                                        <div class="hero_btn">
                                            <a href="services.html" class="trust_btn">see more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- single hero_slide -->

            </div><!-- ./hero slides  -->
        </div><!-- /.sliders ends -->

        <!-- menu starts -->
        <div class="menu_area">

            <!-- container starts -->
            <div class="container">
                <!-- row start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="mainmenu nav_shadow">
                            <nav class="navbar navbar-default">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <!-- Collect the nav links, forms, and other content for toggling -->
                                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                    <ul class="nav navbar-nav magic_menu">
                                       	<li class="active"><a href="index.php">Home</a></li>
										<li><a href="about_us2.php">About us</a></li>
                                      	<li><a href="services.php">services</a></li>
                                        <li><a href="track_trace.php">Track & Trace</a></li>
										<li><a href="admin/pages/login.php">login</a></li>
                                        <!--<li><a href="contact.html">contact</a></li>-->
                                    </ul>
                                    <div class="search_form">
                                        <div class="search_btn" data-toggle="modal" data-target="#search_modal">
                                            <span class="fa fa-search"></span>
                                        </div>

                                        <!-- search Modal -->
                                        <div class="modal fade" id="search_modal" tabindex="-1" role="dialog">
                                          <div class="modal-dialog s_modal" role="document">
                                            <div class="modal-content">
                                              <div class="modal-body">
                                                <div class="search_form_wrapper">
                                                    <form method="post">
                                                        <div class="search_input">
                                                            <input type="text" name="search_field" placeholder="Search Query...">
                                                            <button class="submit_btn" type="submit">
                                                                <span class="fa fa-search"></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div><!-- /.navbar-collapse -->
                            </nav>
                        </div><!-- main menu ends -->
                    </div>
                </div><!-- /.row end -->

            </div><!-- /.container ends -->
        </div><!-- menu ends -->
    </section>
    <!--================================
        END SLIDER AREA
    =================================-->


    <!--================================
        START SERVICE AREA STYLE2
    =================================-->
    <section class="service2 clearfix reveal animated" data-delay="0.2s" data-anim="fadeInUpShort">
        <div class="service_wrapper clearfix">
            <div class="single_service">
                <div class="service_img">
                    <img class="svg" src="images/service_icon1.svg" alt="service icons">
                </div>
                <div class="service_content_wrapper">
                    <div class="service_title">
                        <h4>Fast sea delivery</h4>
                    </div>
                    <p>Mediterranean Shippings Company flexible and scalable sea freight solutions cover your specific needs. Our affiliation with leading carriers is the key to our cost-effective services.</p>
                </div>
            </div>

            <div class="single_service">
                <div class="service_img">
                    <img class="svg" src="images/service_icon2.svg" alt="service icons">
                </div>
                <div class="service_content_wrapper">
                    <div class="service_title">
                        <h4>Fast road delivery</h4>
                    </div>
                    <p>Mediterranean Shippings Transport offers an efficient integrated transport system with multiple types of trucks available to support your trucking and distribution needs. </p>
                </div>
            </div>

            <div class="single_service">
                <div class="service_img">
                    <img class="svg" src="images/service_icon3.svg" alt="service icons">
                </div>
                <div class="service_content_wrapper">
                    <div class="service_title">
                        <h4>Fast air shipping</h4>
                    </div>
                    <p>Mediterranean Shippings Company is an airfreight forwarding specialists offering a comprehensive range of international air cargo solutions with unbeatable levels of customer service. </p>
                </div>
            </div>

            <div class="single_service">
                <div class="service_img">
                    <img class="svg" src="images/service_icon4.svg" alt="service icons">
                </div>
                <div class="service_content_wrapper">
                    <div class="service_title">
                        <h4>online support</h4>
                    </div>
                    <p>Mediterranean Shippings offer a 24/7 online support services to handle all your trucking services to suit your needs. </p>
                </div>
            </div>

            <div class="single_service hidden-sm">
                <div class="service_img">
                    <img class="svg" src="images/service_icon5.svg" alt="service icons">
                </div>
                <div class="service_content_wrapper">
                    <div class="service_title">
                        <h4>best security system</h4>
                    </div>
                    <p>Mediterranean Shippings Engages best security service model to ensure prompt, accurate delivery of your goods around the world </p>
                </div>
            </div>
        </div>
    </section>
    <!--================================
        START SERVICE AREA STYLE2
    =================================-->


    <!--================================
        START ABOUT US AREA
    =================================-->
    <section class="mission_vision section_padding reveal animated" data-delay="0.2s" data-anim="fadeInUpShort">
        <!-- mission start -->
        <div class="mission">
            <!-- container starts -->
            <div class="container">

                <!-- row starts -->
                <div class="row">
                    <!-- /.col-md-6 ends -->
                    <div class="col-md-6 col-md-offset-6 col-xs-6 xxs_offset-0 xxs_fullwidth col-xs-offset-6">
                        <!-- section_title starts -->
                        <div class="kmas_area">
                            <div class="section_title">
                            <div class="sub_title">
                                <p>Do You Know ?</p>
                            </div>
                            <div class="title"><h2>WHO WE ARE ?</h2></div>
                        </div><!-- section_title starts -->

                        <div class="about_us_content">
                            <div class="who_we_text">
                                <p style="text-align:justify;">Mediterranean Shippings offers a host of logistic management services and supply chain solutions.
								We provide innovative solutions with the best people, processes, and technology. With years of providing world class service to our customers on the asset side, a need to
								provide a one stop shop for a” true customer service logistic solution” was introduced. By
								adding this dimension to an already dynamic and customer centric asset based provider, we
								feel we bring a total solution.</p>
                            </div>
                        </div>
                        </div>
                    </div><!-- /.col-md-6 ends -->
                </div><!-- /.row ends -->
            </div><!-- /.container ends -->

            <div class="mission_img"></div>
        </div><!-- /.mission end -->

        <!-- start vision -->
        <div class="vision">
            <!-- container -->
            <div class="container">
                <!-- row starts -->
                <div class="row">
                    <!-- /.col-md-6 ends -->
                    <div class="col-md-6 col-xs-6 xxs_offset-0 xxs_fullwidth">
                        <!-- section_title starts -->
                        <div class="section_title">
                            <div class="sub_title">
                                <p>Our Vission</p>
                            </div>
                            <div class="title"><h2>our vission</h2></div>
                        </div><!-- section_title starts -->

                        <div class="about_us_content">
                            <div class="who_we_text">
                                <p style="text-align:justify;">The following principles reflect our values, define our culture, and guide
								our actions: lead with humility and respect. Earn trust through authenticity
								and accountability. Cultivate mutually beneficial partnerships with customers,
								associates and suppliers. Practice servant leadership and demand the highest
								standards.</p>

                            </div>
                        </div>
                    </div><!-- /.col-md-6 ends -->
                </div><!-- /.row ends -->
            </div><!-- /.container -->

            <div class="vision_img"></div>
        </div><!-- /.vision end-->
    </section>
    <!--================================
        END ABOUT US AREA
    =================================-->

    <!--================================
        START FOOTER
    =================================-->
    <footer>
        <div class="big_footer_wrapper section_padding">
            <div class="container">
                <div class="row">

                    <div class="col-md-3 xxs_fullwidth col-xs-6">
                        <div class="footer_about_wrapper reveal animated" data-anim="fadeInLeftShort" >
                            <div class="footer_logo">
                                <a href="index.php">
                                    <img src="images/footer_logo.png" alt="footer_logo">
                                </a>
                            </div>
                            <div class="footer_about_us">
                                <p>Over the years, Mediterranean Shippings has diversified its activities to include overland transportation, logistics and a growing portfolio of port terminal investments. Today, our focus remains true to our roots and we continue to build and retaining long-term trusted partnerships with customers of all size and scale.  </p>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-2 xxs_fullwidth col-xs-6">
                        <div class="footer_widgets sevices reveal animated" data-anim="fadeInRightShort" data-delay="0.2s">
                            <div class="widget_title">
                                <h4>our services</h4>
                            </div>
                            <div class="footer_links">
                                <ul>
                                    <li><a href="#">Sea Freight</a></li>
                                    <li><a href="#">Road Transportation</a></li>
                                    <li><a href="#">Air Freight</a></li>
                                    <li><a href="#">Railway Logistics</a></li>
                                    <li><a href="#">Packaging & Storage</a></li>
                                    <li><a href="#">Warehousing</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 xxs_fullwidth col-xs-6">
                        <div class="footer_widgets contact reveal animated" data-anim="fadeInRightShort" data-delay="0.4s">
                            <div class="widget_title">
                                <h4>contact us</h4>
                            </div>
                            <div class="footer_address">
                                <ul>
                                    <li><span class="fa fa-paper-plane-o"></span> <div class="address_right">Mediterranean Shippings, UK.</div></li>
                                    <li>
                                        <span class="fa fa-phone"></span>
                                        <div class="number address_right">
                                            <a href="tel:+447441443940">+44 (74) 4144-3940</a>
                                            <a href="tel:+447441443940">+44 (74) 4144-3940</a>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="fa fa-envelope-o"></span>
                                        <div class="address_right">
                                            <a href="mailto:support@Mediterraneanshippings.com">support@mediterraneanshippings.com</a>
                                            <a href="#">mediterraneanshippings.com</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 xxs_fullwidth col-xs-6">
                        <div class="footer_widgets twitter reveal animated" data-anim="fadeInRightShort" data-delay="0.6s">
                            <div class="widget_title">
                                <h4>contact us</h4>
                            </div>

                            <div class="twitter_widget">
                                <div class="single_tweets">
                                    <span class="twit_icon fa fa-twitter"></span>
                                    <div class="twit">
                                        <p><span class="tag">@Mediterranean Shippings</span> fast and reliable</p>
                                        <span class="time">Recent</span>
                                    </div>
                                </div>
                                <div class="single_tweets">
                                    <span class="twit_icon fa fa-twitter"></span>
                                    <div class="twit">
                                        <p><span class="tag">@Mediterranean Shippings</span> the best logistics</p>
                                        <span class="time">Recent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="tiny_footer">
            <div class="container">
                <div class="col-md-6 xs_fullwidth col-xs-6">
                    <div class="footer_text_wrapper">
                        <p class="footer_text">Copyright © Mediterranean Shippings. All Rights Reserved by <a href="https://themeforest.net/user/themeebit">Mediterranean Shippings</a></p>
                    </div>
                </div>
                <div class="col-md-6 xs_fullwidth col-xs-6">
                    <div class="footer_menu clearfix">
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about_us.php">About Us</a></li>
                            <li><a href="track_trace.php">Track & Trace</a></li>
                            <li><a href="blog.php">News</a></li>
                            <li><a href="contcat.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--================================
        END FOOTER
    =================================-->

    <!--//////////////////// JS GOES HERE ////////////////-->

    <!-- jquery latest version -->
    <script src="js/jquery-1.12.3.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>

    <!-- jquery easing 1.3 -->
    <script src="js/jquery.easing1.3.js"></script>

    <!-- Owl carousel js-->
    <script src="js/owl.carousel.min.js"></script>

    <!-- venobox js -->
    <script src="js/venobox.min.js"></script>

    <!-- Isotope js-->
    <script src="js/isotope.js"></script>

    <!-- Pakcery layout js-->
    <script src="js/packery.js"></script>

    <!-- waypoint js -->
    <script src="js/waypoints.min.js"></script>

    <!-- google map js -->
    <script src="http://maps.googleapis.com/maps/api/js"></script>

    <!-- smoothscroll js -->
    <script src="js/jqury.smooth-scroll.min.js"></script>

    <!-- jquery camera slider js -->
    <script src="js/jquery.camera.min.js"></script>
    <!-- Counter up -->
    <script src="js/jquery.counterup.js"></script>

    <!-- Waypoint -->
    <script src="js/waypoints.min.js"></script>

    <!-- Main js -->
    <script src="js/main.js"></script>

    <!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
</body>

<!-- Mirrored from trusttransport.themeebit.com/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 09:32:01 GMT -->
</html>
