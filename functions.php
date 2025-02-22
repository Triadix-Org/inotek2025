<?php

require dirname(__FILE__) . '/inc/menu.php';
require dirname(__FILE__) . '/inc/theme_options.php';

add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_image_size('article-thumb', 500, 500);
add_action('init', 'inotek_register_menu');

if (! function_exists('inotek_bootstrap')) {
	function inotek_bootstrap() {}
}

add_action('after_setup_theme', 'inotek_bootstrap');

function inotek_style_loader()
{
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/lib/bootstrap/css/bootstrap.css');

	if (is_front_page()) {
		wp_enqueue_style('slick', get_template_directory_uri() . '/assets/lib/slick/slick.css');
		wp_enqueue_style('slick_theme', get_template_directory_uri() . '/assets/lib/slick/slick-theme.css');
	}
	wp_enqueue_style('site-style', get_template_directory_uri() . '/assets/css/style.css');

	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/assets/lib/bootstrap/js/bootstrap.js', array('jquery'), false, true);

	if (is_front_page()) {
		wp_enqueue_script('easytabs', get_template_directory_uri() . '/assets/lib/easytabs/jquery.easytabs.js', array('jquery'), false, true);
		wp_enqueue_script('num_scroller', get_template_directory_uri() . '/assets/lib/jquery.numscroller-1.0.js', array(
			'jquery'
		), false, true);
		wp_enqueue_script('hash_change', get_template_directory_uri() . '/assets/lib/jquery.ba-hashchange.js', array('jquery'), false, true);
		wp_enqueue_script('slick', get_template_directory_uri() . '/assets/lib/slick/slick.js', array(
			'jquery',
			'hash_change'
		), false, true);
		wp_enqueue_script(
			'inotek_front_page',
			get_template_directory_uri() . '/assets/js/frontpage.js',
			array('jquery', 'bootstrap_js', 'num_scroller', 'easytabs', 'slick'),
			false,
			true
		);
	}

	wp_enqueue_script('html5shiv', get_template_directory_uri() . 'assets/lib/html5shiv.min.js', array('jquery'), false, true);
	wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
	wp_enqueue_script('placeholder', get_template_directory_uri() . '/assets/lib/placeholder.min.js', null, false, true);
	wp_script_add_data('placeholder', 'conditional', 'lt IE 9');
	wp_enqueue_script(
		'inotek_js',
		get_template_directory_uri() . '/assets/js/inotek.js',
		array('jquery', 'bootstrap_js')
	);
}

add_action('wp_enqueue_scripts', 'inotek_style_loader');


function inotek_custom_logo_setup()
{
	$defaults = array(
		'height'      => 54,
		'width'       => 187,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array('site-title', 'site-description')
	);

	add_theme_support('custom_logo', $defaults);
}

add_action('after_setup_theme', 'inotek_custom_logo_setup');

function inotek_language_switcher()
{
	$language = array();
	if (function_exists('pll_the_languages')) {
		$translations = pll_the_languages(array('raw' => 1));
		if ($translations) {
			foreach ($translations as $translation) {
				$language['options'][] = $translation;
				if ($translation['current_lang']) {
					$language['current'] = $translation;
				}
			}
		}
	}

	return $language;
}

function inotek_gutenberg_css()
{
	add_theme_support('editor-styles');
	add_editor_style('assets/css/style-editor.css');
}

add_action('after_setup_theme', 'inotek_gutenberg_css');

/**
 * @param $wp_customize WP_Customize_Manager
 */
function inotek_customize_register($wp_customize)
{
	inotek_options_funding($wp_customize);
}

add_action('customize_register', 'inotek_customize_register');

function inotek_get_url($link, $type = 'page')
{
	$args = array(
		'name'        => $link,
		'post_type'   => $type,
		'post_status' => 'publish',
		'numberposts' => 1
	);

	$post = get_posts($args);

	return $post[0];
}

function inotek_get_post_id($slug)
{
	$page = get_page_by_path($slug);
	if ($page == null) {
		return null;
	}

	if (function_exists('wpml_get_object_id')) {
		return wpml_get_object_id($page->ID);
	}

	if (function_exists('icl_object_id')) {
		return icl_object_id($page->ID);
	}

	return $page->ID;
}

function inotek2020_query_vars($inotek_vars)
{
	$inotek_vars[] = 'innovation-status';
	return $inotek_vars;
}
add_filter('query_vars', 'inotek2020_query_vars');


add_filter('tribe_get_cost', 'inotek2020_event_cost', 10, 2);

function inotek2020_event_cost($cost, $post_id)
{
	$number_only = preg_replace('/[^0-9]/', '', $cost);
	$cost_format = number_format(absint($number_only), 0, ',', '.');
	return tribe_format_currency($cost_format, $post_id);
}

function inotek_sme_shortcode($atts)
{
	// Menangkap output HTML menggunakan output buffering
	ob_start();

	// HTML untuk filter kategori
?>
	<div class="container">
		<div class="category-filter text-center">
			<button class="filter-button active-category-sme" data-category="">All</button>
			<?php
			$categories = get_terms([
				'taxonomy'   => 'sme-categories',
				'hide_empty' => true,
			]);

			if (!empty($categories) && !is_wp_error($categories)) {
				foreach ($categories as $category) {
					echo '<button class="filter-button" data-category="' . esc_attr($category->slug) . '">' . esc_html($category->name) . '</button>';
				}
			}
			?>
		</div>
	</div>
	<div class="container sme-content">
		<div class="row gx-4">
			<?php
			// WP_Query untuk menampilkan post
			$args = array(
				'post_type'      => 'inotek_sme',
				'posts_per_page' => 9,
			);

			$parent = new WP_Query($args);

			if ($parent->have_posts()) :
				while ($parent->have_posts()) : $parent->the_post(); ?>
					<div id="parent-<?php the_ID(); ?>" class="page-sme-item col-sm-3">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('medium', array('class' => 'img-responsive sme-thumb', 'title' => 'Feature image')); ?>
						<?php endif; ?>
						<div class="text-center sme-desc">
							<h4 class="text-color-primary"><strong><?php the_title(); ?></strong></h4>
							<div class="text-md"><?php echo get_post_meta(get_the_ID(), '_location', true); ?></div>
							<?php
							$terms = get_the_terms(get_the_ID(), 'sme-categories');
							if ($terms && !is_wp_error($terms)) {
								foreach ($terms as $term) {
									echo '<div class="text-md text-color-primary">Category: <strong>' . esc_html($term->name) . '</strong></div>';
								}
							}
							?>
						</div>
						<div class="sme-cta text-center">
							<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_website', true)); ?>" target="_blank">Website</a>
							<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_olshop', true)); ?>" target="_blank">Online Shop</a>
						</div>
					</div>
			<?php endwhile;
			endif;
			wp_reset_postdata();
			?>
		</div>
	</div>

	<script>
		jQuery(document).ready(function($) {
			$('.filter-button').on('click', function() {
				var category = $(this).data('category');

				// Tambahkan class 'active' ke tombol yang diklik, hapus dari tombol lainnya
				$('.filter-button').removeClass('active-category-sme');
				$(this).addClass('active-category-sme');

				$.ajax({
					url: "<?php echo admin_url('admin-ajax.php'); ?>",
					type: "POST",
					data: {
						action: "filter_posts",
						category: category
					},
					beforeSend: function() {
						$('.sme-content').html('<p>Loading...</p>');
					},
					success: function(response) {
						$('.sme-content').html(response);
					},
					error: function() {
						$('.sme-content').html('<p>Error loading content.</p>');
					}
				});
			});
		});
	</script>
	<?php

	return ob_get_clean();
}
add_shortcode('inotek_sme', 'inotek_sme_shortcode');


function filter_posts_by_category()
{
	$category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';

	$args = array(
		'post_type'      => 'inotek_sme',
		'posts_per_page' => 9,
	);

	if (!empty($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'sme-categories',
				'field'    => 'slug',
				'terms'    => $category,
			)
		);
	}

	$query = new WP_Query($args);

	if ($query->have_posts()) :
		echo '<div class="row gx-4">';
		while ($query->have_posts()) : $query->the_post(); ?>
			<div id="parent-<?php the_ID(); ?>" class="page-sme-item col-sm-3">
				<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('medium', array('class' => 'img-responsive sme-thumb', 'title' => 'Feature image')); ?>
				<?php endif; ?>
				<div class="text-center sme-desc">
					<h4 class="text-color-primary"><strong><?php the_title(); ?></strong></h4>
					<div class="text-md"><?php echo get_post_meta(get_the_ID(), '_location', true); ?></div>
					<?php
					$terms = get_the_terms(get_the_ID(), 'sme-categories');
					if ($terms && !is_wp_error($terms)) {
						foreach ($terms as $term) {
							echo '<div class="text-md text-color-primary">Category: <strong>' . esc_html($term->name) . '</strong></div>';
						}
					}
					?>
				</div>
				<div class="sme-cta text-center">
					<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_website', true)); ?>" target="_blank">Website</a>
					<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_olshop', true)); ?>" target="_blank">Online Shop</a>
				</div>
			</div>
	<?php endwhile;
		echo '</div>';
	else :
		echo '<p>No posts found.</p>';
	endif;

	wp_reset_postdata();

	wp_die();
}
add_action('wp_ajax_filter_posts', 'filter_posts_by_category');           // Untuk user login
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts_by_category');   // Untuk user non-login


function inotek_achievement_shortcode($atts)
{
	ob_start();
	?>
	<div class="text-center row">
		<?php
		$achievement_args = array(
			'post_type'     => 'inotek_achievement',
			'post_per_page' => 6,
			'meta_key'      => '_achievement_position',
			'orderby'       => array('meta_value_num' => 'ASC')
		);

		$achievement_query = new WP_Query($achievement_args);

		if ($achievement_query->have_posts()) {
			while ($achievement_query->have_posts()) {
				$achievement_query->the_post();
				$link = trim(get_post_meta(get_the_ID(), '_achievement_link', true));
		?>
				<div class="stat-item col-lg-6">
					<div class="stat-number">
						<span class="stat-prefix"><?php echo get_post_meta(get_the_ID(), '_achievement_prefix', true); ?></span>
						<span class="numscroller"
							data-delay="<?php echo get_post_meta(get_the_ID(), '_achievement_delay', true); ?>"
							data-increment="<?php echo get_post_meta(get_the_ID(), '_achievement_increment', true); ?>"
							data-max="<?php echo get_post_meta(get_the_ID(), '_achievement_value', true); ?>"
							data-min="1"><?php echo get_post_meta(get_the_ID(), '_achievement_value', true); ?></span>
					</div>
					<span class="stat-text"><a href="#"></a>
						<?php if (empty($link)): ?>
							<?php the_title(); ?>
						<?php else: ?>
							<a href="<?php print_r(get_permalink(inotek_get_url($link))); ?>"><?php the_title(); ?></a>
						<?php endif; ?>
					</span>
				</div>
		<?php
			}
		}

		wp_reset_postdata();
		?>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('inotek_achievement', 'inotek_achievement_shortcode');


// Shortcode Scale Up
function inotek_scale_shortcode($atts)
{
	ob_start();
?>
	<div class="container-fluid bg-gradient-primary" id="forum-container">
		<div class="container front-page-padding">
			<div class="row forum-grid">
				<div class="col-lg-6" style="padding-right:20px;">
					<h2 class="heading-2 front-page-heading" style="text-align: left;"><?php _e('Scale up Forum', 'inotek2025'); ?></h2>
					<div>
						<?php
						$live_forum_args = array(
							'post_type'     => 'inotek_forum',
							'post_per_page' => 1,
						);

						$live_forum_query = new WP_Query($live_forum_args);

						if ($live_forum_query->have_posts()) {
							while ($live_forum_query->have_posts()) {
								$live_forum_query->the_post(); ?>
								<h3 class="heading-4 forum-title"><?php the_title(); ?></h3>
								<div class="embed-responsive embed-responsive-16by9">
									<?php
									echo get_post_meta(get_the_ID(), '_forum_embed', true);
									?>
								</div>
						<?php
							}
						}

						wp_reset_postdata();
						?>

					</div>
				</div>
				<div class="col-lg-6">
					<h2 class="heading-2 front-page-heading" style="text-align: left;"><?php _e('Upcoming events', 'inotek2025'); ?></h2>
					<?php
					global $post;

					$events = tribe_get_events([
						'posts_per_page' => 5,
						'eventDisplay'   => 'custom',
						'start_date'     => 'now',
					]);

					if (count($events) > 0):
						foreach ($events as $post): setup_postdata($post); ?>
							<div class="event-card">
								<p class="event-date"><?php echo tribe_get_start_date($post, false, 'd F Y') ?></p>
								<p class="event-title">
									<a class="event-link"
										href="<?php echo tribe_get_event_link(); ?>"><?php echo $post->post_title; ?></a>
								</p>
							</div>
						<?php endforeach;
					else:
						?>
						<p><?php echo __('No event plan yet. Stay tuned') ?></p>
					<?php
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('inotek_scale_up', 'inotek_scale_shortcode');


// ShortCode Partner
function inotek_partner_shortcode($atts)
{
	ob_start();
?>
	<div class="partner-slide">
		<?php
		$partner_args  = array(
			'post_type' => 'inotek_partner',
			'meta_key'  => '_inotek_partner_order',
			'orderby'   => array('meta_value_num' => 'ASC'),
			'posts_per_page' => -1
		);
		$partner_query = new WP_Query($partner_args);

		if ($partner_query->have_posts()) {
			while ($partner_query->have_posts()) {
				$partner_query->the_post();
				get_template_part('template-parts/frontpage/content', 'partner');
			}
		}

		wp_reset_postdata();
		?>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('inotek_partner', 'inotek_partner_shortcode');

function inotek_journeys_shortcode($atts)
{
	ob_start();
?>

	<div class="timeline">
		<?php
		$journey_args = array(
			'post_type'     => 'inotek_journey',
			'orderby'       => array('meta_value_num' => 'ASC'),
			'posts_per_page' => -1
		);

		$journey_query = new WP_Query($journey_args);
		$counter = 0; // Inisialisasi counter

		if ($journey_query->have_posts()) :
			while ($journey_query->have_posts()) : $journey_query->the_post();
				$class = ($counter % 2 === 0) ? 'left' : 'right'; // Tentukan class selang-seling
		?>
				<div class="container-journey <?php echo $class; ?> " data-aos="fade-up" data-aos-duration="2000">
					<div class="content-journey">
						<div class="title-journey"><?php the_title(); ?></div>
						<div class="desc-journey"><?php the_content(); ?></div>
					</div>
				</div>
		<?php
				$counter++; // Increment counter
			endwhile;
			wp_reset_postdata();
		endif;
		?>
	</div>
	<script>
		const accordionItems = document.querySelectorAll('.accordion-item');

		accordionItems.forEach(item => {
			const title = item.querySelector('.accordion-title');
			const content = item.querySelector('.accordion-content');

			title.addEventListener('click', () => {
				// Tutup semua konten yang terbuka
				accordionItems.forEach(i => {
					const otherContent = i.querySelector('.accordion-content');
					if (i !== item && otherContent.classList.contains('open')) {
						otherContent.classList.remove('open');
						otherContent.style.maxHeight = null;
					}
				});

				// Toggle konten item yang diklik
				if (content.classList.contains('open')) {
					content.classList.remove('open');
					content.style.maxHeight = null;
				} else {
					content.classList.add('open');
					content.style.maxHeight = content.scrollHeight + "px";
				}
			});
		});
	</script>
<?php
	return ob_get_clean();
}
add_shortcode('inotek_journey', 'inotek_journeys_shortcode');
