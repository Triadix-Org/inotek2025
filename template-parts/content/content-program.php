<div id="parent-<?php the_ID(); ?>" class="page-program-item row">
	<div class="col-lg-3">
		<?php the_post_thumbnail(array(156, false), array('class' => 'img-responsive program-thumb', 'title' => 'Feature image')); ?>
	</div>
	<div class="col-lg-9">
		<h3 class="heading-3"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
		<?php the_content(); ?>
	</div>
</div>