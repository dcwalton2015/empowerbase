<?php
/**
 * Header logo/text display options alternative
 *
 * @since supermag 1.0.2
 *
 * @param null
 * @return array $supermag_header_id_display_opt
 *
 */
if ( !function_exists('supermag_header_id_display_opt') ) :
    function supermag_header_id_display_opt() {
        $supermag_header_id_display_opt =  array(
            'logo-only' => __( 'Logo Only ( First Select Logo Above )', 'supermag' ),
            'title-only' => __( 'Site Title Only', 'supermag' ),
            'title-and-tagline' =>  __( 'Site Title and Tagline', 'supermag' ),
            'disable' => __( 'Disable', 'supermag' )
        );
        return apply_filters( 'supermag_header_id_display_opt', $supermag_header_id_display_opt );
    }
endif;

/**
 * Global layout options
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return array $supermag_default_layout
 *
 */
if ( !function_exists('supermag_default_layout') ) :
    function supermag_default_layout() {
        $supermag_default_layout =  array(
            'fullwidth' => __( 'Fullwidth', 'supermag' ),
            'boxed' => __( 'Boxed', 'supermag' )
        );
        return apply_filters( 'supermag_default_layout', $supermag_default_layout );
    }
endif;

/**
 * Sidebar layout options
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return array $supermag_sidebar_layout
 *
 */
if ( !function_exists('supermag_sidebar_layout') ) :
    function supermag_sidebar_layout() {
        $supermag_sidebar_layout =  array(
            'right-sidebar'=> __( 'Right Sidebar', 'supermag' ),
            'left-sidebar'=> __( 'Left Sidebar' , 'supermag' ),
            'no-sidebar'=> __( 'No Sidebar', 'supermag' )
        );
        return apply_filters( 'supermag_sidebar_layout', $supermag_sidebar_layout );
    }
endif;


/**
 * Blog layout options
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return array $supermag_blog_layout
 *
 */
if ( !function_exists('supermag_blog_layout') ) :
    function supermag_blog_layout() {
        $supermag_blog_layout =  array(
            'left-image' => __( 'Left Image', 'supermag' ),
            'no-image' => __( 'No Image', 'supermag' )
        );
        return apply_filters( 'supermag_blog_layout', $supermag_blog_layout );
    }
endif;

/**
 * Related post layout
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return array supermag_pagination_options
 *
 */
if ( !function_exists('supermag_pagination_options') ) :
    function supermag_pagination_options() {
        $supermag_pagination_options =  array(
            'default'  => __( 'Default', 'supermag' ),
            'numeric' => __( 'Numeric', 'supermag' ),
        );
        return apply_filters( 'supermag_pagination_options', $supermag_pagination_options );
    }
endif;

/**
 * Related posts layout options
 *
 * @since supermag 1.1.0
 *
 * @param null
 * @return array
 *
 */
if ( !function_exists('supermag_reset_options') ) :
    function supermag_reset_options() {
        $supermag_reset_options =  array(
            '0'  => __( 'Do Not Reset', 'supermag' ),
            'reset-color-options'  => __( 'Reset Colors Options', 'supermag' ),
            'reset-all' => __( 'Reset All', 'supermag' )
        );
        return apply_filters( 'supermag_reset_options', $supermag_reset_options );
    }
endif;

/**
 *  Default Theme layout options
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return array $supermag_theme_layout
 *
 */
if ( !function_exists('supermag_get_default_theme_options') ) :
    function supermag_get_default_theme_options() {

        $default_theme_options = array(
            /*feature section options*/
            'supermag-feature-cat'  => 0,
            'supermag-feature-post-one'  => -1,
            'supermag-feature-post-two'  => -1,
            'supermag-feature-add-one'  => get_template_directory_uri()."/assets/img/supermag-add-1-240-172.png",
            'supermag-feature-add-one-link'  => "http://www.acmethemes.com/",
            'supermag-feature-add-two'  => get_template_directory_uri()."/assets/img/supermag-add-2-240-172.png",
            'supermag-feature-add-two-link'  => "http://www.acmethemes.com/themes/supermag/",
            'supermag-enable-feature'  => 1,

            /*header options*/
            'supermag-header-logo'  => '',
            'supermag-header-id-display-opt' => 'title-and-tagline',
            'supermag-show-date'  => 1,
            'supermag-breaking-news-title'  => __( 'Recent posts', 'supermag' ),
            'supermag-enable-breaking-news'  => 0,
            'supermag-facebook-url'  => '',
            'supermag-twitter-url'  => '',
            'supermag-youtube-url'  => '',
            'supermag-instagram-url'        => '',
            'supermag-google-plus-url'  => '',
            'supermag-pinterest-url'        => '',
            'supermag-enable-social'  => 0,
            'supermag-header-main-banner-ads'  => get_template_directory_uri()."/assets/img/supermag-banner-add.png",
            'supermag-header-main-banner-ads-link'  => 'http://www.acmethemes.com/themes/supermag/',
            'supermag-menu-show-home-icon'  => 1,
            'supermag-menu-show-search'  => 1,

            /*footer options*/
            'supermag-footer-copyright'  => __( 'Copyright &copy; All rights reserved', 'supermag' ),

            /*layout/design options*/
            'supermag-default-layout'  => 'boxed',
            'supermag-sidebar-layout'  => 'right-sidebar',
            'supermag-blog-archive-layout'  => 'left-image',
            'supermag-primary-color'  => '#F88C00',
            'supermag-custom-css'  => '',

            /*single related post options*/
            'supermag-show-related'  => 1,

            /*theme options*/
            'supermag-search-placholder'  => __( 'Search', 'supermag' ),
            'supermag-show-breadcrumb'  => 0,
            'supermag-side-show-message'  => '',
            'supermag-side-image-message'  => '',

            /*Reset*/
            'supermag-reset-options'  => '0',

        );

        return apply_filters( 'supermag_default_theme_options', $default_theme_options );
    }
endif;


/**
 *  Get theme options
 *
 * @since supermag 1.0.0
 *
 * @param null
 * @return array supermag_theme_options
 *
 */
if ( !function_exists('supermag_get_theme_options') ) :
    function supermag_get_theme_options() {

        $supermag_default_theme_options = supermag_get_default_theme_options();
        $supermag_get_theme_options = get_theme_mod( 'supermag_theme_options');
        if( is_array($supermag_get_theme_options )){
            return array_merge( $supermag_default_theme_options ,$supermag_get_theme_options );
        }
        else{
            return $supermag_default_theme_options;
        }

    }
endif;