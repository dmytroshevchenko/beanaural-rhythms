<?php






function music_cats_shortcode( $term_name ){




	$terms = get_terms( array( 'name' => $term_name['cat'] ) );

	$terms_ids = array();
	foreach( $terms as $term ){
		$terms_ids[] = $term->term_id;
	}


	$tax_query = array();
//	foreach( $terms as $term ){
		$tax_query[] = array(
			'taxonomy' => 'music_cat',
			'field'    => 'id',
			'terms'    => $terms_ids, //$term->term_id,
			'operator' => 'OR'
		);
//	}
	$music_posts = get_posts( array( 'post_type' => 'music', 'tax_query' => $tax_query ) );


	$html = '';
	$html .= '<div class="small_category_list">';

	foreach($music_cats as $music_cat){
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
	<?php }






}


add_shortcode( 'music_cats' , 'music_cats_shortcode' );





?>