<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package SalimBrothers
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Template Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,600i,700" rel="stylesheet">

	<?php wp_head(); ?>
</head>
<?php 
	if (is_front_page()) {
        $page = 'home';
    }elseif(is_page_template( 'pt-about.php' )){
        $page = 'about';
    }elseif(is_page_template( 'pt-contact.php' )){
        $page = 'contact';
    }elseif(is_page_template( 'pt-gallery.php' )){
        $page = 'portfolio';
    }elseif(is_404()){
		$page = 'home';
	}    
?>
<body class="<?php echo $page;?> light" <?php body_class(); ?>>
<?php wp_body_open(); ?>
<!-- Header Starts -->
<header class="header" id="navbar-collapse-toggle">
    <!-- Fixed Navigation Starts -->
    <ul class="icon-menu d-none d-lg-block revealator-slideup revealator-once revealator-delay1">
        <li class="menu_logo">
            <a href="<?php echo home_url();?>/login">
                <img src="<?php echo get_template_directory_uri();?>/img/f-logo.png" alt="">
            </a>
        </li>
        <li class="icon-box <?php if($page == 'home'){echo 'active';}?>">
            <i class="fa fa-home"></i>
            <a href="<?php echo home_url();?>">
                <h2>Home</h2>
            </a>
        </li>
        <li class="icon-box <?php if($page == 'about'){echo 'active';}?>">
            <i class="fa fa-user"></i>
            <a href="<?php echo home_url();?>/about">
                <h2>About</h2>
            </a>
        </li>
        <li class="icon-box <?php if($page == 'portfolio'){echo 'active';}?>">
            <i class="fa fa-picture-o"></i>
            <a href="<?php echo home_url();?>/gallery">
                <h2>Gallery</h2>
            </a>
        </li>
        <li class="icon-box <?php if($page == 'contact'){echo 'active';}?>">
            <i class="fa fa-envelope-open"></i>
            <a href="<?php echo home_url();?>/contact">
                <h2>Contact</h2>
            </a>
        </li>         
    </ul>

    <!-- Fixed Navigation Ends -->
    <!-- Mobile Menu Starts -->
    <nav role="navigation" class="d-block d-lg-none">
        <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul class="list-unstyled" id="menu">
                <li class="<?php if($page == 'home'){echo 'active';}?>">
                    <a href="<?php echo home_url();?>"><i class="fa fa-home"></i><span>Home</span></a>
                </li>
                <li class="<?php if($page == 'about'){echo 'active';}?>">
                    <a href="<?php echo home_url();?>/about"><i class="fa fa-user"></i><span>About</span></a>
                </li>
                <li>
					<a href="<?php echo home_url();?>/gallery">
						<i class="fa fa-folder-open"></i>
						<span>Gallery</span>
					</a>
				</li>
                <li class="<?php if($page == 'contact'){echo 'active';}?>">
					<a href="<?php echo home_url();?>/contact">
						<i class="fa fa-envelope-open"></i>
						<span>Contact</span>
					</a>
				</li>
                <!-- <li><a href="blog.html"><i class="fa fa-comments"></i><span>Blog</span></a></li> -->
            </ul>
        </div>
    </nav>
    <!-- Mobile Menu Ends -->
</header>
<!-- Header Ends -->
 
