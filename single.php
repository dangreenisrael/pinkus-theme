<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

use Timber\Timber;
use Timber\Helper;
$context = Timber::get_context();

$post = Timber::query_post();

$context['post'] = $post;
$context['comment_form'] = Helper::get_comment_form();
$context['options'] = get_fields('options');
$context['sidebar_widgets'] = Timber::get_widgets('blog_sidebar');
$args = array(
	'cat'               => $post->post_category,
	'posts_per_page'    => 3,
	'orderby'           => 'rand'
);
$context['related_posts'] = Timber::get_posts($args);
$category = get_the_category()[0];
$context['category']['name'] = $category->name;
$context['category']['link'] = get_category_link( $category->term_id);
$context['current_url'] = get_site_url().$_SERVER['REQUEST_URI'];

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
