<?php





add_action('init', 'create_taxonomy');
function create_taxonomy(){
	// список параметров: http://wp-kama.ru/function/get_taxonomy_labels
	register_taxonomy('music_cat', array('music'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Category',
			'singular_name'     => 'Category',
			'search_items'      => 'Search category',
			'all_items'         => 'All categories',
			'view_item '        => 'View category',
			'parent_item'       => 'Parent category',
			'parent_item_colon' => 'Parent category:',
			'edit_item'         => 'Edit category',
			'update_item'       => 'Update category',
			'add_new_item'      => 'Add new category',
			'new_item_name'     => 'New category',
			'menu_name'         => 'Category',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_rest'          => null, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		'hierarchical'          => true,
		'update_count_callback' => '',
		'rewrite'               => true,
		'query_var'             => true, //$taxonomy, // название параметра запроса
		'capabilities'          => array(),
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	) );

}



add_action('init', 'custom_post_type');
function custom_post_type(){
	register_post_type('music', array(
		'labels'             => array(
			'name'               => 'Music', // Основное название типа записи
			'singular_name'      => 'Track', // отдельное название записи типа Book
			'add_new'            => 'Add track',
			'add_new_item'       => 'Add new track',
			'edit_item'          => 'Edit track',
			'new_item'           => 'New track',
			'view_item'          => 'View track',
			'search_items'       => 'Search track',
			'not_found'          =>  'No tracks found',
			'not_found_in_trash' => 'No tracks found in trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Music'

		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'thumbnail')
	) );


	register_post_type('form_fillings', array(
		'labels'             => array(
			'name'               => 'Form fillings', // Основное название типа записи
			'singular_name'      => 'Form filling', // отдельное название записи типа Book
			'add_new'            => 'Add filling',
			'add_new_item'       => 'Add new filling',
			'edit_item'          => 'Edit filling',
			'new_item'           => 'New filling',
			'view_item'          => 'View filling',
			'search_items'       => 'Search filling',
			'not_found'          =>  'No fillings found',
			'not_found_in_trash' => 'No fillings found in trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Form fillings'
		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor')
	) );





	register_post_type('orders', array(
		'labels'             => array(
			'name'               => 'Orders', // Основное название типа записи
			'singular_name'      => 'Order', // отдельное название записи типа Book
			'add_new'            => 'Add order',
			'add_new_item'       => 'Add new order',
			'edit_item'          => 'Edit order',
			'new_item'           => 'New order',
			'view_item'          => 'View order',
			'search_items'       => 'Search order',
			'not_found'          =>  'No orders found',
			'not_found_in_trash' => 'No orders found in trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Orders'
		  ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'author')
	) );



}






?>