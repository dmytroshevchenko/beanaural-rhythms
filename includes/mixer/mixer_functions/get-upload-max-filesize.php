<?php 



add_action('wp_ajax_nopriv_maxAudioSize', 'maxAudioSize');
add_action('wp_ajax_maxAudioSize', 'maxAudioSize');


if (!function_exists('maxAudioSize')) {
	function maxAudioSize() {
		wp_send_json_success( array( 'upload_max_filesize' => ini_get( 'upload_max_filesize' ) ) );
	}
}

?>	
