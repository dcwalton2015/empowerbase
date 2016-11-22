<?php
/*adding sections for Single post options*/
$wp_customize->add_section( 'supermag-single-post', array(
    'priority'       => 200,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Single Post Options', 'supermag' )
) );

/*show rlated posts*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-show-related]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-show-related'],
    'sanitize_callback' => 'supermag_sanitize_checkbox'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-show-related]', array(
    'label'		=> __( 'Show Related Posts In Single Post', 'supermag' ),
    'section'   => 'supermag-single-post',
    'settings'  => 'supermag_theme_options[supermag-show-related]',
    'type'	  	=> 'checkbox',
    'priority'  => 3
) );
