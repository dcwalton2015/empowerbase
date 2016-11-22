<?php
/*adding sections for feature side for front page */
$wp_customize->add_section( 'supermag-feature-side', array(
    'priority'       => 20,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Slider Right Section', 'supermag' ),
    'panel'          => 'supermag-feature-panel'
) );

/*slider side post one*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-post-one]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-post-one'],
    'sanitize_callback' => 'supermag_sanitize_page'
) );
$wp_customize->add_control(
    new Supermag_Customize_Post_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-post-one]',
        array(
            'label'		=> __( 'Select Post One', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-post-one]',
            'type'	  	=> 'post_dropdown',
            'priority'  => 55
        )
    )
);

/*slider side post two*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-post-two]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-post-two'],
    'sanitize_callback' => 'supermag_sanitize_page'
) );
$wp_customize->add_control(
    new Supermag_Customize_Post_Dropdown_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-post-two]',
        array(
            'label'		=> __( 'Select Post Two', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-post-two]',
            'type'	  	=> 'post_dropdown',
            'priority'  => 60
        )
    )
);

/*adding hr between post and ad*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-side-show-message]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-side-show-message'],
    'sanitize_callback' => 'esc_attr'
) );
$wp_customize->add_control(
    new Supermag_Customize_Message_Control(
        $wp_customize,
        'supermag_theme_options[supermag-side-show-message]',
        array(
            'section'   => 'supermag-feature-side',
            'description'   => sprintf( __( 'Note : If you select same post for post one and post two in the above selection, then only one post will display %s', 'supermag' ), '<hr />' ),
            'settings'  => 'supermag_theme_options[supermag-side-show-message]',
            'type'	  	=> 'message',
            'priority'  => 74
        )
    )
);

/*slider side ad one*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-one]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-one'],
    'sanitize_callback' => 'supermag_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-add-one]',
        array(
            'label'		=> __( 'Enter Image One', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-add-one]',
            'type'	  	=> 'image',
            'priority'  => 75,
            'description' => __( 'Recommended image size of 240*172', 'supermag' )

        )
    )
);
/*slider side ad one link*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-one-link]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-one-link'],
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-feature-add-one-link]', array(
    'label'		=> __( 'Image One Link', 'supermag' ),
    'section'   => 'supermag-feature-side',
    'settings'  => 'supermag_theme_options[supermag-feature-add-one-link]',
    'type'	  	=> 'text',
    'priority'  => 80
) );

/*slider side ad two*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-two]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-two'],
    'sanitize_callback' => 'supermag_sanitize_image'
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'supermag_theme_options[supermag-feature-add-two]',
        array(
            'label'		=> __( 'Enter Image Two', 'supermag' ),
            'section'   => 'supermag-feature-side',
            'settings'  => 'supermag_theme_options[supermag-feature-add-two]',
            'type'	  	=> 'image',
            'priority'  => 90,
            'description' => __( 'Recommended image size of 240*172', 'supermag' )

        )
    )
);
/*slider side ad two link*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-feature-add-two-link]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-feature-add-two-link'],
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control( 'supermag_theme_options[supermag-feature-add-two-link]', array(
    'label'		=> __( 'Image Two Link', 'supermag' ),
    'section'   => 'supermag-feature-side',
    'settings'  => 'supermag_theme_options[supermag-feature-add-two-link]',
    'type'	  	=> 'text',
    'priority'  => 100
) );

/*adding message for post*/
$wp_customize->add_setting( 'supermag_theme_options[supermag-side-image-message]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['supermag-side-image-message'],
    'sanitize_callback' => 'esc_attr'
) );
$wp_customize->add_control(
    new Supermag_Customize_Message_Control(
        $wp_customize,
        'supermag_theme_options[supermag-side-image-message]',
        array(
            'section'   => 'supermag-feature-side',
            'description' => __( 'Note: if you want to add post here, just add image for post and link, Strongly recommended image size is 240*172', 'supermag' ),
            'settings'  => 'supermag_theme_options[supermag-side-image-message]',
            'type'	  	=> 'message',
            'priority'  => 110
        )
    )
);
