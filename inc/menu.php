<?php

function inotek_register_menu() {
	register_nav_menus(
		array(
			'main-menu'      => __( 'Main Menu' ),
			'language-menu'  => __( 'Language' ),
			'footer-menu-01' => __( 'Footer Menu Column 1' ),
			'footer-menu-02' => __( 'Footer Menu Column 2' ),
			'footer-menu-03' => __( 'Footer Menu Column 3' )
		)
	);
}

function inotek_polylang_switcher() {
	if(function_exists('pll_the_languages')) {
		$translations = pll_the_languages( array( 'raw' => 1) );
		if($translations && count($translations) > 0) {
			foreach($translations as $translation) {

			}
		}
	}

	return null;
}

function inotek_wpml_switcher() {
	$language = array();

	if ( function_exists( 'icl_get_languages' ) ) {
		$translations = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
		if($translations) {
			foreach ($translations as $key => $translation) {
				$language['options'][$key] = $translation;
				if($translation['active'] == 1) {
					$language['current'] = $translation;
				}
			}
		}
	}

	return $language;
}