<?php
/* 
Plugin Name: Travesuras
Description: Functions and modifications to match site requirements
Version:     1.0
Author:      Sebastian Guerrero
*/

// Script hooks.
add_action( 'wp_enqueue_scripts', 'travesuras_scripts' );

 
function travesuras_scripts () {
	wp_enqueue_script ( 'travesuras-js', plugins_url('/js/script.js', __FILE__), array('jquery'),  rand(111,9999), 'all' );
	wp_enqueue_style ( 'travesuras',  plugins_url('/css/main.css', __FILE__), array(),  rand(111,9999), 'all' );
	wp_enqueue_style ( 'travesuras-mobile',  plugins_url('/css/mobile.css', __FILE__), array(),  rand(111,9999), 'all' );

	wp_localize_script( 'travesuras-js', 'ajax_params', array('ajax_url' => admin_url( 'admin-ajax.php' )));

	// if(is_page(35)) {
	// 	wp_enqueue_script('jquery-validate', 'https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js', array('jquery'), '1.10.0',	true);
	// }
}

/************************************************************/
/********************* Helper functions *********************/
/************************************************************/

function travesuras_load_template($template, $folder = '') {
	// first check if this is the page where you want to render your own template
	// if ( !is_page($the_page_you_want)) {
		// return $template;
	// }

	// get the actual file name, like single.php or page.php
	$filename = basename($template);
	if(!empty($folder) && strpos($folder, '/') !== 0) {
		$folder = '/' . $folder;
	}
	
	// build a path for the filename in a folder named for our plugin "fisherman" in the theme folder
	$custom_template = sprintf('%s/%s%s/%s', get_stylesheet_directory(), 'travesuras', $folder, $filename);

	// if the template is found, awesome! return it. that's what we'll use.
	if ( is_file($custom_template) ) {
		return $custom_template;
	}

	// otherwise, build a path for the filename in a folder named "templates" in our plugin folder
	$custom_template = travesuras_file_build_path(plugin_dir_path( __FILE__ ), 'templates', $folder, $filename);
	//$custom_template = sprintf('%stemplates%s/%s', plugin_dir_path( __FILE__ ), $folder, $filename);

	// found? return our plugin's default template
	if ( is_file($custom_template) ) {
		return $custom_template;
	}
	
	// otherwise, build a path for the filename in a folder named "templates" in our plugin folder
	$custom_template = sprintf('%stemplates/%s', plugin_dir_path( __FILE__ ), $filename);

	// found? return our plugin's default template
	if ( is_file($custom_template) ) {
		return $custom_template;
	}
	
	return $template;
}

function travesuras_file_build_path(...$segments) {
	return join(DIRECTORY_SEPARATOR, $segments);
}


/************************************************************/
/********************** Home functions **********************/
/************************************************************/

function travesuras_build_home_html ( $lang ) {
	$template_url = travesuras_load_template('inventario-example.php', 'comerssia-xml');
	load_template($template_url, true);
}

add_shortcode( 'travesuras_home', 'travesuras_build_home_html' );