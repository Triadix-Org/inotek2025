<?php /* Template Name: Program Template */ ?>
<?php get_header(); ?>
<div class="bg-washed-blue">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div id="site-page">
					<h1 class="page-title"><?php the_title(); ?><br>
						<span class="sub-title"><?php  ?></span>
					</h1>
				</div>
			</div>
		</div>
	</div>
</div>
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
