<?php get_header(); ?>



<?php
$music_cats = get_terms( array( 'taxonomy' => 'music_cat',
	'hide_empty' => false, ));
?>


<section>
	<div class="box">
		<div class="category_list_block archive_page">
			<h1 class="categories_title">Binaural Beats</h1>




			<div class="category_list">
			<?php foreach($music_cats as $music_cat){
				$category_id = $music_cat->term_id;
				$term_link = get_term_link($category_id, 'music_cat'); ?>
				<div class="one_category" onclick='location.href="<?php echo $term_link; ?>"'>
					<div class="one_category_image">
						<?php
						$image = get_field('category_image', 'term_'.$category_id );
						if( !empty($image) ): ?>
							<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
						<?php endif; ?>
					</div>
					<div class="one_category_title">
						<?php echo $music_cat->name; ?>
					</div>
					<div class="one_category_description">
						<?php echo $music_cat->description; ?>
					</div>
				</div>

			<?php } ?>


			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>