<?php
/*
 * Third party plugins that hijack the theme will call wp_footer() to get the footer template.
 * We use this to end our output buffer (started in header.php) and render into the view/page-plugin.twig template.
 */
$timberContext = $GLOBALS['timberContext'];
if ( ! isset( $timberContext ) ) {
	throw new \Exception( 'Timber context not set in footer.' );
}

use Timber\Timber;



$timberContext['content'] = ob_get_contents();

$timberContext['content']['recent_posts'] = Timber::get_posts(array(
	'posts_per_page' => 2,
	'orderby'        => 'date'
));

ob_end_clean();
$templates = array( 'page-plugin.twig' );
\Timber\Timber::render( $templates, $timberContext );
