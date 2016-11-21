<?php
/**
 * The template for displaying all pages.
 *
 * Template Name: Front Page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = \Timber\Timber::get_context();
$page = new \Timber\Post();
$context['options'] = get_fields('options');
$context['page'] = $page;
$context['posts'] = \Timber\Timber::get_posts(array(
	'posts_per_page' => 3
));

\Timber\Timber::render( 'page-front.twig', $context );