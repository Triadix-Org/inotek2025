<?php /* Template Name: Page Innovator */ ?>
<?php get_header(); ?>
<?php

while (have_posts()) :
	the_post(); ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div id="site-page">
					<h1 class="page-title"><?php the_title(); ?><br>
						<span class="sub-title"><?php echo get_post_meta(get_the_ID(), 'subtitle', true); ?></span>
					</h1>
				</div>
			</div>
		</div>
	</div>
	<div id="content" class="page-content">
		<div class="container archive-container">
			<?php the_content(); ?>
			<?php
			$innovation_category   = get_term_by('id', '78', 'category');
			$innovation_categories = array();
			$category = get_term_by('slug', get_query_var('innovation-status'), 'category', OBJECT, 'db');
			$selected_term_id = $category && ($category->parent == 89 || $category->parent == 78) ? $category->term_id : 78;

			if ($innovation_category) {
				$innovation_categories = get_categories(array('parent' => $innovation_category->term_id));
			}

			if (count($innovation_categories) > 0): ?>
				<ul class="innovator-category-switch list-inline">
					<li><a href="<?php the_permalink(); ?>" class="filter-button"><?php echo __('All'); ?></a></li>
					<?php foreach ($innovation_categories as $category): ?>
						<li><a href="<?php echo get_permalink() . '?innovation-status=' . $category->slug; ?>"
								class="filter-button <?php echo ($selected_term_id == $category->term_id) ? 'category-link-active' : '' ?>"><?php echo $category->name; ?>
							</a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args    = array(
				'cat'  => $selected_term_id,
				'posts_per_page' => 6,
				'paged' => $paged
			);
			$query   = new WP_Query($args);
			$counter = 0;

			if ($query->have_posts()):
				while ($query->have_posts()): ?>
					<?php if ($counter % 3 == 0): ?>
						<div class="row">
						<?php endif; ?>
						<?php
						$query->the_post();
						get_template_part('template-parts/content/content', 'innovator');
						$counter++;
						?>
						<?php if ($counter % 3 == 0 || $counter == $query->post_count): ?>
						</div>
					<?php endif; ?>
			<?php

				endwhile;
			endif;
			?>
			<div class="row">
				<div class="col-lg-6 nav-previous text-left"><?php previous_posts_link(__('Previous'), $query->max_num_pages); ?></div>
				<div class="col-lg-6 nav-next text-right"><?php next_posts_link(__('Next'), $query->max_num_pages); ?></div>
			</div>
			<?php
			wp_reset_postdata();
			?>
		</div>
	</div>
<?php endwhile; ?>
<?php get_footer(); ?>