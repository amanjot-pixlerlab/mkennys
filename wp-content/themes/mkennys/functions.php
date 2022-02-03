<?php

/**

 * Twenty Fifteen functions and definitions

 *

 * Set up the theme and provides some helper functions, which are used in the

 * theme as custom template tags. Others are attached to action and filter

 * hooks in WordPress to change core functionality.

 *

 * When using a child theme you can override certain functions (those wrapped

 * in a function_exists() call) by defining them first in your child theme's

 * functions.php file. The child theme's functions.php file is included before

 * the parent theme's file, so the child theme functions would be used.

 *

 * @link https://codex.wordpress.org/Theme_Development

 * @link https://codex.wordpress.org/Child_Themes

 *

 * Functions that are not pluggable (not wrapped in function_exists()) are

 * instead attached to a filter or action hook.

 *

 * For more information on hooks, actions, and filters,

 * {@link https://codex.wordpress.org/Plugin_API}

 *

 * @package WordPress

 * @subpackage Twenty_Fifteen

 * @since Twenty Fifteen 1.0

 */



/**

 * Set the content width based on the theme's design and stylesheet.

 *

 * @since Twenty Fifteen 1.0

 */

if ( ! isset( $content_width ) ) {

	$content_width = 660;

}



/**

 * Twenty Fifteen only works in WordPress 4.1 or later.

 */

if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {

	require get_template_directory() . '/inc/back-compat.php';

}



if ( ! function_exists( 'twentyfifteen_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 *

 * @since Twenty Fifteen 1.0

 */

function twentyfifteen_setup() {



	/*

	 * Make theme available for translation.

	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyfifteen

	 * If you're building a theme based on twentyfifteen, use a find and replace

	 * to change 'twentyfifteen' to the name of your theme in all the template files

	 */

	load_theme_textdomain( 'twentyfifteen' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Let WordPress manage the document title.

	 * By adding theme support, we declare that this theme does not use a

	 * hard-coded <title> tag in the document head, and expect WordPress to

	 * provide it for us.

	 */

	add_theme_support( 'title-tag' );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 825, 510, true );



	// This theme uses wp_nav_menu() in two locations.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu',      'twentyfifteen' ),

		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),

	) );



	/*

	 * Switch default core markup for search form, comment form, and comments

	 * to output valid HTML5.

	 */

	add_theme_support( 'html5', array(

		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'

	) );



	/*

	 * Enable support for Post Formats.

	 *

	 * See: https://codex.wordpress.org/Post_Formats

	 */

	add_theme_support( 'post-formats', array(

		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'

	) );



	/*

	 * Enable support for custom logo.

	 *

	 * @since Twenty Fifteen 1.5

	 */

	add_theme_support( 'custom-logo', array(

		'height'      => 248,

		'width'       => 248,

		'flex-height' => true,

	) );



	$color_scheme  = twentyfifteen_get_color_scheme();

	$default_color = trim( $color_scheme[0], '#' );



	// Setup the WordPress core custom background feature.



	/**

	 * Filter Twenty Fifteen custom-header support arguments.

	 *

	 * @since Twenty Fifteen 1.0

	 *

	 * @param array $args {

	 *     An array of custom-header support arguments.

	 *

	 *     @type string $default-color     		Default color of the header.

	 *     @type string $default-attachment     Default attachment of the header.

	 * }

	 */

	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(

		'default-color'      => $default_color,

		'default-attachment' => 'fixed',

	) ) );



	/*

	 * This theme styles the visual editor to resemble the theme style,

	 * specifically font, colors, icons, and column width.

	 */

	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );



	// Indicate widget sidebars can use selective refresh in the Customizer.

	add_theme_support( 'customize-selective-refresh-widgets' );

}

endif; // twentyfifteen_setup

add_action( 'after_setup_theme', 'twentyfifteen_setup' );



/**

 * Register widget area.

 *

 * @since Twenty Fifteen 1.0

 *

 * @link https://codex.wordpress.org/Function_Reference/register_sidebar

 */

function twentyfifteen_widgets_init() {

	register_sidebar( array(

		'name'          => __( 'Tour Schedule', 'twentyfifteen' ),

		'id'            => 'sidebar-1',

		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),

		'before_widget' => '<aside id="%1$s" class="widget %2$s">',

		'after_widget'  => '</aside>',

		'before_title'  => '<h2 class="widget-title">',

		'after_title'   => '</h2>',

	) );

}

add_action( 'widgets_init', 'twentyfifteen_widgets_init' );



if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :

/**

 * Register Google fonts for Twenty Fifteen.

 *

 * @since Twenty Fifteen 1.0

 *

 * @return string Google fonts URL for the theme.

 */

function twentyfifteen_fonts_url() {

	$fonts_url = '';

	$fonts     = array();

	$subsets   = 'latin,latin-ext';



	/*

	 * Translators: If there are characters in your language that are not supported

	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.

	 */

	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {

		$fonts[] = 'Noto Sans:400italic,700italic,400,700';

	}



	/*

	 * Translators: If there are characters in your language that are not supported

	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.

	 */

	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {

		$fonts[] = 'Noto Serif:400italic,700italic,400,700';

	}



	/*

	 * Translators: If there are characters in your language that are not supported

	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.

	 */

	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {

		$fonts[] = 'Inconsolata:400,700';

	}



	/*

	 * Translators: To add an additional character subset specific to your language,

	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.

	 */

	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );



	if ( 'cyrillic' == $subset ) {

		$subsets .= ',cyrillic,cyrillic-ext';

	} elseif ( 'greek' == $subset ) {

		$subsets .= ',greek,greek-ext';

	} elseif ( 'devanagari' == $subset ) {

		$subsets .= ',devanagari';

	} elseif ( 'vietnamese' == $subset ) {

		$subsets .= ',vietnamese';

	}



	if ( $fonts ) {

		$fonts_url = add_query_arg( array(

			'family' => urlencode( implode( '|', $fonts ) ),

			'subset' => urlencode( $subsets ),

		), 'https://fonts.googleapis.com/css' );

	}



	return $fonts_url;

}

endif;



/**

 * JavaScript Detection.

 *

 * Adds a `js` class to the root `<html>` element when JavaScript is detected.

 *

 * @since Twenty Fifteen 1.1

 */

function twentyfifteen_javascript_detection() {

	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";

}

add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );



/**

 * Enqueue scripts and styles.

 *

 * @since Twenty Fifteen 1.0

 */

function twentyfifteen_scripts() {

	// Add custom fonts, used in the main stylesheet.

	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );



	// Add Genericons, used in the main stylesheet.

	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );



	// Load our main stylesheet.

	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );



	// Load the Internet Explorer specific stylesheet.

	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );

	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );



	// Load the Internet Explorer 7 specific stylesheet.

	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );

	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );



	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}



	if ( is_singular() && wp_attachment_is_image() ) {

		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );

	}



	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );

	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(

		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',

		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',

	) );

}

add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );



/**

 * Add preconnect for Google Fonts.

 *

 * @since Twenty Fifteen 1.7

 *

 * @param array   $urls          URLs to print for resource hints.

 * @param string  $relation_type The relation type the URLs are printed.

 * @return array URLs to print for resource hints.

 */

function twentyfifteen_resource_hints( $urls, $relation_type ) {

	if ( wp_style_is( 'twentyfifteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {

		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {

			$urls[] = array(

				'href' => 'https://fonts.gstatic.com',

				'crossorigin',

			);

		} else {

			$urls[] = 'https://fonts.gstatic.com';

		}

	}



	return $urls;

}

add_filter( 'wp_resource_hints', 'twentyfifteen_resource_hints', 10, 2 );



/**

 * Add featured image as background image to post navigation elements.

 *

 * @since Twenty Fifteen 1.0

 *

 * @see wp_add_inline_style()

 */

function twentyfifteen_post_nav_background() {

	if ( ! is_single() ) {

		return;

	}



	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );

	$next     = get_adjacent_post( false, '', false );

	$css      = '';



	if ( is_attachment() && 'attachment' == $previous->post_type ) {

		return;

	}



	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {

		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );

		$css .= '

			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }

			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }

			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }

		';

	}



	if ( $next && has_post_thumbnail( $next->ID ) ) {

		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );

		$css .= '

			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }

			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }

			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }

		';

	}



	wp_add_inline_style( 'twentyfifteen-style', $css );

}

add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );



/**

 * Display descriptions in main navigation.

 *

 * @since Twenty Fifteen 1.0

 *

 * @param string  $item_output The menu item output.

 * @param WP_Post $item        Menu item object.

 * @param int     $depth       Depth of the menu.

 * @param array   $args        wp_nav_menu() arguments.

 * @return string Menu item with possible description.

 */

function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {

	if ( 'primary' == $args->theme_location && $item->description ) {

		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );

	}



	return $item_output;

}

add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );



/**

 * Add a `screen-reader-text` class to the search form's submit button.

 *

 * @since Twenty Fifteen 1.0

 *

 * @param string $html Search form HTML.

 * @return string Modified search form HTML.

 */

function twentyfifteen_search_form_modify( $html ) {

	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );

}

add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );



/**

 * Implement the Custom Header feature.

 *

 * @since Twenty Fifteen 1.0

 */

require get_template_directory() . '/inc/custom-header.php';



/**

 * Custom template tags for this theme.

 *

 * @since Twenty Fifteen 1.0

 */

require get_template_directory() . '/inc/template-tags.php';



/**

 * Customizer additions.

 *

 * @since Twenty Fifteen 1.0

 */

require get_template_directory() . '/inc/customizer.php';



function getStates(){	

global $wpdb;

$stateHtml='';

$state_sql = "select * from wp_state where is_delete='1' and status='1' ORDER BY id ASC";

$states = $wpdb->get_results($state_sql);

	foreach($states as $state){

	 $stateHtml .='<option '.$selected.' value="'.$state->state_name.'">'.$state->state_name.'</option>';

	}

return $stateHtml;

}



$ipaddressPageTitle=array();

function get_user_ip() {

        static $ip_address = null;



        if ( null === $ip_address ) {

            if ( getenv( 'HTTP_CLIENT_IP' ) ) {

                $ip_address = getenv( 'HTTP_CLIENT_IP' );

            } else if ( getenv( 'HTTP_X_FORWARDED_FOR' )  ) {

                $ip_address = getenv( 'HTTP_X_FORWARDED_FOR' );

            } else if ( getenv( 'HTTP_X_FORWARDED' ) ) {

                $ip_address = getenv( 'HTTP_X_FORWARDED' );

            } else if ( getenv( 'HTTP_FORWARDED_FOR' ) ) {

                $ip_address = getenv( 'HTTP_FORWARDED_FOR' );

            } else if ( getenv( 'HTTP_FORWARDED' ) ) {

                $ip_address = getenv( 'HTTP_FORWARDED' );

            } else if ( getenv( 'REMOTE_ADDR' ) ) {

                $ip_address = getenv( 'REMOTE_ADDR' );

            } else {

                $ip_address = 'UNKNOWN';

            }

        }

				//$page_title= get_the_title();

				//$ipaddressPageTitle['pageTitle']=$page_title;

				$ipaddressPageTitle['ipAddress']=$ip_address;

				//array($ipAddress=>$ip_address,$pageTitle=>$page_title);

		

        return $ipaddressPageTitle;

}



function checkIpAddress($page_title,$ipaddress){	

global $wpdb;

	if(!empty($page_title) && !empty($ipaddress) ){

		$existingPageTitle = "select * from wp_ipaddress where page_title ='".$page_title."'and ip_address ='".$ipaddress."'";

		$ip_page_data=$wpdb->get_results($existingPageTitle);



		if(count($ip_page_data)==0){	

		$sql="INSERT INTO `wp_ipaddress` (`ip_address`, `page_title`) VALUES('".$ipaddress."', '".$page_title."')";

			if($wpdb->query($sql)){

				$result=true;	

			} 	

			

		}else{	

			$result=false;	

		}

	}

return $result;

}



function mailpoet_shortcodes_custom_filter( $tag_value , $user_id) {

    // $tag_value contains the string after custom:

    // This function will be called the first time with $tag_value = my_name

    // The second time with $tag_value = blog_name

    // $user_id contains the corresponding MailPoet's subscriber id,

    // this could be useful to fetch extra data from the WordPress user's meta for instance

    // e.g.: https://gist.github.com/benheu/cf9eb925b0e17e6dbd6c

	





    if ($tag_value === 'cf_2') {

        global $wpdb;

		$mpQuery = "select * from wp_wysija_user where user_id = ".$user_id;

		$userdata = $wpdb->get_row($mpQuery); 	       

        

      

        $replacement = $userdata->cf_2;

    }



    return $replacement;

}

add_filter('wysija_shortcodes', 'mailpoet_shortcodes_custom_filter',10 ,2);

function remove_core_updates(){

global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);

}

add_filter('pre_site_transient_update_core','remove_core_updates');

add_filter('pre_site_transient_update_plugins','remove_core_updates');

add_filter('pre_site_transient_update_themes','remove_core_updates');





remove_action('template_redirect', 'redirect_canonical');

add_shortcode( 'footer_template', 'footer_template_func' );
function footer_template_func() {
	require_once( get_stylesheet_directory() . '/page-templates/footer-template.php' ); 
} 

add_shortcode( 'my_tour_schedule', 'my_tour_schedule' );
function my_tour_schedule() {
	require_once( get_stylesheet_directory() . '/page-templates/upcoming_tourschedule_shortcode.php' ); 
} 

