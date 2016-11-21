<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = \Timber\Timber::get_context();

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: '.get_the_date( 'D M Y' );
} else if ( is_month() ) {
	$context['title'] = 'Archive: '.get_the_date( 'M Y' );
} else if ( is_year() ) {
	$context['title'] = 'Archive: '.get_the_date( 'Y' );
} else if ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
} else if ( is_category() ) {
	$context['title'] = single_cat_title( '', false ) . " Blog";
	$context['category'] = single_cat_title( '', false );

	array_unshift( $templates, 'archive-' . get_query_var( 'cat' ) . '.twig' );
} else if (is_tax()){
    $term = get_queried_object(); // Is this the appropriate way to do it?
	$context['title'] = $term->name;
	$context['term'] = $term;
	array_unshift($templates, 'taxonomy-'.$term->taxonomy.'.twig', 'taxonomy.twig');
} else if ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift( $templates, 'archive-' . get_post_type() . '.twig' );
}

$context['posts'] = \Timber\Timber::get_posts();
$context['pagination'] = \Timber\Timber::get_pagination();
$context['sidebar_widgets'] = \Timber\Timber::get_widgets('blog_sidebar');
$context['options'] = get_fields('options');


\Timber\Timber::render( $templates, $context );
