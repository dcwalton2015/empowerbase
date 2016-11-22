<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'supermag-feature-category', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Category Slider Selection', 'supermag' ),
    'panel'          => 'supermag-feature-panel'
) );

/* feature cat selection */
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-cat]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-cat'],
    'sanitize_callback' => 'supermag_sanitize_number'
) );

$wp_customize->add_control(
    new Supermag_Customize_Category_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-cat]',
        array(
            'label'		=> __( 'Select Category For Slider', 'supermag' ),
            'section'   => 'supermag-feature-category',
            'settings'  => 'supermag_theme_options[supermag-feature-cat]',
            'type'	  	=> 'category_dropdown',
            'priority'  => 5,
        )
    )
);
