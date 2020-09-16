<?php


add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
show_admin_bar( false );
add_theme_support( 'html5', array( 'search-form' ) );


function template_url( $pass ){
	echo get_template_directory_uri().'/'.$pass;
}

function assets_url( $pass ){
	echo get_template_directory_uri().'/assets/'.$pass;
}



add_action('after_setup_theme', function(){
	register_nav_menus( array(
		'main_menu' => 'Main menu'
	) );
});




function my_scripts_method(){
	
	wp_dequeue_script('jquery');
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', '3.2.1', true );
	wp_enqueue_script('jquery');


	wp_enqueue_script('jquery-form');
	wp_enqueue_script('amplitude', get_template_directory_uri()."/assets/js/player/amplitude.min.js", array('jquery'), '', true );
	
	wp_enqueue_script('owl_js', get_template_directory_uri()."/assets/js/owl/owl.carousel.min.js", array('jquery'), '', true );
	wp_enqueue_script('for_users_js', get_template_directory_uri()."/assets/js/for_users.js", array('jquery'), '', true );
	





	wp_enqueue_script('mixer_bootstrap_js', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', '', true );
	wp_enqueue_script('mixer_html5Loader_js', '//cdnjs.cloudflare.com/ajax/libs/jquery.html5loader/1.8.0/jquery.html5Loader.min.js', '', true );
	wp_enqueue_script('mixer_packaged_js', '//cdnjs.cloudflare.com/ajax/libs/jquery-noty/2.4.1/packaged/jquery.noty.packaged.min.js', '', true );
	wp_enqueue_script('mixer_jplayer_js', '//cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/jplayer/jquery.jplayer.min.js', '', true );
	wp_enqueue_script('mixer_jqueryui_js', '//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', '', true );
	wp_enqueue_script('mixer_tether_js', '//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', '', true );
	wp_enqueue_script('mixer_scrollbar_js', '//cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js', '', true );






	wp_enqueue_script('mixer_functions_js', get_template_directory_uri()."/assets/js/mixer/functions.js", array('jquery'), '', true );
	wp_enqueue_script('mixer_app_js', get_template_directory_uri()."/assets/js/mixer/mixer_app.js", array('jquery'), '', true );
	wp_enqueue_script('mixer_select_js', get_template_directory_uri()."/assets/js/mixer/select-min.js", array('jquery'), '', true );



	wp_enqueue_script('main_js', get_template_directory_uri()."/assets/js/script.js", array('jquery'), '', true );
	wp_enqueue_script('music_js', get_template_directory_uri()."/assets/js/music_script.js", array('jquery'), '', true );

	wp_localize_script('main_js', 'ajax_var', array( 
			'url' => admin_url('admin-ajax.php'),
			'current_user_id' => get_current_user_id(),
			'order_cookies' => set_order_cookie(),

			'images_url' => get_template_directory_uri() . '/assets/images/',
			'template_url' => get_template_directory_uri(),
			'if_player' => 'false',
		)
	);


	wp_enqueue_style( 'owl_css', get_template_directory_uri() . '/assets/js/owl/owl.carousel.css' );
	wp_enqueue_style( 'owl_theme_css', get_template_directory_uri() . '/assets/js/owl/owl.theme.css' );
	wp_enqueue_style( 'owl_transition_css', get_template_directory_uri() . '/assets/js/owl/owl.transitions.css' );
	

	wp_enqueue_style( 'mixer_scrollbar_css', '//cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css' );
	wp_enqueue_style( 'mixer_bootstrap_theme_css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css' );
	wp_enqueue_style( 'mixer_bootstrap_css', '//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css' );

	



	wp_enqueue_style( 'mixer_css', get_template_directory_uri() . '/assets/css/mixer_app.css' );
	wp_enqueue_style( 'mixer_select-theme_css', get_template_directory_uri() . '/assets/css/select-theme-chosen.css' );
	wp_enqueue_style( 'amplitude_css', get_template_directory_uri() . '/assets/css/amplitude.css' );
	




	wp_enqueue_style( 'main_style', get_template_directory_uri() . '/style.css' );

}

add_action('wp_enqueue_scripts', 'my_scripts_method');




if( function_exists('acf_add_options_page') ){

	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Theme options',
		'menu_title' 	=> 'Theme options',
		'redirect' 		=> false,
		'menu_slug' 	=> 'theme_options',
		'post_id' => 'theme_options',
		'capability' => 'edit_posts',
		'position' => 30,
	));

}


function pagination() {
	global $wp_query;
	$pages = '';
	$max = $wp_query->max_num_pages;
	if (!$current = get_query_var('paged')) $current = 1;
	$a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
	$a['total'] = $max;
	$a['current'] = $current;

	$total = 0; //1 - выводить текст "Страница N из N", 0 - не выводить
	$a['mid_size'] = 2; //сколько ссылок показывать слева и справа от текущей
	$a['end_size'] = 1; //сколько ссылок показывать в начале и в конце
	$a['prev_text'] = '<div class="pagination_arrow arrow_left"></div>'; //текст ссылки "Предыдущая страница"
	$a['next_text'] = '<div class="pagination_arrow arrow_right"></div>'; //текст ссылки "Следующая страница"

	if ($max > 1) echo '<div class="navigation">';
	if ($total == 1 && $max > 1) $pages = '<span class="pages">Страница ' . $current . ' из ' . $max . '</span>'."\r\n";
	echo $pages . paginate_links($a);
	if ($max > 1) echo '</div>';
}


function js_vars(){ ?>


<script>
  var if_player = false;
</script>
<?php }


include_once 'includes/post_types.php';
include_once 'includes/sidebars.php';
include_once 'includes/player.php';
include_once 'includes/for_orders.php';
include_once 'includes/send.php';
include_once 'includes/for_users/route.php';
include_once 'includes/liking_songs.php';

include_once 'includes/shortcodes/music_cats_shortcode.php';

include_once 'includes/mixer/mixer_functions.php';





?>