<?php

// enqueue the child theme stylesheet

Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);
add_filter( 'wp_edit_nav_menu_walker', 'sample_edit_nav_menu_walker');
function sample_edit_nav_menu_walker( $walker ) {
    return 'qode_type1_walker_nav_menu'; // this is the class name
}
if(function_exists('bwp_minify')){
	add_action( 'wp_enqueue_scripts', 'qode_google_fonts_styles' );
	add_action( 'wp_enqueue_scripts', 'qode_styles' );
	add_action( 'wp_enqueue_scripts', 'qode_google_fonts_styles' );
	add_action( 'wp_enqueue_scripts', 'qode_scripts' );
	
}