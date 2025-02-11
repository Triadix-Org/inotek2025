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
					<div id="parent-<?php the_ID(); ?>" class="page-sme-item col-sm-4">
						<?php if (has_post_thumbnail()) : ?>
							<?php the_post_thumbnail('medium', array('class' => 'img-responsive sme-thumb', 'title' => 'Feature image')); ?>
						<?php endif; ?>
						<div class="text-center sme-desc">
							<h4 class="text-color-primary"><strong><?php the_title(); ?></strong></h4>
							<div class="text-md"><?php echo get_post_meta(get_the_ID(), '_location', true); ?></div>
						</div>
						<div class="sme-cta text-center">
							<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_website', true)); ?>" target="_blank">Website</a>
							<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_olshop', true)); ?>" target="_blank">Toko Online</a>
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
			<div id="parent-<?php the_ID(); ?>" class="page-sme-item col-sm-4">
				<?php if (has_post_thumbnail()) : ?>
					<?php the_post_thumbnail('medium', array('class' => 'img-responsive sme-thumb', 'title' => 'Feature image')); ?>
				<?php endif; ?>
				<div class="text-center sme-desc">
					<h4 class="text-color-primary"><strong><?php the_title(); ?></strong></h4>
					<div class="text-md"><?php echo get_post_meta(get_the_ID(), '_location', true); ?></div>
				</div>
				<div class="sme-cta text-center">
					<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_website', true)); ?>" target="_blank">Website</a>
					<a class="sme-button" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_olshop', true)); ?>" target="_blank">Toko Online</a>
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
