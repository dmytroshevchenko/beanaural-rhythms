<?php get_header(); 
require_once( ABSPATH . 'wp-admin/includes/media.php' );
?>

<section>
	<div class="box">
		<div class="checkout_page page">
			<h1 class="checkout_title">Shopping Cart</h1>


					<?php

					global $wp_query;

					$orders = $wp_query->posts;
					$music_in_orders = array();
					foreach( $orders as $order ){
						if( get_field( 'paid', $order->ID ) ){
							$paid = true;
						} else{
							$paid = false;
						}
						if( !$paid ){
							continue;
						}
						$music_in_this_order = get_field( 'music_in_this_order', $order->ID );
						break;
					}

						?>

			<div class="cart_song_list">

				<?php
				$total_cost = 0;
				foreach( $music_in_this_order as $music_obj ){
					$music = $music_obj['one_music'];



					$term_list = wp_get_post_terms( $music->ID, 'music_cat', array('fields' => 'all') );

					if( $term_list[0]->parent ){
						$music_cat = get_term($term_list[0]->parent, 'music_cat');
					} else{
						$music_cat = $term_list[0];
					}

					$music_file = get_field('music_file', $music->ID );
					$file_uri = substr($music_file['url'], strpos( $music_file['url'], 'wp-content/uploads' ) + 18 );
					$metadata = wp_read_audio_metadata( wp_get_upload_dir()['basedir'].$file_uri );
					?>


					<div class="one_song">
						<div class="one_song_item song_title"><?php echo $music->post_title ?></div>
						<div class="one_song_item song_cat purple"><?php echo $music_cat->name ?></div>
						<div class="one_song_item song_time"><?php echo gmdate("H:i:s", $metadata['length']); ?></div>
						<div class="one_song_item song_price">$<?php the_field('music_price',$music->ID ) ?></div>
						<div class="one_song_item delete_song">
							<img src="<?php assets_url('images/delete_song.png'); ?>">
						</div>
					</div>


				<?php
				$total_cost += get_field('music_price',$music->ID );
				} ?>


<?php



$user_orders = get_posts( array( 'name' => 'test-order-2' ) );
echo '<pre>';
print_r( $user_orders );
echo '</pre>';

			?>

			<div class="cart_bottom">
				<div class="cart_coupon">
					<div class="cart_coupon_input_block">
						<input class="cart_coupon_input" type="text" placeholder="Enter your coupon code">
					</div>
					<div class="cart_coupon_button_block">
						<button class="cart_coupon_button">APPLY COUPON</button>
					</div>
				</div>

				<div class="cart_subtotal">
					<div class="cart_subtotal_title">
						Subtotal
					</div>
					<div class="cart_subtotal_value">
						$<?php echo number_format ($total_cost, 2, '.', ' ' ); ?>
					</div>
				</div>

			</div>




			<div class="bitting_title">Billing Data</div>

			<form class="billing_form">
				<div class="billing_form_fields_block">
					<div class="one_form_line">
						<div class="one_form_input_block half">
							<div class="one_form_input_title">First name *</div>
							<div class="one_form_input_input">
								<input type="text">
							</div>
						</div>
						<div class="one_form_input_block half">
							<div class="one_form_input_title">Last name *</div>
							<div class="one_form_input_input">
								<input type="text">
							</div>
						</div>
					</div>

					<div class="one_form_line">
						<div class="one_form_input_block">
							<div class="one_form_input_title">Email Adddress *</div>
							<div class="one_form_input_input">
								<input type="text">
							</div>
						</div>
					</div>

					<div class="one_form_line">
						<div class="one_form_input_block">
							<div class="one_form_input_title">Phone *</div>
							<div class="one_form_input_input">
								<input type="text">
							</div>
						</div>
					</div>

				</div>

				<div class="payment_selector">
					<div class="one_variant">
						<input type="radio" name="payment" id="direct" value="direct">
						<label for="direct">Direct bank transfer</label>
					</div>
					<div class="one_variant">
						<input type="radio" name="payment" id="check" value="check">
						<label for="check">Check Payment</label>
					</div>

					<div class="one_variant">
						<input type="radio" name="payment" id="paypal" value="paypal">
						<label for="paypal">PayPal</label>
					</div>

					<div class="one_variant">
						<input type="radio" name="payment" id="card" value="card">
						<label for="card">Credit card</label>
					</div>

					<div class="one_variant">
						<input type="radio" name="payment" id="cash" value="cash">
						<label for="cash">Cash on delivery</label>
					</div>
				</div>


				<div class="button_block">
					<input type="submit" class="button orange" value="PLACE ORDER">
				</div>

			</form>

		</div>
	</div>
</section>

<?php get_footer(); ?>