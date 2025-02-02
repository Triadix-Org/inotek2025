<?php
echo get_template_part('template-parts/modal', 'search');
?>
</main>
<div id="main-footer" class="bg-gradient-primary">
	<footer>
		<div class="container">
			<div class="footer-menu-container">
				<div class="col-lg-3 col-sm-3">
					<img alt="Inotek Icon" class="inotek-icon"
						src="<?php echo get_template_directory_uri() ?>/assets/images/logo-only.png" width="48">
				</div>
				<div class="col-lg-3 col-sm-3">
					<?php
					$main_nav_args = array(
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'list-unstyled footer-menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => false,
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'item_spacing'    => 'preserve',
						'depth'           => 0,
						'walker'          => '',
						'theme_location'  => 'footer-menu-01',
					);
					wp_nav_menu($main_nav_args);
					?>
				</div>
				<div class="col-lg-3 col-sm-3">
					<?php
					$main_nav_args = array(
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'list-unstyled footer-menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => false,
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'item_spacing'    => 'preserve',
						'depth'           => 0,
						'walker'          => '',
						'theme_location'  => 'footer-menu-02',
					);
					wp_nav_menu($main_nav_args);
					?>
				</div>
				<div class="col-lg-3 col-sm-3">
					<?php
					$main_nav_args = array(
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'list-unstyled footer-menu',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => false,
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'item_spacing'    => 'preserve',
						'depth'           => 0,
						'walker'          => '',
						'theme_location'  => 'footer-menu-03',
					);
					wp_nav_menu($main_nav_args);
					?>
				</div>
			</div>
			<div class="row">
				<div class="copyright col-lg-6 col-sm-12" style="color: #fff;">
					&copy; 2020 INOTEK Foundation. All Rights Reserved.
				</div>
				<div id="back-to-top" class="col-lg-6 col-sm-12">
					<a href="#" style="color: #fff;">Back to Top</a>
				</div>
			</div>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>