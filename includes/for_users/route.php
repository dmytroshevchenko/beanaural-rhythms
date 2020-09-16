<?php
//wp_enqueue_script('jquery'); // добавим в скрипты jQuery

add_action('wp_ajax_nopriv_login_me', 'login_me'); // повесим функцию на аякс запрос с параметром action=login_user для неавторизованых пользователей
//add_action('wp_ajax_login_me', 'login_me'); // повесим функцию на аякс запрос с параметром action=login_user для авторизованых пользователей, будет логичнее этого не делать, т.к. логинется залогиненому не надо =/
function login_me(){
	require_once dirname(__FILE__) . '/login.php'; // тут подключим файл с обработкой действий при логине (лежит в той же папке что и route.php)
}

//add_action('wp_ajax_nopriv_logout_me', 'logout_me'); // повесим функцию на аякс запрос с параметром action=login_user для неавторизованых пользователей, тоже без смысла
add_action('wp_ajax_logout_me', 'logout_me'); // повесим функцию на аякс запрос с параметром action=logout_me для авторизованых пользователей
function logout_me(){ // logout
	require_once dirname(__FILE__) . '/logout.php';  // подключим нужный обработчик
}

add_action('wp_ajax_nopriv_register_me', 'register_me'); // повесим функцию на аякс запрос с параметром action=register_me для неавторизованых пользователей
function register_me(){ // внутри функции подключаем нужный файл с обработкой
	require_once dirname(__FILE__) . '/register.php';  
}

function set_html_content_type(){ // эта ф-я пригодится нам чтоб слать письма в формате html
	return 'text/html';
}

add_action('wp_ajax_edit_profile', 'edit_profile'); // вешаем хук на аякс запрос с параметром action=edit_profile

function edit_profile(){ // и подключаем нужный файл с обработкой 
	require_once dirname(__FILE__) . '/edit_profile.php';
}

add_action('wp_ajax_nopriv_lost_password', 'lost_password');  // вешаем хук на аякс запрос от незалогиненного юзера с параметром action=lost_password, это означает что юзер запросил восстановление пароля
function lost_password(){ // запускается эта ф-я
	require_once dirname(__FILE__) . '/lost_password.php'; // подключаем нужный файл с обработкой запроса на восстановления пароля 
}

add_action('wp_ajax_nopriv_reset_password_front', 'reset_password_front');  // вешаем хук на аякс запрос от незалогиненного юзера с параметром action=reset_password, это означает что юзер отправил саму форму с восстановлением пароля
function reset_password_front(){ // запускается эта ф-я
	require_once dirname(__FILE__) . '/reset_password.php'; // подключаем файл с обработкой формы восстановления пароля 
}

add_action('wp_ajax_notices_for_user', 'notices_for_user');
function notices_for_user(){	
	require_once dirname(__FILE__) . '/notices.php';	
}
//add_action('wp_ajax_count_notices', 'count_notices');
function count_notices(){	
	require_once dirname(__FILE__) . '/count_notices.php';	
}
add_action('wp_ajax_nopriv_load_notices', 'load_notices');
add_action('wp_ajax_load_notices', 'load_notices');
function load_notices(){	
	require_once dirname(__FILE__) . '/load_notices.php';	
}

add_filter('acf/get_valid_field', 'change_input_labels');
function change_input_labels($field){	
	global $post;		
	if($post->post_name == 'profile' && !is_admin()){
	/*
	echo '<pre>';
	print_r($field);
	
	echo '</pre>';*/
		if($field['name'] == '_post_title'){
			$field['label'] = 'Заголовок';
			$field['instructions'] = 'Осталось 30 знаков';
//			$field['minlength'] = 100;
		}	
		if($field['type'] == 'wysiwyg' && $field['name'] == '_post_content'){
			$field['type']  	   = 'textarea';
			$field['label'] 	   = 'Текст'; 			
			$field['required'] 	   = 1;
//			$field['minlength'] = 600;
			$field['instructions'] = 'Осталось 600 знаков';
		}		
	}		
	return $field;
}


function acf_set_featured_image( $value, $post_id, $field  ){
    if($value != ''){
	    add_post_meta($post_id, '_thumbnail_id', $value);

	    $post_title = get_the_title($post_id);
		$thumb_meta = array(
			'ID'		=> $value,			// Specify the image (ID) to be updated
			'post_title'	=> $post_title,		// Set image Title to sanitized title
		);
		wp_update_post( $thumb_meta );

    }
    return $value;
}
// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=add_image', 'acf_set_featured_image', 10, 3);  