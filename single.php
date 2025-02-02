<?php

get_header();

?>
    <div class="container">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
            <div class="article-container">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="row">
                        <div class="col-lg-7">
                            <h2 class="heading-2 article-title"><?php the_title(); ?></h2>
                            <p><?php the_date( 'd F Y' ); ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-push-2 col-lg-10">
                            <div class="article-content">
                                <div class="row">
                                    <div class="col-lg-10">
	                                    <?php if ( has_post_thumbnail() ): ?>
                                            <div class="article-thumbnail-container">
                                                <div class="article-thumbnail"><?php the_post_thumbnail( array(760, null), array( 'class' => 'article-thumbnail-image' ) ); ?></div>
                                                <span class="article-thumbnail-caption"><?php the_post_thumbnail_caption(); ?></span>
                                            </div>
	                                    <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10">
	                                    <?php the_content(); ?>
                                        <div class="article-share">
                                            <ul class="list-unstyled list-inline">
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                                                       target="_blank" class="article-share-link">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/fb.png"
                                                             width="28" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_permalink()); ?>"
                                                       target="_blank" class="article-share-link">
                                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tw.png"
                                                             width="32" alt="">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="related-article">
                <h3>Related Article</h3>
                <div class="">
                    <div class="related-article-item post-list row">
						<?php
						$args = array(
							'posts_per_page' => 3,
							'orderby'        => 'rand',
							'post__not_in'   => array( get_the_ID() )
						);
						$related_query = new WP_Query( $args );
						while ( $related_query->have_posts() ): $related_query->the_post();
							?>
                            <div class="col-lg-4">
                                <div class="article-card">
                                    <a href="<?php the_permalink(); ?>" class="article-image-link">
										<?php if(has_post_thumbnail()): ?>
											<?php the_post_thumbnail('article-thumb', array('class' => 'article-thumb')); ?>
										<?php else: ?>
                                            <img alt="" class="article-thumb img-responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/recentnews-12x.jpg">
										<?php endif; ?>
                                    </a>
                                    <h3 class="article-title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
                                    <p class="article-date"><?php echo get_the_date( 'd F Y' ); ?></p>
                                </div>
                            </div>
						<?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
			<?php
		}
		wp_reset_postdata();
		?>
    </div>
<?php
get_footer();
