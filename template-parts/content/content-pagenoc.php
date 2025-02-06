<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div id="site-page">
				<h1 class="page-title"><?php the_title(); ?><br>
					<span class="sub-title"><?php echo get_post_meta(get_the_ID(), 'subtitle', true); ?></span>
				</h1>
			</div>
		</div>
	</div>
</div>
<div id="content" class="page-content">
	<?php the_content(); ?>
</div>