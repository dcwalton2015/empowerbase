<?php
/*adding sections for header news options*/
$wp_customize->add_section( 'supermag-header-news', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Breaking News Options', 'supermag' ),
    'panel'          => 'supermag-header-panel'
) );

/*header news title*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-breaking-news-title]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-breaking-news-title'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-breaking-news-title]', array(
    'label'		=> __( 'Breaking News Title', 'supermag' ),
    'section'   => 'supermag-header-news',
    'settings'  => 'supermag_theme_options[supermag-breaking-news-title]',
    'type'	  	=> 'text',
    'priority'  => 10
) );

/*header news enable*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-enable-breaking-news]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-enable-breaking-news'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-enable-breaking-news]', array(
    'label'		=> __( 'Enable Breaking News', 'supermag' ),
    'section'   => 'supermag-header-news',
    'settings'  => 'supermag_theme_options[supermag-enable-breaking-news]',
    'type'	  	=> 'checkbox',
    'priority'  => 10
) );
