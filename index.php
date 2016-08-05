<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

use Timber\Timber;
$context = Timber::get_context();

// We can access the loop of WordPress posts with the 'posts' variable.
$context['posts'] = Timber::get_posts();
$context['pagination'] = Timber::get_pagination();
$context['sidebar_widgets'] = Timber::get_widgets('blog_sidebar');
$context['title'] = "Blog";
$context['options'] = get_fields('options');

// If we are on the home page, add a few other templates to our hierarchy.
$templates = array( 'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'front-page.twig', 'home.twig' );
}
Timber::render( "archive.twig", $context );
