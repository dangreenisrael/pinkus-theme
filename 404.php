<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = \Timber\Timber::get_context();
$context['options'] = get_fields('options');

\Timber\Timber::render( '404.twig', $context );
