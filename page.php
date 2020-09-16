<?php get_header(); //test test?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<section>
		<div class="box">
			<div class="page">
				<h1 class="page_title"><?php the_title(); ?></h1>
				<div class="content">
					<?php the_content(); ?>
				</div>
			
			
			
			
			
<?php if( have_rows('page_block') ): ?>
<?php while ( have_rows('page_block') ) : the_row(); ?>



<?php if( get_row_layout() == 'how_to_use_block' ): ?>


	<div class="descrition_block">
		<div class="box">
			<h2 class="blue"><?php the_sub_field('block_title'); ?></h2>
			<div class="content">
				<?php the_sub_field('content'); ?>
				<div class="shadow"></div>
			</div>

			<div class="button_block center">
				<button class="green_button">More
					<span class="arrow"></span></button>
			</div>
		</div>
	</div>


<?php elseif( get_row_layout() == 'categories_list_block' ): ?>



	<div class="box">
		<div class="category_list_block">
			<h2 class="block_title"><?php the_sub_field('block_title'); ?></h2>


			<?php if( have_rows('categories') ): ?>
			<div class="category_list">

				<?php while ( have_rows('categories') ) : the_row(); ?>

					<?php $category_id = get_sub_field('category');

					$term_link = get_term_link($category_id, 'music_cat');
					?>
					<div class="one_category" onclick='location.href="<?php echo $term_link; ?>"'>
						<div class="one_category_image">
							<?php 
							$image = get_field('category_image', 'term_'.$category_id );
							if( !empty($image) ): ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
						</div>
						<div class="one_category_title">
							<?php echo get_term( $category_id )->name; ?>
						</div>
					</div>

				<?php endwhile; ?>
			</div>
			<?php else : endif; ?>



			<div class="find_more_link center">
				<a href="<?php the_field('bottom_link_link'); ?>"><?php the_field('bottom_link_label'); ?></a>
			</div>
		</div>
	</div>




<?php elseif( get_row_layout() == 'user_guide_block' ): ?>

	<div class="box">

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
	</div>
				
				
				
				
				
<?php elseif( get_row_layout() == 'contact_form_block' ): 
				
				
			$current_user_id = get_current_user_id();

			$user_data = get_user_meta( $current_user_id );
			$user_email = get_userdata( $current_user_id )->data->user_email;

				?>
						<form class="user_info_form">

							<div class="user_info_form_title">First name</div>
							<input type="text" class="user_info_form_input your_name" value="<?php echo $user_data['first_name'][0]; ?>" placeholder="">

							<div class="user_info_form_title">E-mail</div>
							<input type="text" class="user_info_form_input your_email" value="<?php echo $user_email; ?>" placeholder="">

							<div class="user_info_form_title">Thema</div>
							<input type="text" class="user_info_form_input your_theme" placeholder="">

							<div class="user_info_form_title">Message</div>
							<textarea  class="user_info_form_textarea your_message"></textarea>

							<div class="button_block">
								<input type="submit" class="button orange" value="Send">
							</div>					
						</form>

				
				
				
				

<?php endif; endwhile; endif; ?>

			
			
			
			
			</div>
			
			

			<div class="find_more_link center">
				<a href="<?php the_field('find_more_link_link', 'theme_options') ?>"><?php the_field('find_more_link_text', 'theme_options') ?></a>
			</div>
			
		</div>
	</section>







<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php get_footer(); ?>