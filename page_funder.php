<?php /* Template Name: Funder Page */ ?>
<?php get_header('funding'); ?>
    <div id="funders-header">
        <div class="container funder-container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="microsite-title">
                        <span class="microsite-small-title">Welcome</span>
                        Funders
                    </h1>
                </div>
                <div class="col-lg-6">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/illustration/potential-graphics-1.png" class="microsite-ornament" alt="" width="140.5">
                </div>
            </div>
        </div>
        <div class="funders-bar-block clearfix">
            <div class="funders-bar-light"></div>
        </div>

    </div>
    <div class="container microsite-content">
	    <?php
	    while ( have_posts() ) :
		    the_post();
		    get_template_part( 'template-parts/content/content', 'simple' );
	    endwhile; // End of the loop.
	    ?>
    </div>
<?php get_footer('funding');
