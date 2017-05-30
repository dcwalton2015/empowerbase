<?php
/**
 * The template for adding Featured Grid Content Options in Customizer
 *
 * @package Clean Box Catch Themes
 * @subpackage Clean Box
 * @since Clean Box 0.1 
 */

if ( ! defined( 'CLEAN_BOX_THEME_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
	// Featured Grid Content
	if ( 4.3 > get_bloginfo( 'version' ) ) {
		$wp_customize->add_panel( 'clean_box_featured_grid_content', array(
		    'capability'     => 'edit_theme_options',
		    'description'    => __( 'Featured Grid Content Options', 'clean-box' ),
		    'priority'       => 500,
			'title'    		 => __( 'Featured Grid Content', 'clean-box' ),
		) );

		$wp_customize->add_section( 'clean_box_featured_grid_content', array(
			'panel'			=> 'clean_box_featured_grid_content',
			'priority'		=> 1,
			'title'			=> __( 'Featured Grid Content Options', 'clean-box' ),
		) );
	}
	else {
		$wp_customize->add_section( 'clean_box_featured_grid_content', array(
			'priority'		=> 500,
			'title'			=> __( 'Featured Grid Content', 'clean-box' ),
		) );
	}

	$wp_customize->add_setting( 'clean_box_theme_options[featured_grid_content_option]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_grid_content_option'],
		'sanitize_callback'	=> 'clean_box_sanitize_select'
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_grid_content_option]', array(
		'choices'   => clean_box_featured_grid_content_options(),
		'label'    	=> __( 'Enable Grid Content on', 'clean-box' ),
		'priority'	=> '1.1',
		'section'  	=> 'clean_box_featured_grid_content',
		'settings' 	=> 'clean_box_theme_options[featured_grid_content_option]',
		'type'    	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_grid_content_type]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_grid_content_type'],
		'sanitize_callback'	=> 'clean_box_sanitize_select',
	) );
	
	$wp_customize->add_control( 'clean_box_theme_options[featured_grid_content_type]', array(
		'active_callback'	=> 'clean_box_is_grid_content_active',
		'choices'  	=> clean_box_featured_grid_content_types(),
		'label'    	=> __( 'Select Grid Content Type', 'clean-box' ),
		'priority'	=> '2.1.3',
		'section'  	=> 'clean_box_featured_grid_content',
		'settings' 	=> 'clean_box_theme_options[featured_grid_content_type]',
		'type'	  	=> 'select',
	) );

	$wp_customize->add_setting( 'clean_box_theme_options[featured_grid_content_number]', array(
		'capability'		=> 'edit_theme_options',
		'default'			=> $defaults['featured_grid_content_number'],
		'sanitize_callback'	=> 'clean_box_sanitize_number_range',
	) );

	$wp_customize->add_control( 'clean_box_theme_options[featured_grid_content_number]' , array(
		'active_callback'	=> 'clean_box_is_demo_grid_content_inactive',
		'description'	=> __( 'Save and refresh the page if No. of Grid Content is changed (Max no of grid content is 30). No. of Grid Content in set as a multiple of 3', 'clean-box' ),
		'input_attrs' 	=> array(
            'style' => 'width: 45px;',
            'min'   => 3,
            'max'   => 30,
            'step'  => 3,
        	),
		'label'    		=> __( 'No of Grid Content', 'clean-box' ),
		'priority'		=> '2.1.4',
		'section'  		=> 'clean_box_featured_grid_content',
		'settings' 		=> 'clean_box_theme_options[featured_grid_content_number]',
		'type'	   		=> 'number',
		)
	);

	//loop for featured post grid contents
	for ( $i=1; $i <=  $options['featured_grid_content_number'] ; $i++ ) {
		$wp_customize->add_setting( 'clean_box_theme_options[featured_grid_content_page_'. $i .']', array(
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'clean_box_sanitize_page',
		) );

		$wp_customize->add_control( 'clean_box_theme_options[featured_grid_content_page_'. $i .']', array(
			'active_callback'	=> 'clean_box_is_demo_grid_content_inactive',
			'label'    	=> __( 'Featured Page', 'clean-box' ) . ' # ' . $i ,
			'priority'	=> '4' . $i,
			'section'  	=> 'clean_box_featured_grid_content',
			'settings' 	=> 'clean_box_theme_options[featured_grid_content_page_'. $i .']',
			'type'	   	=> 'dropdown-pages',
		) );
	}
// Featured Grid Content End