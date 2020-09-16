<?php


add_action('wp_ajax_nopriv_contact_form', 'contact_form');
add_action('wp_ajax_contact_form', 'contact_form');


if (!function_exists('contact_form')) {
	function contact_form() {
		
		$your_name = $_POST['your_name'];
		$your_email = $_POST['your_email'];
		$your_theme = $_POST['your_theme'];
		$your_message = $_POST['your_message'];

		$admin_email = get_bloginfo('admin_email');


		$to_admin = $admin_email;


		$headers_admin .= 'From: ' .$your_name.' <'.$your_email.'>';
		$subject_admin = 'From site. Theme:'.$your_theme;
		$message_admin = ' New message from site '.home_url();
		$message_admin_info ='

	Name: ' . $your_name.'
	Theme: ' . $your_theme.'
	Email: ' . $your_email.'
	Message: ' . $your_message;


		$message_admin .= $message_admin_info;


		wp_mail($to_admin, $subject_admin, $message_admin, $headers_admin);



		$new_filling_id = wp_insert_post( array(
			'post_author' => 1,
			'post_title' => $your_name,
			'post_content' => $message_admin_info,
			'post_status' => 'publish',
			'post_type' => "form_fillings",
		) );


		wp_send_json_success(array( 
			'post_title' => $your_name,
			'post_content' => $message_admin,
		));

	}
}
//contact_form();




?>