<?php

add_action( 'after_setup_theme', 'child_theme_setup_before_parent', 0 );
add_action( 'after_setup_theme', 'child_theme_setup1', 11 );
add_action( 'after_setup_theme', 'child_theme_setup2', 14 );

function child_theme_setup_before_parent() {
	if ( ! defined( 'SCRIPT_DEBUG' ) ) {
		define( 'SCRIPT_DEBUG', false );
	}
}

function child_theme_setup1() {

	// Register site styles and scripts
	add_action( 'wp_enqueue_scripts', 'child_theme_register_styles' );

	// Enqueue site styles and scripts
	add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

	add_filter( 'hybopress_hide_page_background', 'child_theme_hide_page_background', 11 );

	remove_theme_support( 'theme-layouts' );

	add_theme_support(
		'theme-layouts',
		array(
			'1c-narrow' => __( '1 Column Narrow', 'tidy' )
		),
		array(
			'default' => '1c-narrow', 'customizer' => true, 'customize'  => false,
		)
	);

}

function child_theme_setup2() {
	//removing featured image
	remove_action( 'hybopress_the_featured_image', 'hybopress_do_the_featured_image' );

	//adding above Header of entry
	add_action( 'hybopress_entry', 'hybopress_do_the_featured_image', 5 );

	add_filter( 'hybopress_use_cache', 'child_theme_use_cache' );
}

function child_theme_hide_page_background( $show_hide ) {
	return false;
}

function child_theme_use_cache( $use_cache ) {
	return true;
}

function child_theme_register_styles() {

	wp_register_style( 'child-fonts', '//fonts.googleapis.com/css?family=Chewy:400|Muli:400,700' );

	$main_styles = trailingslashit( CHILD_THEME_URI ) . "assets/css/child-style.css";

	wp_register_style(
		sanitize_key(  'child-style' ), esc_url( $main_styles ), array( 'skin' ), PARENT_THEME_VERSION, esc_attr( 'all' )
	);

}

function child_theme_enqueue_styles() {
	wp_enqueue_style( 'child-fonts' );
	wp_enqueue_style( 'child-style' );
}
