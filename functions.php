<?php
    include 'meta.php';

// This file is not to be checked in.
$func_custom = TEMPLATEPATH . '/functions-custom.php';
if ( is_readable( $func_custom ) )
    include_once( $func_custom );

function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// Remove link rel="start" from blog pages
remove_action('wp_head', 'start_post_rel_link'); // Removes the start link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Removes rel="parent"
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Removes rel="next"/rel="prev"
remove_action('wp_head', 'feed_links_extra', 3); // remove default feed links

if (function_exists('register_sidebar')){

register_sidebar(array('before_widget' => '<div class="widget">', 'after_widget' => '</div>'));

register_sidebar(array(
	'name' => 'Single Post',
	'description' => 'Widgets in this area will only appear on single posts',
	'before_widget' => '<div class="widget">',
	'after_widget' => '</div>',
	'before_title' => '<h2>',
	'after_title' => '</h2>'));
	
register_sidebar(array(
		'name' => 'Footer Copyright Notice',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
		));

register_sidebar(array(
		'name' => 'Frontpage Content Block Left',
		'before_widget' => '',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3><div class="content">'
		));

register_sidebar(array(
		'name' => 'Frontpage Content Block Middle',
		'before_widget' => '',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3><div class="content">'
		));
	

register_sidebar(array(
		'name' => 'Frontpage Content Block Right',
		'before_widget' => '',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3><div class="content">'
		));
	
}



// Add ID and CLASS attributes to the first <ul> occurence in wp_page_menu
function add_menuclass($ulclass) {
return preg_replace('/<ul>/', '<ul class="nav main">', $ulclass, 1);
}
add_filter('wp_page_menu','add_menuclass');

/* CC Specific helper functions */
function cc_progress_total() {
  $campaign_total = file_get_contents(__DIR__ . '/../../../includes/total.txt');

  print $campaign_total;
}


/* Requests the first available page with the 'show_on_index' custom field */
function cc_get_sticky_page() {
	global $wpdb;

	$query = "
		SELECT posts.*
		FROM $wpdb->posts posts, $wpdb->postmeta postmeta
		WHERE posts.ID = postmeta.post_id
		AND postmeta.meta_key = 'show_on_index'
		AND postmeta.meta_value = 'yes'
		AND posts.post_status = 'publish'
		AND posts.post_type = 'page'
		ORDER BY posts.post_date ASC LIMIT 1";
	$page = $wpdb->get_row ($query);

	return $page;
}

/* Equivalent to WP's the_excerpt()
 * This version builds out excerpt sans html and entities, safe for use in meta tags.
 */
function cc_post_excerpt() {
	global $post;

	$excerpt = htmlentities(strip_tags($post->post_content));
	$excerpt_a = array_slice (explode(" ", $excerpt), 0, 55);
	echo implode(" ", $excerpt_a) . "...";
}

function cc_get_attachment($id) {
  return get_children('post_parent='.$id.'&post_type=attachment');
}



// Return the first image attachment for post $id, with width of $width
// Used for homepage sticky splash (630px), and featured commoners (150px)
function cc_get_attachment_image($id, $width) {
  if ($attachments = cc_get_attachment($id)) {
    foreach ($attachments as $attachment => $attachment_id) {
      $image = wp_get_attachment_image_src($attachment, full);
      
      // Check if the image is the requested width, and break if it is.
      if ($image[1] == $width) { break; }
    }
  }
  return $image;
}


function get_http_security () {
    echo 'http';
}

/** 
 * Is this IE 8 or less. Assumption is newer browser.
 * 
 * Needs browscap to work:
 * * http://www.php.net/manual/en/function.get-browser.php
 * * See README for more info
 *
 */
function is_not_old_ie () 
{
    /*
    $browser = get_browser(null, true);
    if ( (! ini_get("browscap") ) || empty($browser) || 
        ! ( preg_match('/IE/i', $browser[parent]) && $browser[majorver] <= 8 ) )
    */
    if(! preg_match('/MSIE [1-8]/i', $_SERVER['HTTP_USER_AGENT']))
    {
        return true;
    }
    else
        return false;
}

$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/cc-logo.png',
	'random-default'         => false,
	'width'                  => 200,
	'height'                 => 48,
	'flex-height'            => false,
	'flex-width'             => true,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );
?>
