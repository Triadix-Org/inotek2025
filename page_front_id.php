<?php /* Template Name: Page Front Id */ ?>
<?php get_header(); ?>
<?php

/* Start the Loop */
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/content', 'frontpageid');

endwhile; // End of the loop.
?>
<?php get_footer();
