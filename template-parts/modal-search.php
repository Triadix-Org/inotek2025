<div class="search-container">
	<div class="search-block">
		<form action="/search" class="search w-form">
			<input type="search" class="search-input w-input" maxlength="256" name="query" placeholder="Search…"
			       id="search" required="">
			<input type="submit" value=" " class="search-button w-button">
		</form>
		<a href="#" class="search-close w-inline-block">
			<img src="<?php echo get_template_directory_uri() ?>assets/images/close.png" alt="" class="close-icon">
		</a>
	</div>
	<div class="search-background"></div>
</div>