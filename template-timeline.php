<?php
/*
 * Template Name: Timeline
 */

use Timber\Timber;
use Timber\Post;
$context = Timber::get_context();
$page = new Post();
$context['page'] = $page;
$context['options'] = get_fields('options');
$context['process_items'] = get_field('process_items', 'option');

Timber::render('template-timeline.twig' , $context );