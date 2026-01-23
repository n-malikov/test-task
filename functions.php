<?php
/**
 * test-task functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package test-task
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test_task_setup() {

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'test-task' ),
		)
	);

}
add_action( 'after_setup_theme', 'test_task_setup' );

/**
 * Enqueue scripts and styles.
 */
function test_task_scripts() {

    // Bootstrap
    wp_enqueue_style(
        'bootstrap-css',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        [],
        '5.3.8'
    );

    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
        [],
        '5.3.8',
        true
    );

	wp_enqueue_style( 'test-task-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_script( 'test-task-app', get_template_directory_uri() . '/assets/js/app.js', array(), _S_VERSION, true );



}
add_action( 'wp_enqueue_scripts', 'test_task_scripts' );


require_once get_template_directory() . '/inc/post-types/doctors.php';
require_once get_template_directory() . '/inc/taxonomies/specialization.php';
