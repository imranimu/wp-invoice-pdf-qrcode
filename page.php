<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SalimBrothers
 */

get_header();
?>	
	<section class="pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
					?>
				</div><!-- /.col-md-9 -->
				<div class="col-md-3">
					<?php get_sidebar(); ?>
				</div><!-- /.col-md-3 -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section><!-- /.pt-5 pb-5 -->

<?php

get_footer();
