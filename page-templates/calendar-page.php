<?php
/**
 * Template Name: Calendar Page
 *
 * @package Sela
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'hero' ); ?>

	<?php endwhile; ?>

	<?php rewind_posts(); ?>


	<div class="content-wrapper full-width calendar-page <?php echo sela_additional_class(); ?>">
		<div id="primary" class="content-area">
			<div id="content" class="site-main" role="main">

				<?php //while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'calendar' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						//if ( comments_open() || '0' != get_comments_number() ) {
						//	comments_template();
						//}
					?>

				<?php //endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .content-wrapper -->

<?php get_footer(); ?>