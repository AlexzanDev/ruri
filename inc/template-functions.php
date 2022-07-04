<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ruri_body_classes( $classes ) {
	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ruri_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ruri_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ruri_pingback_header' );

/**
 * Custom error message on login.
 */
function ruri_login_error() {
	return 'Wrong login credentials.';
}
add_filter( 'login_errors', 'ruri_login_error' );

/**
 * Link logo on the login page to the website.
 */
function ruri_login_logo() {
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'ruri_login_logo' );
