<?php /* Template Name: Page SME */ ?>
<?php get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-title">Katalog Produk UMKM</h1>
            <div class="text-color-primary" style="margin-top: 40px;"><strong>INOTEK</strong> didasari oleh keyakinan yang kuat bahwa inovasi teknologi yang aplikatif dan tepat guna mampu memberikan manfaat serta dampak sosial dan ekonomi yang signifikan untuk meningkatkan kesejahteraan masyarakat.</div>
            <div class="text-color-primary" style="margin-top: 20px;">Sebagai bagian dari upaya tersebut, Program Ekosistem Kewirausahaan dibentuk dengan salah satu tujuan utamanya, yaitu membuka akses pasar bagi UMKM binaan. Berikut adalah beberapa produk unggulan dari UMKM yang telah menjadi bagian dari program ini:</div>
        </div>
    </div>
</div>
<div class="container">
    <div class="category-filter text-center">
        <button class="filter-button" data-category="">All</button>
        <?php
        $categories = get_terms([
            'taxonomy' => 'sme-categories',
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

<div class="container page-content">
    <?php
    $args = array(
        'post_type'      => 'inotek_sme',
        'posts_per_page' => 9,
    );

    $parent = new WP_Query($args);

    if ($parent->have_posts()) : ?>
        <div class="row gx-4">
            <?php while ($parent->have_posts()) : $parent->the_post(); ?>
                <div id="parent-<?php the_ID(); ?>" class="page-sme-item col-sm-4">
                    <?php the_post_thumbnail(array(156, false), array('class' => 'img-responsive sme-thumb', 'title' => 'Feature image')); ?>
                    <div class="text-center sme-desc">
                        <h4 class="text-color-primary"><strong><?php the_title(); ?></strong></h4>
                        <div class="text-md"><?php echo get_post_meta(get_the_ID(), '_location', true); ?></div>
                    </div>
                    <div class="sme-cta text-center">
                        <a class="sme-button" href="<?php echo get_post_meta(get_the_ID(), '_website', true); ?>">Website</a>
                        <a class="sme-button" href="<?php echo get_post_meta(get_the_ID(), '_olshop', true); ?>">Toko Online</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif;
    wp_reset_postdata(); ?>
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
                    $('.page-content').html('<p>Loading...</p>');
                },
                success: function(response) {
                    $('.page-content').html(response);
                }
            });
        });
    });
</script>

<?php get_footer(); ?>