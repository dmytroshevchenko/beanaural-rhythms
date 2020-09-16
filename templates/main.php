<?php 
/*Template name: Main page*/
get_header(); ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>





<?php if( have_rows('main_page_block') ): ?>
<?php while ( have_rows('main_page_block') ) : the_row(); ?>
<?php if( get_row_layout() == 'main_bg' ): ?>



<section>

	<div class="main_bg">
		<div class="box">
			<div class="main_block">
				<div class="main_block_content">
					<h1><?php echo get_sub_field('left_block')['block_title']; ?></h1>
					<div class="main_block_description">
						<?php echo get_sub_field('left_block')['description']; ?>
					</div>

					<div class="button_block">
						<div class="button orange" onclick='location.href="<?php echo get_sub_field('left_block')['button_link']; ?>"'><?php echo get_sub_field('left_block')['button_text']; ?></div>
					</div>
				</div>

				<div class="main_block_right">
					<div class="main_block_video">
						<div class="dark_shadow">
							<?php echo get_sub_field('right_video'); ?>
						</div>
					</div>

					<div class="button_block">
						<div class="button orange"><?php echo get_sub_field('left_block')['button_text']; ?></div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<div class="tools_links_block">
				<div class="tools_description"><?php the_sub_field('tools_description'); ?></div>


				<?php if( have_rows('tools_links') ): ?>
					<div class="tools_links">
					<?php while ( have_rows('tools_links') ) : the_row(); ?>


						<div class="one_tool <?php the_sub_field('shadow_color') ?>" onclick='location.href="<?php echo get_term_link (get_sub_field('link'), 'music_cat' ); ?>"'>
							<div class="one_tool_bg">
								<?php 
								$background = get_sub_field('background');
								if( !empty($background) ): ?>
									<img src="<?php echo $background['url']; ?>" alt="<?php echo $background['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="one_tool_image">
								<?php 
								$little_image = get_sub_field('little_image');
								if( !empty($little_image) ): ?>
									<img src="<?php echo $little_image['url']; ?>" alt="<?php echo $little_image['alt']; ?>" />
								<?php endif; ?>
							</div>
							<div class="one_tools_title"><?php the_sub_field('title') ?></div>
							<div class="one_tools_description"><?php the_sub_field('description') ?></div>
						</div>

					<?php endwhile; ?>
					</div>
				<?php else : endif; ?>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

</section>


<?php elseif( get_row_layout() == 'how_to_use_block' ): ?>



<section>

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

</section>

<?php elseif( get_row_layout() == 'categories_list_block' ): ?>



<section>
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
</section>






<?php endif; endwhile; endif; ?>




<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>


<?php get_footer(); ?>
