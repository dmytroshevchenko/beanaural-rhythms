<?php get_header();

global $wp_query;
require_once( ABSPATH . 'wp-admin/includes/media.php' );


$current_term_id = get_queried_object()->term_id;
$child_terms = get_term_children( $current_term_id, 'music_cat' );


if ( !empty( $child_terms ) && !is_wp_error( $child_terms ) ){
	get_template_part( 'templates/template-parts/sound-cat', 'parent' );
} else{
	get_template_part( 'templates/template-parts/sound-cat', 'child' );
}

get_footer(); ?>