<?php /* Template Name: Front Page */ ?>
<?php get_header(); ?>
<?php

/* Start the Loop */
while ( have_posts() ) :
	the_post();
	get_template_part( 'template-parts/content/content', 'home' );
endwhile; // End of the loop.
?>
<?php get_footer(); ?>
