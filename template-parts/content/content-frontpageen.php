<div>
    <div class="container front-page-padding">
        <div class="" id="site-intro">
            <div class="col-lg-6" id="site-intro-text">
                <p class="site-intro-title" style="margin-top: 10px; text-transform:uppercase;">Welcome<br> Future Startup!</p>
                <p class="site-intro-subtitle">To Indonesia's credible Technology Business Incubator.</p>
                <p class="site-intro-subtitle">The Indonesian Technology Innovation Foundation (INOTEK) is a business incubator dedicated to supporting the growth of enterprises based on Appropriate Technology. Through innovation and mentorship, INOTEK empowers entrepreneurs to develop sustainable solutions that create a positive social impact.</p>
                <p class="site-intro-subtitle" style="font-style: italic;">Applied Technology for Common Good.</p>
                <!-- 
                    <div id="stsp-banner" style="margin-top: 30px;">
                        <p>
                            <img src="<?php echo get_template_directory_uri() ?>/assets/images/stsp_logo.png" class="img-responsive"><br>
                            <strong>Program Kewirausahaan Kolaboratif</strong><br>
                        untuk membuat jaringan startup teknopreneur di 34 propinsi</p>
                        <p style="margin-top: 30px">
                            <a href="http://stsp.inotek.org/" target="_blank" class="btn btn-primary"
                               style="background-color: #00C5CD; border: 0; font-weight: 600">Join Now</a>
                        </p>
                    </div> -->
            </div>
            <div class="col-lg-6 text-center" id="site-intro-image">
                <img alt="Inotek Illustration" style="margin-top: 40px; border-radius: 20px;"
                    src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-section.png"
                    width="500" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-gradient-primary" id="program-container">
    <div class="container front-page-padding">
        <h2 class="heading-2 front-page-heading"><?php _e('Are you ready to scale up?', 'inotek2025'); ?></h2>
        <div class="row">
            <?php
            $program_id    = inotek_get_post_id('program');
            $program_args  = array(
                'post_type'      => 'page',
                'posts_per_page' => 4,
                'post_parent'    => $program_id,
                'order'          => 'ASC',
                'orderby'        => 'menu_order'
            );
            $program_query = new WP_Query($program_args);

            if ($program_query->have_posts()) {
                while ($program_query->have_posts()) {
                    $program_query->the_post();
            ?>
                    <div class="col-lg-3">
                        <div class="program-card">
                            <img alt="" class="program-image"
                                src="<?php echo get_the_post_thumbnail_url() ?>">
                            <h3 class="program-title"><?php the_title() ?></h3>
                            <div class="program-subtitle"><?php echo get_post_meta(get_the_ID(), 'subtitle', true); ?></div>
                            <a class="program-card-link" href="<?php echo get_the_permalink(); ?>">Informasi Selanjutnya</a>
                        </div>
                    </div>
            <?php
                }
            }
            wp_reset_postdata();
            ?>
        </div>

    </div>
</div>

<div class="container front-page-padding" id="achievement">
    <div class="row">
        <div class="col-lg-6">
            <div class="achiev-desc text-center">
                <h2 class="heading-2 text-white " style="margin-top: 0; margin-bottom: 20px;"><?php _e('Capaian Kami', 'inotek2025'); ?></h2>
                <div class="achiev-subtitle">
                    Sejak tahun 2008, INOTEK hadir sebagai jembatan untuk menjangkau ratusan wirausaha berbasis teknologi tepat guna di seluruh Indonesia. Kami berkomitmen untuk memobilisasi dukungan bisnis yang diperlukan agar mereka dapat berkembang menjadi perusahaan yang maju dan berkelanjutan.
                </div>
            </div>
            <div class="achiev-button text-center">
                <a href="#">Annual Narrative INOTEK Report 2024</a>
            </div>
        </div>
        <div class="col-lg-6">
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
        </div>
    </div>
</div>

<div class="container-fluid bg-gradient-primary" id="forum-container">
    <div class="container front-page-padding">
        <div class="row forum-grid">
            <div class="col-lg-8" style="padding-right:20px;">
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
            <div class="col-lg-4">
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

<div class="container front-page-padding">
    <h2 class="heading-2-alt front-page-heading">
        <?php _e('Mitra Kami', 'inotek2025'); ?>
    </h2>
    <div class="partner-slide">
        <?php
        $partner_args  = array(
            'post_type' => 'inotek_partner',
            'meta_key'  => '_inotek_partner_order',
            'orderby'   => array('meta_value_num' => 'ASC')
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
</div>

<div class="container front-page-padding">
    <h2 class="heading-2-alt front-page-heading"><?php _e('Apa Kata Mereka?', 'inotek2025'); ?></h2>
    <?php
    $args = array(
        'post_type' => 'inotek_testimonial',
        'meta_key'  => '_highlight_order',
        'orderby'   => array('meta_value_num' => 'ASC')
    );

    $counter           = 0;
    $testimonial_query = new WP_Query($args);
    if ($testimonial_query->have_posts()) {
        $testimonial_total = $testimonial_query->post_count;
        while ($testimonial_query->have_posts()) {
            if ($counter % 3 == 0) {
                echo '<div class="row">';
            }
            $testimonial_query->the_post();
            get_template_part('template-parts/frontpage/content', 'testimonials');
            $counter++;
            if (($counter % 3 == 0) || ($counter == $testimonial_total)) {
                echo '</div>';
            }
        }
    }

    wp_reset_postdata();
    ?>
</div>