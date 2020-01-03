<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});

	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});

	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site {
	/** Add timber support. */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	public function register_post_types() {

	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies() {

	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new Timber\Menu();
		$context['site'] = $this;
		return $context;
	}

	public function theme_supports() {
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
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support( 'menus' );
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo( $text ) {
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( new Twig_SimpleFilter( 'myfoo', array( $this, 'myfoo' ) ) );
		return $twig;
	}

}

new StarterSite();


/**
 * Copied this code from Sage for getting assets from manifest.json
 *
 */
class JsonManifest {
	private $manifest;
  
	public function __construct($manifest_path) {
	  if (file_exists($manifest_path)) {
		$this->manifest = json_decode(file_get_contents($manifest_path), true);
	  } else {
		$this->manifest = [];
	  }
	}
  
	public function get() {
	  return $this->manifest;
	}
  
	public function getPath($key = '', $default = null) {
	  $collection = $this->manifest;
	  if (is_null($key)) {
		return $collection;
	  }
	  if (isset($collection[$key])) {
		return $collection[$key];
	  }
	  foreach (explode('.', $key) as $segment) {
		if (!isset($collection[$segment])) {
		  return $default;
		} else {
		  $collection = $collection[$segment];
		}
	  }
	  return $collection;
	}
}

function asset_path($filename) {
	$dist_path = get_template_directory_uri() . '/dist/';
	$directory = dirname($filename) . '/';
	$file = basename($filename);
	static $manifest;
  
	if (empty($manifest)) {
	  $manifest_path = get_template_directory() . '/manifest.json';
	  $manifest = new JsonManifest($manifest_path);
	}
	
	if($manifest->get() != null){
		if (array_key_exists($file, $manifest->get())) {
		return $dist_path . $directory . $manifest->get()[$file];
		} else {
		return $dist_path . $directory . $file;
		}
	}else {
		return $dist_path . $directory . $file;
	}
}

/**
 * Theme assets
 */
function assets() {
    wp_enqueue_style('sage/css', asset_path('css/app.min.css'), false, null);
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script('sage/js', asset_path('js/app.min.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);



/**
 * Load jQuery from jQuery's CDN with a local fallback
 *
 * You can enable/disable this feature in functions.php (or lib/setup.php if you're using Sage):
 * add_theme_support('soil-jquery-cdn');
 */
function register_jquery() {
  $jquery_version = wp_scripts()->registered['jquery']->ver;
  wp_deregister_script('jquery');
  wp_register_script(
    'jquery',
    'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js',
    [],
    null,
    true
  );
  add_filter('wp_resource_hints', function ($urls, $relation_type) {
    if ($relation_type === 'dns-prefetch') {
      $urls[] = 'ajax.googleapis.com';
    }
    return $urls;
  }, 10, 2);
  //add_filter('script_loader_src', __NAMESPACE__ . '\\jquery_local_fallback', 10, 2);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\register_jquery', 100);

/** 
 * END
 * Copied this code from Sage for getting assets from manifest.json
 */
function customAdmin() {
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/css/uikit.min.css" />
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@3.2.3/dist/js/uikit-icons.min.js"></script>';

	
	echo '<link rel="stylesheet" href="/app/themes/template-builder/admin.css" />';
}
add_action('admin_head', 'customAdmin');

add_action('acf/register_fields', 'register_fields');

function my_register_fields()
{
	include_once('acf-image-select/acf-image-select.php');
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Site Options',
		'menu_title'	=> 'Site Options',
		'menu_slug' 	=> 'acf-options-site-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Exception Message',
		'menu_title'	=> 'Exception Message',
		'parent_slug'	=> 'acf-options-site-options',
	));
	
}

add_filter( 'timber_context', 'mytheme_timber_context'  );

function mytheme_timber_context( $context ) {
    $context['options'] = get_fields('option');
    return $context;
}

function get_menu( $menu_name ) {
	return new Timber\Menu($menu_name);
}

function wp_example_excerpt_length( $length ) {
    return 12;
}
add_filter( 'excerpt_length', 'wp_example_excerpt_length');