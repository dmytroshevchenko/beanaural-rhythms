<?php



add_action('wp_ajax_nopriv_like_song', 'like_song');
add_action('wp_ajax_like_song', 'like_song');


if (!function_exists('like_song')) {
	function like_song() {

		$user_id = $_POST['user_id'];
		$music_id = $_POST['music_id'];
		
		$favorite_songs = get_field( 'user_likes', 'user_'.$user_id );

		$songs_to_write = array();
		if( is_array($favorite_songs) ){
			foreach( $favorite_songs as $key => $favorite_song){
				$songs_to_write[] = $favorite_song['liked_song']->ID;
			}
		}
		if( in_array($music_id, $songs_to_write) ){
			$songs_to_write = array_diff( $songs_to_write , array( $music_id ) );
			$in_array = 'no';
		} else{
			array_unshift($songs_to_write, $music_id);
			$in_array = 'in_array';
		}

		$songs_to_write_field = array();
		foreach( $songs_to_write as $song_to_write){
			$songs_to_write_field[]['liked_song'] = $song_to_write;
		}

		$value = update_field( 'user_likes', $songs_to_write_field, 'user_'.$user_id );

		wp_send_json_success( array(
			'user_likes' => $songs_to_write_field,
			'in_array' => $in_array,
			'songs_to_write' => $songs_to_write,
			'music_id' => $music_id,
			'favorite_songs' => $favorite_songs,

			) );

	}
}

?>