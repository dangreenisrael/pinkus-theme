<?php
/*
 * Template Name: About Us
 * Description: A Page Template with a darker design.
 */

use Timber\Timber;
use Timber\Post;
$context = Timber::get_context();
$page = new Post();
$context['page'] = $page;
$context['options'] = get_fields('options');

$context['sidebar_widgets'] = Timber::get_widgets('general_sidebar');



Timber::render( array( 'page-' . $post->post_name . '.twig', 'template-about-us.twig' ), $context );