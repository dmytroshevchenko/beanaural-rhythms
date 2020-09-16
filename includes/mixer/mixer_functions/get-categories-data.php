<?php

	
//	require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
//	$seconds = 0;
//	set_time_limit( $seconds );	
	
//	date_default_timezone_set( "UTC" ); 

//	require_once( 'db.php' );


add_action('wp_ajax_nopriv_get_categories_data', 'get_categories_data');
add_action('wp_ajax_get_categories_data', 'get_categories_data');


if (!function_exists('get_categories_data')) {
	function get_categories_data() {

		$typesData = array();
		$categoriesData = array();
		$terms = get_terms( array('taxonomy' => 'music_cat','hide_empty' => false ) );
		
		$tax_query = array();
		foreach( $terms as $term ){

			if( !$term->parent ){
				continue;
			}


			$same_terms = get_terms( array('taxonomy' => 'music_cat','name' => $term->name ) );

			foreach( $same_terms as $same_term ){
				$tax_query[ $same_term->name ][$same_term->term_id]['tax_query'] = array(
	                'taxonomy' => 'music_cat',
	                'field' => 'id',
	                'terms' => $same_term->term_id,
	            );
			}
		}

		$affirmations_term = get_term_by( 'slug', 'powerful-affirmations', 'music_cat' );
		$tax_query[ $affirmations_term->name ][$affirmations_term->term_id]['tax_query'] = array(
            'taxonomy' => 'music_cat',
            'field' => 'id',
            'terms' => $affirmations_term->term_id,
        );



//	$categoriesResult = mysqli_query( $link, "SELECT * FROM `categories`" );
	
//			$categoryID = $categoriesRow[ 'id' ];
			
			$binauralBeats = array(  );
			$bgMusic = array(  );
			$affirmations = array(  );			
			
//			$audioResult = mysqli_query( $link, "SELECT * FROM `audio` WHERE `category_id`='" . $categoryID . "'" );

/*
			if( $audioResult ) {
				// fetch associative array
				while( $audioRow = mysqli_fetch_assoc( $audioResult ) ) {
*/
		foreach( $tax_query as $query){
			$tax_query_term = array();

			foreach($query as $term){
				$tax_query_term[] = $term['tax_query'];
			}
			$tax_query_term['relation'] = 'OR';

			$music = get_posts( array( 'post_type' => 'music', 'numberposts'=> -1, 'tax_query' => $tax_query_term ) );
				
//				if ( $music->have_posts() ) : while ( $music->have_posts() ) : $music->the_post();

			foreach($music as $song){

				$music_terms = wp_get_post_terms( $song->ID, 'music_cat' );


				//	$typeValue = $typesData[ $typeID ][ 'value' ];
				$music_cat = '';
				//$music_terms = get_the_terms( $term->parent, 'music_cat' );

				$music_cat = 0;
				$music_type = 0;
				foreach($music_terms as $music_term){
					if( $music_term->parent ){
						$music_cat = $music_term;
						$music_type = $music_term->parent;
					} else{ continue; }


					
					$typeValue = get_term( $music_type, 'music_cat' ); // $music_type;// get_the_terms( $term->parent, 'music_cat' )[0];
					$music_file = get_field('music_file', $song->ID);

					$file_uri = substr($music_file['url'], strpos( $music_file['url'], 'wp-content/uploads' ) + 18 );
					$metadata = wp_read_audio_metadata( wp_get_upload_dir()['basedir'].$file_uri );
					$metadata_length = gmdate("H:i:s", $metadata['length']);

	
					switch( $typeValue->slug ) {
						case 'binaural-beats':
							array_push( 
								$binauralBeats,
								array(
									'name' => $song->post_title, //$audioRow[ 'name' ],
									'type' => 'binaural-beat', //$typeValue->slug,
									'file' => $music_file['url'],// $audioRow[ 'file_name' ],
									'duration' => $metadata_length,// floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						case 'collection-of-music':
							array_push( 
								$bgMusic,
								array(
									'name' => $song->post_title, //$audioRow[ 'name' ],
									'type' => 'bg-music', //$typeValue->slug,
									'file' => $music_file['url'],// $audioRow[ 'file_name' ],
									'duration' => $metadata_length,// floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
						case 'powerful-affirmations':
							array_push( 
								$affirmations,
								array(
									'name' => $song->post_title, //$audioRow[ 'name' ],
									'type' => 'affirmation', //$typeValue->slug,
									'file' => $music_file['url'],// $audioRow[ 'file_name' ],
									'duration' => $metadata_length,// floatval( $audioRow[ 'duration' ] )
								)									
							);
							
							break;
					} //switch

				} // foreach music_terms
			} //foreach music

			$categoryInfo = array( 
				'name' => $music_cat->name,
				'id' => $music_cat->slug,
				'data' => array( 
					'boxesSelectors' => array( 
						'binauralBeats' => '#binaural-beats-box',
						'bgMusic' => '#bg-music-box',
						'affirmations' => '#affirmations-box'
					),
					'musicData' => array( 
						'binauralBeats' => $binauralBeats,
						'bgMusic' => $bgMusic,
						'affirmations' => $affirmations
					)
				)
			);

			array_push( $categoriesData, $categoryInfo );

		}

		wp_send_json_success( array( 'categoriesData' => $categoriesData ) );
//		wp_send_json_error( array( 'categoriesData' => $categoryInfo ) );
	}
}

?>