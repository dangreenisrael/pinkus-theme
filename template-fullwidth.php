<?php
/*
 * Template Name: Full Width
 */

use Timber\Timber;
use Timber\Post;
$context = Timber::get_context();
$page = new Post();
$context['page'] = $page;
$context['options'] = get_fields('options');

Timber::render('template-fullwidth.twig' , $context );