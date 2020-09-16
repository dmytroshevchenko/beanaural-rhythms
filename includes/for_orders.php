<?php


function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $str = '';
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $str .= $keyspace[random_int(0, $max)];
    }
    return $str;
}

function random_cookie_without_copy(){

	$random_str = random_str(64);
	$page = get_page_by_path( $random_str, ARRAY_N, 'orders' );

	if( !empty( $page ) ){
		random_cookie_without_copy();
	} else{
		return $random_str;
	}

}





add_action( 'wp_footer', 'cookies_to_footer' );
function cookies_to_footer(){
//	echo '<div class="cookies_in_footer hidden" id="liked_cookies_id">'.set_liked_cookies_id().'</div>';
}

add_action( 'init', 'set_order_cookie');
function set_order_cookie(){

	if( !is_user_logged_in() ){

		if($_COOKIE['order_cookie']){
			setcookie("order_cookie", $_COOKIE['order_cookie'], time()+60*60*24*30, '/');
			return $_COOKIE['order_cookie'];
		} else{
			$random_cookie_without_copy = random_cookie_without_copy();
			setcookie("order_cookie", $random_cookie_without_copy, time()+60*60*24*30, '/'); //60*60*24*30
			return $random_cookie_without_copy;
		}

	} else{
		return 'authorized';
	}
	
}








add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart');
add_action('wp_ajax_add_to_cart', 'add_to_cart');


if (!function_exists('add_to_cart')) {
	function add_to_cart() {

		$user_id = $_POST['user_id'];
		$music_id = $_POST['music_id'];
		$order_cookies = $_POST['order_cookies'];

		
		if( $user_id ){
			$user_orders = get_posts( array('post_type' => 'orders', 'author' => $user_id, 'meta_key' => 'paid', 'meta_value' => 0 ) );

			if( is_array($user_orders) ){
			$situation = 1;
				$user_order = $user_orders[0];
				$order_id = $user_order->ID;
				$add_order_music = get_field('music_in_this_order', $user_order->ID);
				$add_order_music[]['one_music'] = $music_id;
			} else {
			$situation = 2;
				$add_order_music = array();
				$order_id = wp_insert_post( array(
					'post_author' => $user_id,
					'post_title' => 'Order #',
					'post_content' => '',
					'post_status' => 'publish',
					'post_type' => "orders",
				) );

				$order_obj = array();
				$order_obj['ID'] = $order_id;
				$order_obj['post_title'] = 'Order #'.$order_id;
				wp_update_post( wp_slash($order_obj) );

				$add_order_music[0]['one_music'] = $music_id;

			}
		} else{

			$situation = 3;
			$user_orders = get_posts( array( 'name' => $order_cookies ) );

			if( is_array($user_orders) ){
				$user_order = $user_orders[0];
				$order_id = $user_order->ID;
				$add_order_music = get_field('music_in_this_order', $user_order->ID);
				$add_order_music[]['one_music'] = $music_id;
			} else {
			$situation = 4;
				$add_order_music = array();
				$order_id = wp_insert_post( array(
					'post_author' => 1,
					'post_title' => 'Order #',
					'post_content' => '',
					'post_name' => $order_cookies,
					'post_status' => 'publish',
					'post_type' => "orders",
				) );

				$order_obj = array();
				$order_obj['ID'] = $order_id;
				$order_obj['post_title'] = 'Order #'.$order_id;
				wp_update_post( wp_slash($order_obj) );

				$add_order_music[0]['one_music'] = $music_id;

			}

		}






		// Обновляем данные в БД

		$value = update_field( 'music_in_this_order', $add_order_music, $order_id );


		wp_send_json_success( array(
			'user_orders' => $add_order_music,
			'situation' => $situation,
			'music_id' => $music_id,
			
		) );


	}
}



?>