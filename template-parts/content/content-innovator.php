<div class="col-lg-4">
    <div class="article-card">
        <a href="<?php the_permalink(); ?>" class="article-image-link">
			<?php if ( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail( 'article-thumb', array( 'class' => 'article-thumb' ) ); ?>
			<?php else: ?>
                <img alt="" class="article-thumb img-responsive"
                     src="<?php echo get_template_directory_uri(); ?>/assets/images/recentnews-12x.jpg">
			<?php endif; ?>
        </a>
        <h3 class="article-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
        </h3>
        <p class="article-date">&nbsp;</p>
    </div>
</div>