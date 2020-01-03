<?php

/**
 * Theme assets
 */
function child_asset_path($filename) {
	$dist_path = get_stylesheet_directory_uri() . '/dist/';
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

function parent_asset_path($filename) {
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

function childAssets() {
	wp_enqueue_style('sage/css', parent_asset_path('css/app.min.css'), false, null);
    wp_enqueue_style('child-sage/css', child_asset_path('css/app.min.css'), false, null);
    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
	wp_enqueue_script('child-sage/js', child_asset_path('js/app.min.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'childAssets', 10);