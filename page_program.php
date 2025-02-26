<?php /* Template Name: Program Template */ ?>
<?php get_header(); ?>
<?php the_post_thumbnail('100%', array('class' => 'hero-image-program', 'title' => 'Feature image')); ?>
<div class="page-content">
	<?php

	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => 5,
		'post_parent'    => $post->ID,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	);


	$parent = new WP_Query($args);

	if ($parent->have_posts()) : ?>
		<?php while ($parent->have_posts()) : $parent->the_post(); ?>
			<div class="container">
				<div id="parent-<?php the_ID(); ?>" class="page-program-item">
					<h3 class="heading-3 heading-program"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<?php the_content(); ?>
				</div>
			</div>
			<?php
			if ($parent->current_post + 1 < $parent->post_count) : ?>
				<div class="bg-gradient-primary rounded-top-separator" style="height: 60px; margin-top: 80px;"></div>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php endif;
	wp_reset_postdata(); ?>
</div>
<?php get_footer();
