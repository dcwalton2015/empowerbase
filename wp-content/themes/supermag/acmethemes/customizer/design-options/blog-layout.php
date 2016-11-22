<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'supermag-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog/Archive Layout', 'supermag' ),
    'panel'          => 'supermag-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-blog-archive-layout'],
    'sanitize_callback' => 'supermag_sanitize_select'
) );
$choices = supermag_blog_layout();
$wp_customize->add_control( 'supermag_theme_options[supermag-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog/Archive Layout', 'supermag' ),
    'description'=> __( 'Image display options', 'supermag' ),
    'section'   => 'supermag-design-blog-layout-option',
    'settings'  => 'supermag_theme_options[supermag-blog-archive-layout]',
    'type'	  	=> 'select'
) );