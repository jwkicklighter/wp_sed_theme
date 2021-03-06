<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @package Sela
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="//cdn.jsdelivr.net/jquery/2.1.3/jquery.min.js"></script>

<!-- Calendar -->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.0/fullcalendar.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.0/gcal.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.0/fullcalendar.min.css" type="text/css">
<link rel="print" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.0/fullcalendar.print.css" type="text/css">

<?php wp_enqueue_script('custom_functions', get_template_directory_uri() . '/js/custom-functions.js'); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<a class="skip-link screen-reader-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'sela' ); ?>"><?php _e( 'Skip to content', 'sela' ); ?></a>

		<div class="site-branding">
			<?php sela_the_site_logo(); ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php if ( '' != get_bloginfo( 'description' ) ) : ?>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="menu" aria-expanded="false"><?php _e( 'Menu', 'sela' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
