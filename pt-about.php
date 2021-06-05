<?php
/* 
Template Name: About page
*/
get_header();

?>
    <!-- Page Title Starts -->
    <section class="title-section text-left text-sm-center revealator-slideup revealator-once revealator-delay1">
        <h1>ABOUT <span>US</span></h1>
        <span class="title-bg">Company</span>
    </section>
    <!-- Page Title Ends -->
    <!-- Main Content Starts -->
    <section class="main-content revealator-slideup revealator-once revealator-delay1 mb-5">
        <div class="container">
            <div class="row">
                <!-- Personal Info Starts -->
                <div class="col-12 col-lg-5 col-xl-6">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="text-uppercase custom-title mb-0 ft-wt-600">Company infos</h3>
                        </div>
                        <div class="col-12 d-block d-sm-none">
                            <img src="<?php echo get_template_directory_uri();?>/img/img-mobile-light.jpg" class="img-fluid main-img-mobile" alt="my picture" />
                        </div>
                        <div class="col-md-6">
                            <ul class="about-list list-unstyled open-sans-font">
                                <li> <span class="title">name :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">M/S Salim Brothers</span> </li>
                                <li> <span class="title">Address :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">10, Chanmari Approach Road, Shipyard, Khulna</span>
                                </li>                            
                                <li><span class="title">Call :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">+880 1711 30 96 90</span> </li>
                                <li> <span class="title">Email :</span> <span class="value d-block d-sm-inline-block d-lg-block d-xl-inline-block">salimbrothersbd@gmail.com</span> </li>
                            </ul>
                        </div>                     
                    </div>
                </div>
                <!-- Personal Info Ends -->
                <!-- Boxes Starts -->
                <div class="col-12 col-lg-7 col-xl-6 mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box-stats with-margin">
                                <h3 class="poppins-font position-relative">12</h3>
                                <p class="open-sans-font m-0 position-relative text-uppercase">years of <span class="d-block">experience</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-stats with-margin">
                                <h3 class="poppins-font position-relative">2k+</h3>
                                <p class="open-sans-font m-0 position-relative text-uppercase">completed <span class="d-block">projects</span></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="box-stats">
                                <h3 class="poppins-font position-relative">1k+</h3>
                                <p class="open-sans-font m-0 position-relative text-uppercase">Happy<span class="d-block">customers</span></p>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="box-stats">
                                <h3 class="poppins-font position-relative">53</h3>
                                <p class="open-sans-font m-0 position-relative text-uppercase">awards <span class="d-block">won</span></p>
                            </div>
                        </div> -->
                    </div>
                </div>
                <!-- Boxes Ends -->
            </div>
            <hr class="separator">
            
            <!-- Experience & Education Starts -->
            <div class="row">
                <div class="col-12">
                    <h3 class="text-uppercase pb-5 mb-0 text-left text-sm-center custom-title ft-wt-600">Our <span>Products</span></h3>
                </div>
                <div class="col-lg-6 m-15px-tb">
                    <div class="resume-box">
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-diamond"></i>
                                </div>
                                
                                <h5 class="poppins-font text-uppercase">Stone Chips <span class="place open-sans-font">430</span></h5>
                                <!-- <p class="open-sans-font">Lorem ipsum dolor sit amet, consectetur tempor incididunt ut labore adipisicing elit, </p> -->
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-diamond"></i>
                                </div>                            
                                <h5 class="poppins-font text-uppercase">Stone Chips <span class="place open-sans-font">3/4</span></h5>                            
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-diamond"></i>
                                </div>                            
                                <h5 class="poppins-font text-uppercase">Stone Chips <span class="place open-sans-font">5/8</span></h5>                             
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 m-15px-tb">
                    <div class="resume-box">
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-diamond"></i>
                                </div>                            
                                <h5 class="poppins-font text-uppercase">Stone Chips <span class="place open-sans-font">1/2</span></h5>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-diamond"></i>
                                </div>                            
                                <h5 class="poppins-font text-uppercase">Stone Chips <span class="place open-sans-font">1/4</span></h5>
                            </li>                         
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Experience & Education Ends -->
        </div>
    </section>
    <!-- Main Content Ends -->
<?php
//get_sidebar();
get_footer();