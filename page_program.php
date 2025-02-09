<?php /* Template Name: Program Template */ ?>
<?php get_header(); ?>
<?php the_post_thumbnail('100%', array('class' => 'hero-image-program', 'title' => 'Feature image')); ?>
<div class="container page-content">
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
			<div id="parent-<?php the_ID(); ?>" class="page-program-item">
				<h3 class="heading-3"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
	<?php endif;
	wp_reset_postdata();

	if ($parent->have_posts()) : ?>
		<?php while ($parent->have_posts()) : $parent->the_post(); ?>
			<div id="parent-<?php the_ID(); ?>" class="page-program-item row">
				<div class="col-lg-3">
					<?php the_post_thumbnail(array(156, false), array('class' => 'img-responsive program-thumb', 'title' => 'Feature image')); ?>
				</div>
				<div class="col-lg-9">
					<h3 class="heading-3"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<?php the_content(); ?>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif;
	wp_reset_postdata(); ?>
</div>
<?php get_footer();
