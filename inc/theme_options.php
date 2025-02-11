<?php

/**
 * @param $wp_customize WP_Customize_Manager
 */
function inotek_options_funding($wp_customize)
{
	$wp_customize->add_section('inotek_section', array(
		'title'              => __('Inotek 2020 settings'),
		'description'        => esc_html__('Inotek website settings'),
		'panel'              => '', // Only needed if adding your Section to a Panel
		'priority'           => 160, // Not typically needed. Default is 160
		'capability'         => 'edit_theme_options', // Not typically needed. Default is edit_theme_options
		'theme_supports'     => '', // Rarely needed
		'active_callback'    => '', // Rarely needed
		'description_hidden' => 'false', // Rarely needed. Default is False
	));

	$wp_customize->add_setting(
		'inotek_funder_link',
		array(
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'inotek_funder_link',
		array(
			'label'       => __('Inotek funder url'),
			'description' => esc_html__('Inotek funder url'),
			'section'     => 'inotek_section',
			'priority'    => 10, // Optional. Order priority to load the control. Default: 10
			'type'        => 'dropdown-pages', // Can be either text, email, url, number, hidden, or date
			'capability'  => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
			'input_attrs' => array( // Optional.
				'class'       => 'my-custom-class',
				'placeholder' => __('Enter URL...'),
			),
		)
	);

	$wp_customize->add_setting(
		'inotek_partner_link',
		array(
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'inotek_partner_link',
		array(
			'label'       => __('Inotek partner url'),
			'description' => esc_html__('Inotek partner url'),
			'section'     => 'inotek_section',
			'priority'    => 11, // Optional. Order priority to load the control. Default: 10
			'type'        => 'dropdown-pages', // Can be either text, email, url, number, hidden, or date
			'capability'  => 'edit_theme_options', // Optional. Default: 'edit_theme_options'
			'input_attrs' => array( // Optional.
				'class'       => 'my-custom-class',
				'placeholder' => __('Enter URL...'),
			),
		)
	);
}
