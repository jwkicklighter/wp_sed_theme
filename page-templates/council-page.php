<?php
/**
 * Template Name: Council Page
 *
 * @package Sela
 */

get_header(); ?>

<?php

	// $users = new WP_User_Query( array(
	// 	'fields' => 'all_with_meta',
	// 	'meta_query' => array(
	// 			array(
	// 				'key' => 'is_council',
	// 				'value' => '1',
	// 				'compare' => '='
	// 			)
	// 		),
	// 	'meta_key' => 'council_order',
	// 	'orderby' => 'meta_value'
	// 	)
	// );

?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'content', 'hero' ); ?>

	<?php endwhile; ?>

	<?php //rewind_posts(); ?>


	<div class="content-wrapper full-width resources-page <?php echo sela_additional_class(); ?>">
		<div id="primary" class="content-area">
			<div id="content" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>

					<?php //get_template_part( 'content', 'page' ); ?>
						<?php
							// foreach ( $users->results as $user ) {
							// 	echo '<div class="council-bio-content">';
							// 	echo '<h2>' . $user->first_name . ' ' . $user->last_name . ' - ' . display_user_role($user) . '</h2>';
							// 	echo '<hr />';
							// 	echo '<div class="img">' . get_wp_user_avatar($user->ID, '260', 'left') . '</div>';
							// 	echo '<p>' . $user->description . '</p>';
							// 	echo '</div>';
							// }
						?>
				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->
	</div><!-- .content-wrapper -->

<?php get_footer(); ?>
