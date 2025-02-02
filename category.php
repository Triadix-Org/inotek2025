<?php
get_header( 'special' );
?>
    <div class="bg-washed-blue">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="site-page">
                        <h1 class="page-title"><?php single_cat_title(); ?><br>
                            <span class="sub-title"><?php ?></span>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container archive-container">
		<?php
        $counter = 0;

		while ( have_posts() ) :
			the_post();
			if ( ( $counter % 3 ) == 0 ):
				echo '<div class="row">';
			endif;
			get_template_part( 'template-parts/content/content', 'category' );
			if ( $counter % 3 == 2 ):
				echo '</div>';
			endif;
			$counter++;
		endwhile;
		?>
        <div class="row">
            <div class="col-lg-6 nav-previous text-left"><?php previous_posts_link( 'Newer posts' ); ?></div>
            <div class="col-lg-6 nav-next text-right"><?php next_posts_link( 'Older posts' ); ?></div>
        </div>
    </div>

<?php
get_footer();
