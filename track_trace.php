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





<!DOCTYPE php>
<php lang="en">

<!-- Mirrored from trusttransport.themeebit.com/track_trace.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 09:32:18 GMT -->
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

    <!-- datepicker css goes here -->
    <link rel="stylesheet" href="css/datepicker.min.css">

    <!-- style css -->
    <link rel="stylesheet" href="style.css"/>

    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.ico"/>
</head>
<body class="track_trace">

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
            <!-- .row start -->
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

                    <div class="col-md-3 xs_fullwidth col-xs-3 col-lg-2 col-lg-offset-1">
                        <a href="quote.php" class="trust_btn quote_btn">get a free quote</a>
                    </div>
                </div>
            </div><!-- /.row end -->


        </div><!-- /.container end -->
    </header><!-- start header -->
    <!--================================
        END HEADER AREA
    =================================-->

    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb">

        <div class="breadcrumb_content">
            <!-- container starts -->
            <div class="container">
                <!-- row starts -->
                <div class="row">
                    <!-- col-md-12 starts -->
                    <div class="col-md-12">
                        <div class="breadcrumb_title_wrapper">
                            <div class="page_title">
                                <h1>track & trace</h1>
                            </div>
                            <ul class="bread_crumb">
                                <li><a href="index.php">Home</a></li>
                                <li class="bread_active">Tracking</li>
                            </ul>
                        </div>
                    </div><!-- col-md-12 ends -->
                </div>
                <!-- /.row ends -->
            </div><!-- /.container ends -->
        </div>

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
                                        <!--<li><a href="contact.php">contact</a></li>-->
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
        END BREADCRUMB AREA
    =================================-->

    <!--================================
        START TRACK & TRACE AREA
    =================================-->
    <section class="tc_section section_padding reveal animated" data-delay="0.2s" data-anim="fadeInUpShort">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="tc_title"><h4>Please Enter Your Product Code And You Will See Your Product</h4></div>
                    <div class="tc_form">
                        <form action="track_trace.php" method="POST">
                            <div class="tc_input_wrapper">
                                <input name="tid" type="text" placeholder="Enter Your Tracking Code">
                                <span class="fa fa-truck"></span>
                                <button class="tc_btn" name="submit" type="submit">enter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================
        END TRACK & TRACE AREA
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

    <script>
        var myCenter=new google.maps.LatLng(32.294445, 72.349724);
        function initialize()
            {
                var mapProp = {
                  center:myCenter,
                  zoom:4,
                  scrollwheel: false,
                  mapTypeId:google.maps.MapTypeId.ROADMAP,
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#edf0f5"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                  };

                var map = new google.maps.Map(document.getElementById("google_map"),mapProp);
                    var marker = new google.maps.Marker({
                      position: myCenter,
                      map: map,
                      icon:'images/map-marker1.png'
                    });


                var infowindow = new google.maps.InfoWindow({
                  content:"united-states"
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>

<!-- Mirrored from trusttransport.themeebit.com/track_trace.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 05 Mar 2020 09:32:19 GMT -->
</php>
