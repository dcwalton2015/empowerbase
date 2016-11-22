<?php
/**
 * Front page hook for all WordPress Conditions
 *
 * @since supermag 1.1.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_front_page' ) ) :

    function supermag_front_page() {

        if ( 'posts' == get_option( 'show_on_front' ) ) {
            include( get_home_template() );
        }
        elseif( is_active_sidebar( 'supermag-home' ) ){
            ?>
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <?php
                    dynamic_sidebar( 'supermag-home' );
                    ?>
                </main>
                <!-- #main -->
            </div><!-- #primary -->
            <?php
        }
        else {
            include( get_page_template() );
        }

    }
endif;
add_action( 'supermag_action_front_page', 'supermag_front_page', 10 );