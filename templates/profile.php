<?php 
/*Template name: Profile*/
acf_form_head();
get_header();
require_once( ABSPATH . 'wp-admin/includes/media.php' );
?>


<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>


<section>
	<div class="box">
		<div class="page">
			<h1 class="profile_title"><?php the_title(); ?></h1>


			<?php if(!is_user_logged_in()){ // если юзер не залогинен, показываем форму ?>
				<button class="orange sign_up_button">Sign up</button>
				<button class="grey login_button">Login</button>


				<?php if( have_rows('user_guide') ): ?>
					<div class="faq_accordion">
						<?php while ( have_rows('user_guide') ) : the_row(); ?>
							<div class="one_accordion">
								<div class="accordion_title"><?php the_sub_field('question'); ?></div>
								<div class="accordion_content">
									<?php the_sub_field('answer'); ?>
								</div>
							</div>
						<?php endwhile; ?>
					</div>
				<?php else : endif; ?>


			<?php } else{ //if(!is_user_logged_in())
			global $current_user;
			$current_user_id = get_current_user_id();

			$user_data = get_user_meta( $current_user_id );
			$user_email = get_userdata( $current_user_id )->data->user_email;




?>

				<div class="profile_menu_block">
					<div class="profile_adaptive_menu mobile">
						<div class="profile_menu_item profile" id="profile_adaptive_menu_item">User settings</div>
					</div>
					<div class="profile_menu">
						<div class="profile_menu_item profile active" data-class="profile" data-tab_id="1">User settings</div>
						<div class="profile_menu_item heart" data-class="heart" data-tab_id="2">My favorite playlist</div>
						<div class="profile_menu_item music" data-class="music" data-tab_id="3">My saved mix</div>
						<div class="profile_menu_item cart" data-class="cart" data-tab_id="4">Orders</div>
						<div class="profile_menu_item support" data-class="support" data-tab_id="5">Support</div>
						<div class="profile_menu_item guid" data-class="guid" data-tab_id="6">User Guide</div>
					</div>
				</div>



				<div class="profile_content">
					<div class="one_tab_content active" id="profile_content_1">

						<form name="profileform" id="profileform" method="post" class="user_info_form userform" action="">

							<div class="user_info_form_title">First name</div>
							<input type="text" name="first_name" id="first_name" class="user_info_form_input" placeholder="First name" value="<?php echo $user_data['first_name'][0]; ?>">

							<div class="user_info_form_title">Last name</div>
							<input type="text" name="last_name" id="last_name" class="user_info_form_input" placeholder="Last name" value="<?php echo $user_data['last_name'][0]; ?>">

							<div class="user_info_form_title">E-mail</div>
							<input type="text" name="user_email" id="user_email"  class="user_info_form_input" value="<?php echo $user_email; ?>">

						
							<div class="user_info_form_title open_password_change">Change password</div>
							<div class="password_change">
								<input type="password" name="current_pass" id="current_pass" placeholder="Current password"><!-- если захотят поменять пароль, надо будет заполнить все 3 поля -->
								<input type="password" name="pass1" id="pass1" placeholder="New password">
								<input type="password" name="pass2" id="pass2" placeholder="Repeat new password">
							</div>
							<div class="button_block">
								<input type="submit" class="button orange" value="Save">
							</div>	


							<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
							<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('edit_profile_nonce'); ?>"> 
							<input type="hidden" name="action" value="edit_profile">

						</form>

					</div>
					<div class="one_tab_content" id="profile_content_2">

						<div class="buy_music_list">

							<script>
								var songs_array = [];
							</script>
							<?php

							$favorite_songs = get_field('user_likes', 'user_'.$current_user_id);
							$favorite_songs_id = array();
							if( is_array($favorite_songs) ){
								foreach( $favorite_songs as $favorite_song ){
									$favorite_songs_id[] = $favorite_song['liked_song']->ID;
								}
							}
							$terms = get_terms( array( 'taxonomy' => 'music_cat', 'parent' => 0 ) );

							$i = 0;
							foreach( $terms as $term ){

								$songs = get_posts(
								    array(
								        'posts_per_page' => -1,
								        'numberofposts' => -1,
								        'post_type' => 'music',
								        'tax_query' => array(
								            array(
								                'taxonomy' => 'music_cat',
								                'field' => 'term_id',
								                'terms' => $term->term_id,
								            )
								        )
								    )
								);
								foreach( $songs as $song ){
									$songs_id[] = $song->ID;
								}

								if( !is_array($favorite_songs_id) && !is_array($songs_id) ){
									continue;
								}

								$liked_cat_songs = array_intersect( $favorite_songs_id, $songs_id );

								if( empty($liked_cat_songs) ){
									continue;
								}
								echo '<div class="music_list_title">'.$term->name.'</div>';
								if( is_array($liked_cat_songs) ){
									foreach( $liked_cat_songs as $song_id ){

										$term_list = wp_get_post_terms( $song_id, 'music_cat', array('fields' => 'all') );
										$term_children_list = '';
										$i = 0;
										foreach( $term_list as $child_term ){
											if( $child_term->parent <> $term->term_id ){
												continue;
											}
											if($i == 0){$comma = ''; } else{ $comma = ', ';}
											$term_children_list .= $comma.'<a href="'.get_term_link($child_term->term_id, 'music_cat').'" class="'.get_field('color', 'term_'.$child_term->term_id).'">'.$child_term->name.'</a>';
											$i++;
										}

										$music_file = get_field('music_file', $song_id );
										$file_uri = substr($music_file['url'], strpos( $music_file['url'], 'wp-content/uploads' ) + 18 );
										$metadata = wp_read_audio_metadata( wp_get_upload_dir()['basedir'].$file_uri );
									?>
										<div class="one_song" data-music_post_id="<?php echo $song_id; ?>" data-music_id ="<?php echo $i; ?>">
											<div class="one_song_item song_title"><?php echo get_the_title( $song_id ); ?></div>
											<div class="one_song_item song_cat purple"><?php echo $term_children_list; ?></div>
											<div class="one_song_item song_time"><?php echo gmdate("H:i:s", $metadata['length']); ?></div>
											<div class="one_song_item song_price">$<?php the_field('music_price', $song_id ) ?></div>
											<div class="one_song_item song_play_pause">
												<img src="<?php assets_url('images/play_icon.png'); ?>" class="play_icon">
												<img src="<?php assets_url('images/pause_icon.png'); ?>" class="pause_icon">
											</div>
											<div class="one_song_item song_trash">
												<img src="<?php assets_url('images/trash.png'); ?>" class="default">
												<img src="<?php assets_url('images/trash_hover.png'); ?>" class="hover">
											</div>
											<div class="one_song_item add_to_cart_button">
												<button class="orange cart">
													<span class="button_text">Add to Cart</span>
													<span class="cart_icon"></span>
												</button>
											</div>
										</div>
										<script>songs_array.push({
													"name": "<?php the_title(); ?>",
													"artist": "<?php echo $metadata['artist']; ?>",
													"album": "<?php echo $metadata['album']; ?>",
													"url": "<?php echo $music_file['url']; ?>",
													"cover_art_url": "<?php echo get_the_post_thumbnail_url( $song_id, $size = 'large' ) ?>"
												});
										</script>
										<?php
										$i++;
									}
								}
							}
							if( $i == 0){
								echo '<h3>Sorry, you don`t have favorite playlists yet!</h3>';
							}
							?>

						</div>
					</div><!--one_tab_content2-->


					<div class="one_tab_content" id="profile_content_3">

						<div class="saved_music">
							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>
							
							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>

							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>
							
							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>

							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>
							
							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>

							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>
							
							<div class="one_song">
								<div class="one_song_item song_title">Mind your business</div>
								<div class="one_song_item song_time">00:59:59</div>
								<div class="one_song_item song_play_pause">
									<img src="images/play_icon.png">
								</div>
								<div class="one_song_item song_trash">
									<img src="images/trash.png" class="default">
									<img src="images/trash_hover.png" class="hover">
								</div>
							</div>
						</div>

					</div><!--one_tab_content3-->


					<div class="one_tab_content" id="profile_content_4">



						<?php $terms = get_terms( array( 'taxonomy' => 'music_cat', 'parent' => 0 ) ); ?>

						<?php
						$orders = get_posts( array( 'post_type' => 'orders', 'author' => $current_user_id ) );
						foreach ($terms as $term){
							$orders = get_posts( array( 'post_type' => 'orders', 'author' => $current_user_id ) );
							if( empty($orders) ){
								continue;
							} 


								$music_in_orders = array();
								foreach( $orders as $order ){
									$music_in_this_order = get_field( 'music_in_this_order', $order->ID );
									if( get_field( 'paid', $order->ID ) ){
										$paid = true;
									} else{
										$paid = false;
									}
									foreach( $music_in_this_order as $music ){
										$one_music_id = $music['one_music']->ID;

										$term_list = wp_get_post_terms( $one_music_id, 'music_cat', array('fields' => 'all') );
										if( $term_list[0]->parent ){
											$term_par = $term_list[0]->parent;
										} else{
											$term_par = $term_list[0]->term_id;
										}
										
										if( $term->term_id == $term_par ){
											if( !$music_in_orders[ $music['one_music']->post_name ] ){
												$music_in_orders[ $music['one_music']->post_name ] = array(
													'id' => $music['one_music']->ID,
													'paid' => $paid
												);
											} else {
												if( $paid ){
													$music_in_orders[ $music['one_music']->post_name ] = array(
														'id' => $music['one_music']->ID,
														'paid' => $paid
													);
												}
											}
										}
									}
								}
								if( empty($music_in_orders) ){
									continue;
								} 

								?>

							<div class="cart_music_list">
								<div class="music_list_title"><?php echo $term->name; ?></div>

								<?php
								ksort( $music_in_orders );
								foreach( $music_in_orders as $music ){ 
									$song_id = $music['id'];
									$term_list = wp_get_post_terms( $song_id, 'music_cat', array('fields' => 'all') );
									$term_children_list = '';
									$i = 0;
									foreach( $term_list as $child_term ){
										if( $child_term->parent <> $term->term_id ){
											continue;
										}
										if($i == 0){$comma = ''; } else{ $comma = ', ';}
										$term_children_list .= $comma.'<a href="'.get_term_link($child_term->term_id, 'music_cat').'" class="'.get_field('color', 'term_'.$child_term->term_id).'">'.$child_term->name.'</a>';
										$i++;
									}
									?>

									<div class="one_song" data-music_post_id="<?php echo $song_id; ?>" data-music_id ="<?php echo $i; ?>">
										<div class="one_song_item song_title"><?php echo get_the_title( $song_id ); ?></div>
										<div class="one_song_item song_cat purple"><?php echo $term_children_list; ?></div>
										<div class="one_song_item song_time"><?php echo gmdate("H:i:s", $metadata['length']); ?></div>
										<div class="one_song_item song_play_pause">
											<img src="<?php assets_url('images/play_icon.png'); ?>" class="play_icon">
											<img src="<?php assets_url('images/pause_icon.png'); ?>" class="pause_icon">
										</div>
										<div class="one_song_item add_to_cart_button">
											<?php if( $music['paid'] ){ ?>
												<span class="green">paid</span>
											<?php } else{ ?>
												<button class="orange cart">
													<span class="button_text">to pay</span>
												</button>
											<?php } ?>
										</div>
										<div class="one_song_item download_song">
											<?php if( $music['paid'] ){ ?>
												<span class="mobile">Download</span>
												<img src="images/download_icon.png">
											<?php } ?>
										</div>
										<div class="one_song_item song_trash">
											<img src="<?php assets_url('images/trash.png'); ?>" class="default">
											<img src="<?php assets_url('images/trash_hover.png'); ?>" class="hover">
										</div>
									</div>

								<?php } ?>

							</div>
						<?php } ?>


					</div><!--one_tab_content4-->

					<div class="one_tab_content" id="profile_content_5">

						<form class="user_info_form user_contact_form">

							<div class="user_info_form_title">First name</div>
							<input type="text" class="user_info_form_input your_name" value="<?php echo $user_data['first_name'][0]; ?>" placeholder="Jonatan">

							<div class="user_info_form_title">E-mail</div>
							<input type="text" class="user_info_form_input your_email" value="<?php echo $user_email; ?>" placeholder="mail@example">

							<div class="user_info_form_title">Thema</div>
							<input type="text" class="user_info_form_input your_theme" placeholder="">

							<div class="user_info_form_title">Message</div>
							<textarea  class="user_info_form_textarea your_message"></textarea>

							<div class="button_block">
								<input type="submit" class="button orange" value="Send">
							</div>					
						</form>

					</div><!--one_tab_content5-->


					<div class="one_tab_content" id="profile_content_6">

						<?php if( have_rows('user_guide') ): ?>
							<div class="faq_accordion">
								<?php while ( have_rows('user_guide') ) : the_row(); ?>
									<div class="one_accordion">
										<div class="accordion_title"><?php the_sub_field('question'); ?></div>
										<div class="accordion_content">
											<?php the_sub_field('answer'); ?>
										</div>
									</div>
								<?php endwhile; ?>
							</div>
						<?php else : endif; ?>

					</div><!--one_tab_content5-->


				</div>




	<?php } ?>


		</div>
	</div>
</section>



<div class="contact_success_popup">
	<div class="popup_bg">
		<div class="popup white_bg">
			<div class="close"></div>
			<?php the_field('contact_form_answer'); ?>
		</div>
	</div>
</div>

<div class="contact_loading_popup">
	<div class="popup_bg">
		<img src="<?php assets_url('images/loading.gif'); ?>" class="loading">
	</div>
</div>




<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>







<div class="player_popup">
	<div class="popup_bg">
		<div class="popup">
			<div class="close"></div>
			<?php echo_player(); ?>
		</div>
	</div>
</div>




<?php get_footer(); ?>