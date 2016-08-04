<?php
require_once(__DIR__ . "/acf/fields.php");
require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/vendor/trampoline-digital/wp-scss/wp-scss.php' );
require_once(__DIR__ . '/kirki.php');
$timber = new \Timber\Timber();


// Create our version of the TimberSite object
class StarterSite extends Timber\Site {

	// This function applies some fundamental WordPress setup, as well as our functions to include custom post types and taxonomies.
	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'init', array( $this, 'register_widgets' ) );
		parent::__construct();
	}

	// Abstracting long chunks of code.

	// The following included files only need to contain the arguments and register_whatever functions. They are applied to WordPress in these functions that are hooked to init above.

	// The point of having separate files is solely to save space in this file. Think of them as a standard PHP include or require.

	function register_post_types(){
		require('lib/custom-types.php');
	}

	function register_taxonomies(){
		require('lib/taxonomies.php');
	}

	function register_menus(){
		require('lib/menus.php');
	}

	function register_widgets(){
		require('lib/widgets.php');
	}


	// Access data site-wide.

	// This function adds data to the global context of your site. In less-jargon-y terms, any values in this function are available on any view of your website. Anything that occurs on every page should be added here.

	function add_to_context( $context ) {

		// Our menu occurs on every page, so we add it to the global context.
		$context['menu'] = new Timber\Menu();
		$context['blog_link'] = get_permalink( get_option( 'page_for_posts' ) );

		// This 'site' context below allows you to access main site information like the site title or description.
		$context['site'] = $this;
		return $context;
	}


	// Here you can add your own fuctions to Twig. Don't worry about this section if you don't come across a need for it.
	// See more here: http://twig.sensiolabs.org/doc/advanced.html
	/**
	 * @param $twig Twig_Environment
	 *
	 * @return mixed
	 */
	function add_to_twig( $twig ) {
		function youtube_embed($watch_url) {
			$src = str_replace("watch?v=", "embed/",$watch_url);
			return "<iframe src='$src'></iframe>";
		}

		/**
		 * @param $items array
		 *
		 * @return array
		 */
		function bootstrap_loop($items){
			$i = 0;
			$len = count($items);
			foreach ($items as $key => $item){
				$items[$key]['bootstrap_class'] = "col-sm-6 col-md-4";
				// If last one
				if ($i == $len-1 ){
					// a1 If 1 extra
					if ($len%3 == 1) {
						$items[$key]['bootstrap_class'] .=" a1 col-md-offset-4 ";
					}

				}
				$i++;
			}
			return $items;
		}

		function avatar($user_id, $size){
			return get_avatar_url( $user_id, array(), null);
		}


		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( new Twig_SimpleFilter( 'youtube' , 'youtube_embed') );
		$twig->addFilter( new Twig_SimpleFilter( 'bootstrap_col', 'bootstrap_loop' ) );
		$twig->addFilter( new Twig_SimpleFilter('avatar', 'avatar'));

		return $twig;
	}
}

new StarterSite();


/*
 *
 * My Functions (not from Timber)
 *
 */

// Enqueue scripts
function my_scripts() {

	// Use jQuery from a CDN
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), null, true);
	wp_enqueue_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'modernizer', get_template_directory_uri() ."/assets/js/modernizr.js", array('jquery') );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() ."/assets/js/magnific-popup/jquery.magnific-popup.min.js", array('jquery') );
	wp_enqueue_script( 'custom', get_template_directory_uri() ."/assets/js/custom.js", array('jquery') );

	// Enqueue our stylesheet and JS file with a jQuery dependency.
	// Note that we aren't using WordPress' default style.css, and instead enqueueing the file of compiled Sass.
	wp_enqueue_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css');
	wp_enqueue_style( 'et-line-fonts', get_template_directory_uri() . '/assets/css/et-line-fonts.css', 1.0);
	wp_enqueue_style( 'sol-styles', get_template_directory_uri() . '/assets/scss/global.scss', 1.0);
	wp_enqueue_style( 'et-line-fonts', get_template_directory_uri() . '/assets/css/et-line-fonts.css', 1.0);
//	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup/magnific-popup.css', 1.0);
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css', 1.0);

	wp_enqueue_style('google-fonts-1', 'https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700');
    wp_enqueue_style('google-fonts-2', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800');
}

add_action( 'wp_enqueue_scripts', 'my_scripts' );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

register_sidebar( array(
	'id'          => 'blog_sidebar',
	'name'        => 'Blog Sidebar',
	'description' => 'This is the sidebar for the blog',
) );


register_sidebar( array(
	'id'          => 'general_sidebar',
	'name'        => 'General Sidebar',
	'description' => 'This is the sidebar misc pages',
) );