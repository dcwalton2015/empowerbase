<?php
/*adding sections for header ad */
$wp_customize->add_section( 'supermag-header-ad-option', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Header Advertisement', 'supermag' ),
    'panel'          => 'supermag-header-panel'
) );

/*header ad img*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-main-banner-ads]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-main-banner-ads'],
    'sanitize_callback' => 'supermag_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'supermag_theme_options[supermag-header-main-banner-ads]',
        array(
            'label'		=> __( 'Header Ad Image', 'supermag' ),
            'section'   => 'supermag-header-ad-option',
            'settings'  => 'supermag_theme_options[supermag-header-main-banner-ads]',
            'type'	  	=> 'image',
            'priority'  => 10,
            'description' => __( 'Recommended image size of 728*90', 'supermag' )

        )
    )
);

/*header ad img link*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-header-main-banner-ads-link]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-header-main-banner-ads-link'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-header-main-banner-ads-link]', array(
    'label'		=> __( 'Header Ad Image Link', 'supermag' ),
    'section'   => 'supermag-header-ad-option',
    'settings'  => 'supermag_theme_options[supermag-header-main-banner-ads-link]',
    'type'	  	=> 'url',
    'priority'  => 20
) );
