<?php
/*adding sections for header options panel*/
$wp_customize->add_section( 'supermag-header-menu', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Menu Options', 'supermag' ),
    'panel'          => 'supermag-header-panel'
) );

/*header show home icon*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-menu-show-home-icon]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-menu-show-home-icon'],
    'sanitize_callback' => 'supermag_sanitize_checkbox',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-menu-show-home-icon]', array(
    'label'		=> __( 'Show Home Icon On Menu', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-menu-show-home-icon]',
    'type'	  	=> 'checkbox',
    'priority'  => 40
) );


/*header show search*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-menu-show-search]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-menu-show-search'],
    'sanitize_callback' => 'supermag_sanitize_checkbox',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-menu-show-search]', array(
    'label'		=> __( 'Show Search On Menu', 'supermag' ),
    'section'   => 'supermag-header-menu',
    'settings'  => 'supermag_theme_options[supermag-menu-show-search]',
    'type'	  	=> 'checkbox',
    'priority'  => 45
) );