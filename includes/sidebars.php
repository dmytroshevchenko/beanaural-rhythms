<?php



add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {

    register_sidebar( array(
        'name' => 'Footer col 1',
        'id' => 'footer_col_1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<div class="footer_menu">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => 'Footer col 2',
        'id' => 'footer_col_2',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<div class="footer_menu">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => 'Footer col 3',
        'id' => 'footer_col_3',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<div class="footer_menu">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => 'Footer col 4',
        'id' => 'footer_col_4',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<div class="footer_menu">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );


}




?>