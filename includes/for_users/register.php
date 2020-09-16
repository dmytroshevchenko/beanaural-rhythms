<?php
$nonce = isset($_POST['nonce']) ? $_POST['nonce'] : ''; // сначала возьмем скрытое поле nonce

if (!wp_verify_nonce($nonce, 'register_me_nonce')){
wp_send_json_error(array(
	'message' => 'Data is sent from a third-party page ',
	'redirect' => false
)); // проверим его, и если вернулся фолс - исаользуем wp_send_json_error и умираем
	
} 

if (is_user_logged_in()){
wp_send_json_error(array(
	'message' => 'You are authorized!',
	'redirect' => false
)); // далее проверим залогинен ли уже юзер, если да - то делать ничего не надо
} 


if (!get_option('users_can_register')){
wp_send_json_error(array(
	'message' => 'User registration is temporarily unavailable.',
	'redirect' => false
)); // если регистрацию выключат в админке - то же не будем ничего делать
	
}


// теперь возьмем все поля и рассуем по переменным

$user_login = isset($_POST['user_login']) ? $_POST['user_login'] : '';
$user_email = $user_login;
$pass1 = isset($_POST['pass1']) ? $_POST['pass1'] : '';
$pass2 = isset($_POST['pass2']) ? $_POST['pass2'] : '';
$redirect_to = isset($_POST['redirect_to']) ? $_POST['redirect_to'] : false;

// теперь проверим нужные поля на заполненность и валидность

if (!$user_email){
wp_send_json_error(array(
	'message' => 'Email is required.',
	'redirect' => false
));
	
}

if (!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $user_email)){
wp_send_json_error(array(
	'message' => 'Wrong format of email',
	'redirect' => false
));	
}

if (!$user_login){
wp_send_json_error(array(
	'message' => 'Login is required.',
	'redirect' => false
));	
}

if (!$pass1){
wp_send_json_error(array(
	'message' => 'Password is required.',
	'redirect' => false
));	
}

if (!$pass2){
wp_send_json_error(array(
	'message' => 'Repeat password',
	'redirect' => false
));	
}

// теперь проверим все ли ок с паролями

if ($pass1 != $pass2){
wp_send_json_error(array(
	'message' => 'Passwords do not match',
	'redirect' => false
));	
}

if (strlen($pass1) < 4){
wp_send_json_error(array(
	'message' => 'Too short password',
	'redirect' => false
));	
}

if (false !== strpos(wp_unslash($pass1) , "\\")){
wp_send_json_error(array(
	'message' => 'Password can`t contain slashes "\\"',
	'redirect' => false
));	
}

// теперь проверим все ли ок с аватаркой, если она передана

if (isset($_FILES['avatar'])) { // если в глобальном массиве $_FILES есть элемент с индексом avatar
	if ($_FILES['avatar']['error']){
	wp_send_json_error(array(
		'message' => "Error: " . $_FILES['avatar']['error'] . ". (" . $_FILES['avatar']['name'] . ") ",
		'redirect' => false
	)); // если произошла серверная ошибка при загрузке файла	
	}
	$type = $_FILES['avatar']['type']; // теперь возьмем расширение файла
	if (($type != "image/jpg") && ($type != "image/jpeg") && ($type != "image/png")){
	wp_send_json_error(array(
		'message' => "Формат файла может быть только jpg или png. (" . $_FILES['avatar']['name'] . ")",
		'redirect' => false
	)); // если формат плохой	
	} 
	
	
}

$user_id = wp_create_user($user_login, $pass1, $user_email); // пробуем создать пользователя с переданными данными

// если есть ошибки

if (is_wp_error($user_id) && $user_id->get_error_code() == 'existing_user_email') wp_send_json_error(array(
	'message' => 'User with this email already exists.',
	'redirect' => false
));
elseif (is_wp_error($user_id) && $user_id->get_error_code() == 'existing_user_login') wp_send_json_error(array(
	'message' => 'User with this login already exists.',
	'redirect' => false
));
elseif (is_wp_error($user_id) && $user_id->get_error_code() == 'empty_user_login') wp_send_json_error(array(
	'message' => 'Login only in lat.',
	'redirect' => false
));
elseif (is_wp_error($user_id)) wp_send_json_error(array(
	'message' => $user_id->get_error_code() ,
	'redirect' => false
));
update_user_meta($user_id, 'first_name', $first_name); // привяжем имя
update_user_meta($user_id, 'last_name', $last_name); // и фамилию

if (isset($_FILES['avatar'])) { // если есть аватарка и скрипт до этого не умер

	// подключаем вп хелперы для работы с медиафайлами

	require_once (ABSPATH . "wp-admin" . '/includes/image.php');

	require_once (ABSPATH . "wp-admin" . '/includes/file.php');

	require_once (ABSPATH . "wp-admin" . '/includes/media.php');

	$attach_id_img = media_handle_upload('avatar', 0); // пробуем залить файл в медиабиблиотеку и получить его id, первый аргумент это индекс файла в глобальном массиве $_FILES, у нас это avatar, второй это id поста к чему файл привязывается, нам это не надо поэтому 0
	if (is_wp_error($attach_id_img)){
	wp_send_json_error(array(
		'message' => "Error with avat uploading.",
		'redirect' => false
	)); // если добавление в медиабиблиотеку вернуло ошибку	
	}
	
	$avatar = array(); // подготовим массив с данными для привязки аватарки к юзеру (только для плагина simple local avatars)
	$avatar['media_id'] = $attach_id_img; // сюда id автарки
	$avatar['full'] = wp_get_attachment_url($attach_id_img); // а сюда её url
	update_user_meta($user_id, 'simple_local_avatar', $avatar); // привяжем аватар
}

// активация, если вам не нужна просто закомментите этот кусок

$code = sha1($user_id . time()); // сгенерим случайную строку
$activation_link = home_url() . '/activate/?key=' . $code . '&user=' . $user_id; // создадим ссылку на активацию, подразумевается что на странице с урлом /activate/ у вас сработает механизм активации
//add_user_meta($user_id, 'has_to_be_activated', $code, true); // теперь запишем эту случайную строку в мета поля юзера, если это поле не пустое - значит пользователь еще не активировался
$txt = '<h3>Hello.</h3><p>For activation at site ' . home_url() . ' click the link: <a href="' . $activation_link . '">' . $activation_link . '</a></p>'; // это текст письма
add_filter('wp_mail_content_type', 'set_html_content_type'); // включаем формат письма в хтмл
wp_mail($user_email, 'User activation.', $txt); // отправляем письмо юзеру
remove_filter('wp_mail_content_type', 'set_html_content_type'); // выключаем формат письма в хтмл

// активация конец

wp_send_json_success(array(
	'message' => 'Ok! You are registered. Check your email',
	'redirect' => $redirect_to
)); // говорим что все прошло ок, если нужен редирект то вместо false поставьте $redirect_to
?>