<?php
/**
 * theLogo Theme Customizer
 */

function thelogo_customize_register($wp_customize)
{
	/**
	 * Add settings for colors
	 */
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default' => '#4CE0D7',
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default' => '#BCBCBC',
			'transport' => 'postMessage',
		)
	);

	// Add controls for colors
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color_control',
			array(
				'label' => __('Primary Color', 'mytheme'),
				'section' => 'colors',
				'settings' => 'primary_color',
			)
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color_control',
			array(
				'label' => __('Secondary Color', 'mytheme'),
				'section' => 'colors',
				'settings' => 'secondary_color',
			)
		)
	);

	/**
	 * Add a new section for the footer settings
	 */
	$wp_customize->add_section(
		'footer_section',
		array(
			'title' => __('Footer Settings', 'thelogo'),
			'priority' => 160,
		)
	);

	// Add setting for the social links block title
	$wp_customize->add_setting(
		'footer_social_links_title',
		array(
			'default' => __('Follow Us', 'thelogo'),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Add control for the social links block title
	$wp_customize->add_control(
		'footer_social_links_title',
		array(
			'label' => __('Social Links Block Title', 'thelogo'),
			'section' => 'footer_section',
			'settings' => 'footer_social_links_title',
			'type' => 'text',
		)
	);

	// Add settings for social media links
	$social_networks = array('facebook', 'twitter', 'instagram', 'linkedin');

	foreach ($social_networks as $network) {
		$wp_customize->add_setting(
			"footer_{$network}_link",
			array(
				'default' => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			"footer_{$network}_link",
			array(
				'label' => __(ucfirst($network) . ' URL', 'thelogo'),
				'section' => 'footer_section',
				'settings' => "footer_{$network}_link",
				'type' => 'url',
			)
		);
	}

	// Add a setting for the copyright text
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default' => __('TheLogo', 'thelogo'),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	// Add a control to edit the copyright text
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'label' => __('Copyright Text', 'thelogo'),
			'section' => 'footer_section',
			'settings' => 'footer_copyright_text',
			'type' => 'textarea',
		)
	);
}
add_action('customize_register', 'thelogo_customize_register');

/**
 * Render the site title for the selective refresh partial.
 */
function thelogo_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function thelogo_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function thelogo_customize_preview_js()
{
	wp_enqueue_script('thelogo-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'thelogo_customize_preview_js');