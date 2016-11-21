<?php
/*
 * Template Name: Clients
 */

use Timber\Timber;
use Timber\Post;
$context = Timber::get_context();
$page = new Post();
$context['page'] = $page;
$context['options'] = get_fields('options');
$context['clients'] = get_field('clients', 'option');

Timber::render('template-clients.twig' , $context );