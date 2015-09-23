<?php
/**
 * sela functions and definitions
 *
 * @package Sela
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 620; /* pixels */
}

/**
 * Adjusts content_width value for few pages and attachment templates.
 */
function sela_content_width() {
	global $content_width;

	if ( is_page_template( 'page-templates/full-width-page.php' )
	  || is_page_template( 'page-templates/grid-page.php' )
	  || is_attachment()
	  || ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 778;
	}
}
add_action( 'template_redirect', 'sela_content_width' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function sela_setup() {

	load_theme_textdomain( 'sela', get_template_directory() . '/languages' );

	add_editor_style( array( 'editor-style.css', sela_fonts_url() ) );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'link', 'quote','video' ) );

	register_nav_menus( array(
		'primary'	=> __( 'Primary Menu', 'sela' ),
		'social'	=> __( 'Social Menu', 'sela' ),
	) );

	add_theme_support( 'post-thumbnails' );

	// Post thumbnails
	set_post_thumbnail_size( 820, 312, true );
	// Hero Image on the front page template
	add_image_size( 'sela-hero-thumbnail', 1180, 610, true );
	// Full width and grid page template
	add_image_size( 'sela-page-thumbnail', 1180, 435, true );
	// Grid child page thumbnail
	add_image_size( 'sela-grid-thumbnail', 360, 242, true );
	// Testimonial thumbnail
	add_image_size( 'sela-testimonial-thumbnail', 90, 90, true );

	add_post_type_support( 'page', 'excerpt' );

	add_theme_support( 'custom-background', apply_filters( 'sela_custom_background_args', array(
		'default-color' => 'fafafa',
	) ) );


	// SED Custom Roles
	add_role( 'pres', 'President' );
	add_role( 'vp', 'Vice President' );
	add_role( 'sec', 'Secretary/Treasurer' );
	add_role( 'ml', 'Member at Large' );
	add_role( 'gov', 'Governor' );

}
add_action( 'after_setup_theme', 'sela_setup' );

function display_user_role( $user )
{
	$user_roles = $user->roles;
	$user_role = array_shift($user_roles);

	if ($user_role == 'pres') {
		return 'President';
	} elseif ($user_role == 'vp') {
		return 'Vice President';
	} elseif ($user_role == 'sec') {
		return 'Secretary/Treasurer';
	} elseif ($user_role == 'ml') {
		return 'Member at Large';
	} elseif ($user_role == 'gov') {
		return 'Governor';
	}
}


/**
 * Custom SED User Meta
 */

remove_filter( 'pre_user_description' , 'wp_filter_kses' );


add_action( 'show_user_profile', 'add_council_meta' );
add_action( 'edit_user_profile', 'add_council_meta' );

function add_council_meta( $user )
{
    ?>
      <h3>Council Information</h3>

      <table class="form-table">
        <tr>
          <th><label for="is_council">Is this user a member of the council? (1=yes, 0=no)</label></th>
          <td><input type="text" name="is_council" value="<?php echo esc_attr(get_the_author_meta( 'is_council', $user->ID )); ?>" class="number" /></td>
        </tr>
        <tr>
          <th><label for="council_order">Council Sort Order</label></th>
          <td><input type="text" name="council_order" value="<?php echo esc_attr(get_the_author_meta( 'council_order', $user->ID )); ?>" class="number" /></td>
        </tr>
      </table>
    <?php
}

add_action( 'personal_options_update', 'save_council_meta' );
add_action( 'edit_user_profile_update', 'save_council_meta' );

function save_council_meta( $user_id )
{
    update_user_meta( $user_id,'is_council', sanitize_text_field( $_POST['is_council'] ) );
    update_user_meta( $user_id,'council_order', sanitize_text_field( $_POST['council_order'] ) );
}


/**
 * Returns the Google font stylesheet URL, if available.
 */
function sela_fonts_url() {
	$fonts_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Source Sans Pro, translate this to 'off'. Do not translate into your own language.
	 */
	$source_sans_pro  = _x( 'on', 'Source Sans Pro font: on or off',  'sela' );

	/* translators: If there are characters in your language that are not supported
	 * by Droid Serif, translate this to 'off'. Do not translate into your own language.
	 */
	$droid_serif = _x( 'on', 'Droid Serif font: on or off', 'sela' );

	/* translators: If there are characters in your language that are not supported
	 * by Oswald, translate this to 'off'. Do not translate into your own language.
	 */
	$oswald  = _x( 'on', 'Oswald font: on or off',  'sela' );

	if ( 'off' !== $source_sans_pro || 'off' !== $droid_serif || 'off' !== $oswald ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro ) {
			$font_families[] = 'Source Sans Pro:300,400,400italic,600';
		}
		if ( 'off' !== $droid_serif ) {
			$font_families[] = 'Droid Serif:400,400italic';
		}
		if ( 'off' !== $oswald ) {
			$font_families[] = 'Oswald:300,400';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function sela_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'sela' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'First Footer Sidebar', 'sela' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Second Footer Sidebar', 'sela' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Third Footer Sidebar', 'sela' ),
		'id'            => 'sidebar-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'First Front Page Sidebar', 'sela' ),
		'id'            => 'sidebar-5',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Second Front Page Sidebar', 'sela' ),
		'id'            => 'sidebar-6',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Third Front Page Sidebar', 'sela' ),
		'id'            => 'sidebar-7',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'sela_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function sela_scripts_styles() {
	// Add Oswald, Source Sans Pro and Droid Serif fonts.
	wp_enqueue_style( 'sela-fonts', sela_fonts_url(), array(), null );

	// Add Genericons font.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '3.3' );

	// Load the main stylesheet.
	wp_enqueue_style( 'sela-style', get_stylesheet_uri() );

	wp_enqueue_script( 'sela-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20140813', true );

	wp_enqueue_script( 'sela-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20140813', true );

	wp_enqueue_script( 'sela-script', get_template_directory_uri() . '/js/sela.js', array(), '20140813', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'sela-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130922' );
	}
}
add_action( 'wp_enqueue_scripts', 'sela_scripts_styles' );

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 */
function sela_admin_fonts() {
	wp_enqueue_style( 'sela-fonts', sela_fonts_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'sela_admin_fonts' );

/**
 * Remove Gallery Inline Styling
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Header features.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// updater for WordPress.com themes
if ( is_admin() )
	include dirname( __FILE__ ) . '/inc/updater.php';
