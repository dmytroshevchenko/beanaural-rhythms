<?php

$current_term_id = get_queried_object()->term_id;
$parent = get_term(get_queried_object()->parent, 'music_cat');
$music_cats = get_terms( array( 'taxonomy' => 'music_cat', 'parent' => get_queried_object()->parent,
	'hide_empty' => false, ));


?>
<section>
	<div class="box">
		<div class="checkout_page page">
			<h1 class="checkout_title desktop"><?php echo $parent->name; ?></h1>
			<div class="mobile back_link">
				<a href="#">
					<img src="<?php assets_url('images/back_arrow.png'); ?>">
				</a>
			</div>

			<?php $child_terms = get_term_children( get_queried_object()->parent, 'music_cat' );
			if ( !empty( $child_terms ) && !is_wp_error( $child_terms ) ){ ?>
				<div class="small_category_list">
					<?php foreach($music_cats as $music_cat){
						$category_id = $music_cat->term_id;
						$term_link = get_term_link($category_id, 'music_cat'); ?>

						<?php if( $current_term_id == $category_id ){ $current = 'current'; } else{ $current = ''; } ?>
						<div class="one_category <?php echo $current; ?>"  onclick='location.href="<?php echo $term_link; ?>"'>
							<div class="one_category_image">
								<?php
								$image = get_field('category_image', 'term_'.$category_id );
								if( !empty($image) ): ?>
									<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="one_category_title">
								<?php echo $music_cat->name; ?>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>



			<div class="content music_description">
				<h3 style="text-align: center;"><?php echo get_queried_object()->name; ?></h3>
				<p style="text-align: center;"><?php echo get_queried_object()->description; ?></p>
			</div>





			<div class="cart_song_list">

				<div class="song_cols_title">

					<div class="one_song_item song_title">
						Title
						<img src="<?php assets_url('images/grey_arrow_button.png'); ?>">
					</div>
					<div class="one_song_item song_cat">
						Category
						<img src="<?php assets_url('images/grey_arrow_button.png'); ?>">
					</div>
					<div class="one_song_item song_time">
						Time
						<img src="<?php assets_url('images/grey_arrow_button.png'); ?>">
					</div>
					<div class="one_song_item song_price">Price</div>
					<div class="one_song_item song_play_pause"></div>
					<div class="one_song_item song_like"></div>
					<div class="one_song_item add_to_cart_button"></div>
				</div>
				<div class="buy_music_list">

						<script>
							var songs_array = [];
						</script>

					<?php


					if( is_user_logged_in() ){
						$favorite_songs = get_field('user_likes', 'user_'.get_current_user_id());
						$favorite_songs_id = array();
						if( is_array( $favorite_songs ) ){
							foreach( $favorite_songs as $favorite_song ){
								$favorite_songs_id[] = $favorite_song['liked_song']->ID;
							}
						} 
					}
					

					$i = 0; if ( have_posts() ) : while ( have_posts() ) : the_post();

					$music_file = get_field('music_file');
					$file_uri = substr($music_file['url'], strpos( $music_file['url'], 'wp-content/uploads' ) + 18 );
					$metadata = wp_read_audio_metadata( wp_get_upload_dir()['basedir'].$file_uri );


					?>
					<div class="one_song" data-music_post_id="<?php echo get_the_ID(); ?>" data-music_id ="<?php echo $i; ?>">
						<div class="one_song_item song_title"><?php the_title(); ?></div>
						<div class="one_song_item song_cat purple"><?php echo get_queried_object()->name; ?></div>
						<div class="one_song_item song_time"><?php echo gmdate("H:i:s", $metadata['length']); ?></div>
						<div class="one_song_item song_price">$<?php the_field('music_price') ?></div>
						<div class="one_song_item song_play_pause">
							<img src="<?php assets_url('images/play_icon.png'); ?>" class="play_icon">
							<img src="<?php assets_url('images/pause_icon.png'); ?>" class="pause_icon">
						</div>
						<?php if(is_array( $favorite_songs_id ) ){
							if( in_array( get_the_ID(), $favorite_songs_id) ){
								$liked = 'liked';
							} else{
								$liked = '';
							}
						} ?>
						<div class="one_song_item song_like <?php echo $liked; ?>">
							<img src="<?php assets_url('images/heart_grey.png'); ?>" class="default">
							<img src="<?php assets_url('images/heart_red.png'); ?>" class="hover">
						</div>
						<div class="one_song_item add_to_cart_button">
							<button class="orange cart">
								<span class="button_text">Add to Cart</span>
								<span class="cart_icon"></span>
							</button>
						</div>
						<script>songs_array.push({
									"name": "<?php the_title(); ?>",
									"artist": "<?php echo $metadata['artist']; ?>",
									"album": "<?php echo $metadata['album']; ?>",
									"url": "<?php echo $music_file['url']; ?>",
									"cover_art_url": "<?php the_post_thumbnail_url( $size = 'large' ) ?>"
								});
						</script>
					</div>


				<?php
				$i++;
				endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>

					<div class="pagination">
						<?php
						$total_pages = $wp_query->max_num_pages;
						if ($total_pages > 1){

							$current_page = max(1, get_query_var('paged'));
							echo '<div class="pagination_list">';
							echo paginate_links(array(
								'base' => get_pagenum_link(1) . '%_%',
								'format' => '/page/%#%',
								'current' => $current_page,
								'total' => $total_pages,
								'prev_text'    => '<div class="pagination_arrow arrow_left"></div>',
								'next_text'    => '<div class="pagination_arrow arrow_right"></div>',
								'before_page_number' => '<div class="one_pagination_page">',
								'after_page_number' => '</div>'
							));
							echo '</div>';
						}
						?>
					</div>
				</div>

			</div>

		</div>
	</div>
</section>



<div class="player_popup">
	<div class="popup_bg">
		<div class="popup">
			<div class="close"></div>
			<?php echo_player(); ?>
		</div>
	</div>
</div>

