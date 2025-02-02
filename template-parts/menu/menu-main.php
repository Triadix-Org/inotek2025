<?php $language = inotek_wpml_switcher(); ?>
<div id="language-menu">
	<ul>
		<li>
			<a href="#" class="current-language">
				<img src="<?php echo $language['current']['country_flag_url']; ?>" alt="<?php echo $language['current']['native_name']; ?>">
				<span><?php echo $language['current']['code']; ?></span>
			</a>
			<ul class="sub-menu">
				<?php foreach($language['options'] as $language_option): ?>
					<li>
						<a href="<?php echo $language_option['url']; ?>">
							<img src="<?php echo $language_option['country_flag_url']; ?>" alt="<?php echo $language_option['native_name']; ?>">
							<span><?php echo $language_option['code']; ?></span>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</li>
	</ul>
</div>