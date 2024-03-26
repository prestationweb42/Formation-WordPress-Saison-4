<?php

/**===============
 * Scripts Loading
 */

/**=====================
 * Version Script Number
 */
define('CHILD_VERSION', '1.0.2');

/**===============================
 * Load Styles / Scripts Front End
 */
function child_enqueue_styles()
{
	// Bootstrap 5 Styles
	wp_enqueue_style('child-bootstrap-style', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), CHILD_VERSION, 'all');
	// Animate Animation Styles
	if (is_front_page()) {
		wp_enqueue_style('child-animate-style', get_stylesheet_directory_uri() . '/css/animate.min.css', array(), CHILD_VERSION, 'all');
	}
	// Custom Styles
	wp_enqueue_style('child-main-style', get_stylesheet_directory_uri() . '/sass/style.css', array('child-bootstrap-style'), CHILD_VERSION, 'all');
	// Scripts
	wp_enqueue_script('child-main-script-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), CHILD_VERSION, true);
	wp_enqueue_script('child-main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), CHILD_VERSION, true);
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles');

/**=========================================
 * Load Styles / Scripts - Dashboard / Admin
 */
function dvmac_admin_init()
{
	// Action 1
	function dvmac_admin_init_bootstrap()
	{
		// Styles Bootstrap only on Page Options
		if (!isset($_GET['page']) || $_GET['page'] != 'dvmac_theme_opts') {
			return;
		}
		wp_enqueue_style('admin-style-bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), CHILD_VERSION, 'all');

		// Options Media 
		wp_enqueue_media();
		wp_enqueue_script('admin-script-media', get_template_directory_uri() . '/js/admin-options.js', array(), CHILD_VERSION, true);
	}
	add_action('admin_enqueue_scripts', 'dvmac_admin_init_bootstrap');
	// Action 2
	include_once('includes/save-options-page.php');
	add_action('admin_post_dvmac_save_options', 'dvmac_save_options');
}
add_action('admin_init', 'dvmac_admin_init');

/**===================
 * Activation Options
 */
function dvmac_activ_options()
{
	$theme_opts = get_option('dvmac_opts');
	if (!$theme_opts) {
		$opts = array(
			'img_01_url' => '',
			'legend_01' => '',
		);
		add_option('dvmac_opts', $opts);
	}
}
add_action('after_switch_theme', 'dvmac_activ_options');

/**============================
 * Menu Options Dashboard Theme
 */
function dvmac_admin_options_menu_dashboard()
{
	add_menu_page(
		'Mes Options',
		'Options du thème',
		'publish_pages',
		'dvmac_theme_opts',
		'dvmac_build_options_page',
	);
	include_once('includes/options-page.php');
}
add_action('admin_menu', 'dvmac_admin_options_menu_dashboard');

/**=========================================
 * Init and Add Sidebar and Widget -> Footer
 */
function dvmac_widgets_init()
{
	register_sidebar(array(
		'name'          => __('Footer Widget Zone'),
		'description'   => __('Widgets display in the footer on all posts and pages max 4'),
		'id'            => 'footer-widget',
		'before_widget' => '<div id="%1$s" class="col-sm-12 col-md-6 col-lg-3 mb-sm-4 mb-lg-0 %2$s"><div class="inset-widget">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="text-center text-uppercase display-3">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'dvmac_widgets_init');

/**==========================
 * Add custom functions
 */
function child_enqueue_functions()
{
	// Image mise en avant
	add_theme_support('post-thumbnails');

	// Custom Slider Img Size
	add_image_size('front-slider-img', 1140, 420, true);

	// Library bootstrap-navwalker for the menu
	// require_once('includes/wp-bootstrap-navwalker.php');

	// Title Tag
	add_theme_support('title-tag');

	// Remove Generator Wordpress Version
	remove_action('wp_head', 'wp_generator');

	// Remove French guillement
	remove_filter('the_content', 'wptexturize');
}
add_action('after_setup_theme', 'child_enqueue_functions');

/**=====================
 * Add Size Medium Large
 */
function add_medium_large($sizes)
{
	$addsizes = array(
		"medium_large" => "Medium Large"
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
};
add_filter('image_size_names_choose', 'add_medium_large');

/**======================
 * Include Menu Navwalker 
 */
require_once('includes/bs5_Walker.php');

/**====================================================
 * Function list article -> date, category, tag, author 
 */
function display_attributs_articles($datetime, $cat, $tag, $author, $comment)
{
	$chaine = 'Publié le : ';
	$chaine .= $datetime;
	$chaine .= ', catégorie : ';
	$chaine .= $cat;
	// if is not Tag
	if (strlen($tag) > 0) :
		$chaine .= ', étiquette : ';
		$chaine .= $tag;
	else :
		$chaine .= ', pas d\'étiquette : ';
	endif;
	$chaine .= ', auteur : ';
	$chaine .= $author;
	// if is not commentaires
	if (strlen($comment) === 0) :
		$chaine .= ', commentaires : ';
		$chaine .= $comment;
	else :
		$chaine .= ', aucun commentaire pour l\'instant.';
	endif;
	return $chaine;
}

/**======================
 * Include Excerpt lenght 
 */
require_once('includes/excerpt.php');

/**==================
 * Include short code
 */
require_once('includes/short-code.php');

/**==================
 * Include Slider Post Type
 */
require_once('includes/slider-post-type.php');
