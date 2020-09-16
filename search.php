<?php get_header(); ?>



<section>
	<div class="box">
		<div class="category_list_block archive_page">
			<h1 class="categories_title"><?php echo get_search_query() ?></h1>

			<div class="category_list">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="one_category no_bg" onclick='location.href="<?php the_permalink(); ?>"'>
						<div class="one_category_image">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="one_category_title">
							<?php  the_title(); ?>
						</div>
						<div class="one_category_description">
							<?php the_excerpt(); ?>
						</div>
					</div>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>


			</div>
		</div>
	</div>
</section>




<?php get_footer() ?>