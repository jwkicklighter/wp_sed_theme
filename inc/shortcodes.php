<?php

// Council Member Photo
function council_member_shortcode( $atts, $content = null ) {
	$a = shortcode_atts( array(
    'name' => '',
		'position' => '',
    'img_url' => ''
	), $atts );

  if ($a['img_url'] == '' || $a['name'] == '' || $a['position'] == '') {
    return;
  } else {
    $name = $a['name'];
    $position = $a['position'];
    $url = $a['img_url'];

	  $section_start = '<div class="council-bio-content">';
    $header = '<h2>' . $name . ' - ' . $position . '</h2><hr />';
    $img = '<div class="img"> <img src="' . $url . '" class="alignleft" width="200" height="250" /> </div>';
	  $section_end = '</div>';

	  return $section_start . $header . $img . wpautop($content) . $section_end;
  }
}
add_shortcode( 'council_member', 'council_member_shortcode' );


// Shortcode Helper
function shortcode_helper( $atts, $content = null ) {
	echo '<br /><div class="postbox-container">';
	echo '<div class="postbox">';
	echo '<h3 class="hndle">SED Shortcode Examples</h3>';
	echo '<div class="inside">';

		echo '<h4 style="margin-bottom: 5px;">Council Bio</h4>';
		echo '[council_member name="Bohumil Makovsky" position="Guiding Spirit" img_url="http://website.com/boh_pic.jpg"]';

	echo '</div></div></div>';
}
add_action( 'edit_form_after_editor', 'shortcode_helper' );

// Helper function for dealing with <p> tags in recursive shortcodes
function parse_shortcode_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}

function blank($title) {
	return '%s';
}
add_filter('protected_title_format', 'blank');
