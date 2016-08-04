<?php
/**
 * The template for displaying Author Archive pages
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
global $wp_query;

$data = \Timber\Timber::get_context();
$data['posts'] = \Timber\Timber::get_posts();
$context['options'] = get_fields('options');

if ( isset( $wp_query->query_vars['author'] ) ) {
	$author = new Timber\User( $wp_query->query_vars['author'] );
	$data['author'] = $author;
	$data['title'] = 'Author Archives: ' . $author->name();
}
\Timber\Timber::render( array( 'author.twig', 'archive.twig' ), $data );
