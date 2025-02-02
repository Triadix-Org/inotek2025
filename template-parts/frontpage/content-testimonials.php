<div class="col-lg-4">
    <div class="testimonial-card">
        <div class="testimonial-content">
            “<?php echo get_the_excerpt(); ?>”
        </div>
        <div class="testimonial-info">
            <?php if( has_post_thumbnail()): ?>
            <img alt="<?php echo get_post_meta(get_the_ID(), '_person_name', true); ?> " class="testimonial-avatar"
                 src="<?php the_post_thumbnail_url(); ?>">
            <?php else: ?>
                <img alt="" class="testimonial-avatar" class="testimonial-avatar"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/nopic.png" ?>
            <?php endif; ?>
            <p class="testimonial-person"><?php echo get_post_meta( get_the_ID(), '_person_name', true ); ?></p>
            <p class="testimonial-project">
				<?php the_title(); ?>
            </p>
        </div>
    </div>
</div>
