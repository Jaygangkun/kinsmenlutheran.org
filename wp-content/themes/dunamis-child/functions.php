<?php

add_action( 'wp_print_styles', 'cro_deregister_styles', 100 );

function cro_deregister_styles() {
	wp_deregister_style( 'cro-stylesheet' );
}


add_action( 'wp_enqueue_scripts', 'croma_fetch_mystyle' );

function croma_fetch_mystyle() {
	wp_enqueue_style('croma_mystyle', get_stylesheet_directory_uri() . '/style.css', array(), null, 'all');
	$custom_css = cromatheme_get_theme_css();
    wp_add_inline_style( 'croma_mystyle', $custom_css);
}

?>