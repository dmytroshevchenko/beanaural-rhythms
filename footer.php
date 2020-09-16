
</main>


<footer>



<div class="box">
	<div class="footer_top">

		<?php if( have_rows('wave_types', 'theme_options') ): ?>
			<h2><?php the_field('waves_title', 'theme_options'); ?></h2>
			<div class="waves_list">
			<?php while ( have_rows('wave_types', 'theme_options') ) : the_row(); ?>
				<div class="one_wave">
					<div class="one_wave_icon">
						<?php 
						$image = get_sub_field('wave_image');
						if( !empty($image) ): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php endif; ?>
					</div>
					<div class="one_wave_title"><?php the_sub_field('wave_title'); ?></div>
					<div class="wave_hz"><?php the_sub_field('wave_hz'); ?></div>
					<div class="wave_pros">
						<?php $wave_prosses = get_sub_field('wave_prosses');
						if( is_array($wave_prosses) ){
							echo '<ul>';
							foreach($wave_prosses as $wave_pross){
								echo '<li>'.$wave_pross['wave_pross'].'</li>';
							}
							echo '</ul>';
						} ?>
					</div>
				</div>
			<?php endwhile; ?>
			</div>
		<?php else : endif; ?>



		<div class="button_block desktop center">
			<div class="button orange" onclick='location.href="<?php the_field('footer_button_link', 'theme_options'); ?>"'><?php the_field('footer_button_text', 'theme_options'); ?></div>
		</div>
		<div class="button_block mobile center">
			<div class="button orange" onclick='location.href="<?php the_field('footer_button_link', 'theme_options'); ?>"'><?php the_field('footer_button_text_mob', 'theme_options'); ?></div>
		</div>



	</div><!--footer_top-->
</div><!--box-->

<div class="footer_bottom_text">
	<div class="box">
		<p><?php the_field('footer_text_under_button', 'theme_options'); ?></p>
	</div>
</div><!--footer_bottom_text-->
<div class="footer_bottom_menu">

	<div class="box">

		<?php if ( is_active_sidebar( 'footer_col_1' ) ) : ?>
			<div class="one_footer_col">
			<?php dynamic_sidebar( 'footer_col_1' ); ?>
			</div>
		<?php endif; ?>


		<?php if ( is_active_sidebar( 'footer_col_2' ) ) : ?>
			<div class="one_footer_col">
			<?php dynamic_sidebar( 'footer_col_2' ); ?>
			</div>
		<?php endif; ?>


		<?php if ( is_active_sidebar( 'footer_col_3' ) ) : ?>
			<div class="one_footer_col">
			<?php dynamic_sidebar( 'footer_col_3' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer_col_4' ) ) : ?>
			<div class="one_footer_col">
			<?php dynamic_sidebar( 'footer_col_4' ); ?>
			</div>
		<?php endif; ?>

	</div>

</div>



</footer>



<div class="signup_form_popup">
	<div class="popup_bg">
		<div class="popup white_bg">
			<div class="close"></div>
			<div class="popup_title">Sing up</div>

			<form name="registrationform" id="registrationform" method="post" class="userform" action="#">
				<div class="response"></div>
				<input type="email" name="user_login" id="user_login" placeholder="Email">
				<input type="password" name="pass1" id="pass1" placeholder="Password">
				<input type="password" name="pass2" id="pass2" placeholder="Repeat password">
				<div class="submit_block">
					<input type="submit" class="submit_button button" value="Sing up">
				</div>
				<input type="hidden" name="redirect_to" value="/">
				<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('register_me_nonce'); ?>">
				<input type="hidden" name="action" value="register_me">
			</form>
		</div>
	</div>
</div>


<div class="login_form_popup">
	<div class="popup_bg">
		<div class="popup white_bg">
			<div class="close"></div>
			<div class="popup_title">Log in</div>
			<form name="loginform" id="loginform" method="post" class="userform" action="#">
				<div class="response"></div>
				<input type="text" name="log" id="user_login" placeholder="Email">
				<input type="password" name="pwd" id="user_pass" placeholder="Password">
				<input name="rememberme" type="checkbox" value="forever" id="rememberme"> <label for="rememberme" class="rememberme_label">Remember me</label>
				<div class="submit_block">
				<input type="submit" class="submit_button button" value="Login">
				</div>
				<input type="hidden" name="redirect_to" value="/">
				<input type="hidden" name="log_for_review" value="">
				<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('login_me_nonce'); ?>">
				<input type="hidden" name="action" value="login_me">
			</form>
			<div class="reset_password_link">Forgot password</div>
		</div>
	</div>
</div>


<div class="lostpassword_form_popup">
<div class="popup_bg">
	<div class="popup">

		<form action="#" name="lostpasswordform" id="lostpasswordform" method="post" class="userform">
			<div class="popup_title">Reset password</div>
			<input type="text" name="user_login" placeholder="Your email">
			<div class="submit_block">
				<input type="submit" class="submit_button" value="Reset">
			</div>
			<input type="hidden" name="redirect_to" value="/"> <!-- можно не заполнять если редирект не нужен -->
		    <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('lost_password'); ?>">
		    <input type="hidden" name="action" value="lost_password">
		</form>

	</div>
</div>
</div>

<?php wp_footer(); ?>

</body>

</html>