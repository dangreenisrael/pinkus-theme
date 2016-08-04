<?php
/**
 * Kirki customizer stuff.
 * User: Dan
 * Date: 07/07/2016
 * Time: 10:44
 */
require_once (__DIR__."/vendor/kirki/kirki.php");

if ( ! function_exists( 'my_theme_kirki_update_url' ) ) {
    function my_theme_kirki_update_url( $config ) {
        $config['url_path'] = get_template_directory_uri() . '/vendor/kirki/';
        return $config;
    }
}
add_filter( 'kirki/config', 'my_theme_kirki_update_url' );

define('DOMAIN', 'pinkus-theme');
define('CONFIG', 'pinkus-theme-agency-config');
Kirki::add_config( CONFIG , array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
) );

/*
 * Add Sections
 */
//Kirki::add_panel( 'pinkus-theme', array(
//    'priority'    => 1,
//    'title'       => __( 'Pinkus Theme Options', DOMAIN )
//) );

Kirki::add_section( 'pinkus-theme-general', array(
    'title'          => __( 'Pinkus Theme', DOMAIN ),
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
) );

/*
 * Default Sections
 */

Kirki::add_field( CONFIG, array(
    'type'        => 'image',
    'settings'    => 'breadcrumb_bg',
    'label'       => __( 'Breadcrumb Background Image', DOMAIN ),
    'description' => __( 'This is image at the top of most pages', DOMAIN ),
    'section'     => 'pinkus-theme-general',
    'priority'    => 1,
) );

Kirki::add_field( CONFIG, array(
    'type'        => 'image',
    'settings'    => 'hero_image',
    'label'       => __( 'Hero Image', DOMAIN ),
    'description' => __( 'This is the big image on the home page', DOMAIN ),
    'section'     => 'pinkus-theme-general',
    'default'     => '',
    'priority'    => 2,
) );



add_filter( 'scss_vars', 'scss_variables', 10, 2 );

// $handle is a reference to the handle used with wp_enqueue_style() - we need it
function scss_variables( $vars, $handle ) {
	$vars["breadcrumb_bg"] = '"'.get_theme_mod('breadcrumb_bg').'"';
	$vars["hero_image"] = '"'.get_theme_mod('hero_image').'"';

	return $vars;
}
