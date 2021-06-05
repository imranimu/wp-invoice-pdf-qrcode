<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SalimBrothers
 */

get_header();
?>
 
	<section class="col_wrap pt-5 pb-5">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content', get_post_type() );

							the_post_navigation(
								array(
									'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'salimbrothers' ) . '</span> <span class="nav-title">%title</span>',
									'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'salimbrothers' ) . '</span> <span class="nav-title">%title</span>',
								)
							);

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
	</section><!-- /.col_wrap -->	 

<?php

get_footer();
