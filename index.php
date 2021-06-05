<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SalimBrothers
 */

get_header();
?>

	<!-- Main Content Starts -->
<section class="container-fluid main-container container-home p-0 revealator-slideup revealator-once revealator-delay1">
    <div class="color-block d-none d-lg-block"></div>
    <div class="row home-details-container align-items-center">
        <div class="col-lg-4 bg position-fixed d-none d-lg-block"></div>
        <div class="col-12 col-lg-8 offset-lg-4 home-details text-left text-sm-center text-lg-left">
            <div>
                <img src="<?php echo get_template_directory_uri();?>/img/img-mobile.jpg" class="img-fluid main-img-mobile d-none d-sm-block d-lg-none" alt="my picture" />

                <img src="<?php echo get_template_directory_uri();?>/img/logo.png" alt="" class="w-50 mb-4">

                <h1 class="text-uppercase poppins-font">Welcome to<span>M/S SALIM BROTHERS</span></h1>
                <p class="open-sans-font">( আমদানীকারক / Order Suppliers )</p>
                <p>M/S SALIM BROTHERS, one of the most prominent suppliers of the natural stone industry, now processes marble blocks and offers high value-added products in a 6.000 sq. m modern plant running as of the beginning of 2017 in Bucak Organized Industrial Zone as a second major step after its well-established sales area of 12.500 square meters in Bangladesh.</p>
                <a class="button" href="<?php echo home_url();?>/about">
                    <span class="button-text">more about me</span>
                    <span class="button-icon fa fa-arrow-right"></span>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- Main Content Ends -->

<?php
//get_sidebar();
get_footer();
