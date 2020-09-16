<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php wp_title(); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php wp_head(); ?>

</head>

<body>

<header id="header" <?php  if( is_page_template('templates/main.php') ){ echo 'class="index_header"'; } ?>>
<div class="box">
	<div class="logo">
		<a href="<?php echo home_url(); ?>">
			<?php $custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );?>

			<img src="<?php echo $image[0]; ?>" alt="Sound Therapy Studio">
			<div class="logo_description"><?php bloginfo( 'name' ); ?></div>
		</a>
	</div><!--logo-->

	<div class="header_right">
		<div class="header_right_top">
			<div class="search_form">
				<form role="search" method="get" id="searchform" class="search_form" action="<?php echo home_url( '/' ) ?>" >
					<input type="text" value="<?php echo get_search_query() ?>" name="s" id="s" class="search_input" />
					<input type="submit" id="searchsubmit" class="hidden" value="найти" />
				</form>
			</div>
			<div class="header_buttons">
				<button class="transparency guide_button"  onclick="location.href='<?php echo the_field('user_guid_page', 'theme_options') ?>'">User Guide</button>
				<?php if( is_user_logged_in() ){ ?>
					<button class="orange" onclick="location.href='<?php echo the_field('account_page', 'theme_options') ?>'">Profile</button>
					<button class="grey" onclick="location.href='<?php echo wp_logout_url(); ?>'">Logout</button>
				<?php } else{ ?>
					<button class="orange sign_up_button">Sign up</button>
					<button class="grey login_button">Login</button>
				<?php } ?>
			</div>
			<div class="cart_button">
				<div class="cart_count">2</div>
			</div>
			<div class="adaptive_menu"  id="adaptive_menu"></div>
		</div>


		<div class="main_menu">
			<?php wp_nav_menu( array( 'theme_location'  => 'main_menu') ); ?>
		</div>
	</div>


</div>
</header>


<main>
