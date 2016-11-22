<?php
/**
 * feature sider side posts and ads
 *
 * @since supermag 1.1.0
 *
 * @param null
 * @return void
 *
 */
if ( !function_exists('supermag_feature_side') ) :

    function supermag_feature_side() {

        global $supermag_customizer_all_values;
        echo '<div class="besides-slider">';
        echo '<div class="besides-slider-left">';
        /*Featured Post Beside Slider*/
        $supermag_beside_slider_ids = array();
        $supermag_beside_adds = array();
        if( -1 != $supermag_customizer_all_values['supermag-feature-post-one'] ){
            $supermag_beside_slider_ids[] = $supermag_customizer_all_values['supermag-feature-post-one'];
        }
        if( -1 != $supermag_customizer_all_values['supermag-feature-post-two'] ){
            $supermag_beside_slider_ids[] = $supermag_customizer_all_values['supermag-feature-post-two'];
        }
        if( !empty( $supermag_customizer_all_values['supermag-feature-add-one'] ) ){
            $supermag_beside_adds[0]['supermag-feature-add'] = $supermag_customizer_all_values['supermag-feature-add-one'];
            $supermag_beside_adds[0]['supermag-feature-add-link'] = $supermag_customizer_all_values['supermag-feature-add-one-link'];
        }
        if( !empty($supermag_customizer_all_values['supermag-feature-add-two'] ) ){
            $supermag_beside_adds[1]['supermag-feature-add'] = $supermag_customizer_all_values['supermag-feature-add-two'];
            $supermag_beside_adds[1]['supermag-feature-add-link'] = $supermag_customizer_all_values['supermag-feature-add-two-link'];
        }
        $supermag_float_fixed = 1;
        if( !empty($supermag_beside_slider_ids) ){
            $beside_post_args = array(
                'post_type' => 'post',
                'posts_per_page' => 2,
                'post__in' => $supermag_beside_slider_ids,
                'orderby' => 'post__in',
                'ignore_sticky_posts' => true
            );
            $beside_query = new WP_Query($beside_post_args);
            if ($beside_query->have_posts()) {
                while ($beside_query->have_posts()) {
                    $beside_query->the_post();
                    if (has_post_thumbnail()) {
                        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
                    }
                    else {
                        $image_url[0] = get_template_directory_uri() . '/assets/img/no-image-240-172.png';
                    }
                    ?>
                    <div class="beside-post clearfix">
                        <a href="<?php the_permalink(); ?>">
                            <figure class="beside-thumb clearfix">
                                <img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php echo esc_attr( the_title_attribute() ); ?>" title="<?php echo esc_attr( the_title_attribute() ); ?>" />
                                <div class="overlay"></div>
                            </figure>
                        </a>
                        <div class="beside-caption clearfix">
                            <h3 class="post-title"><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>
                            <div class="post-date">
                                <?php
                                $archive_year  = get_the_date('Y');
                                $archive_month = get_the_date('m');
                                $archive_day   = get_the_date('d');
                                ?>
                                <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
                                    <i class="fa fa-calendar"></i>
                                    <?php echo esc_attr( get_the_date('F d, Y') ); ?>
                                </a>
                                <?php comments_popup_link( '<i class="fa fa-comment"></i> 0', '<i class="fa fa-comment"></i> 1', '<i class="fa fa-comment"></i> %' );?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if( 2 == $supermag_float_fixed ){
                        echo "</div>";
                        echo '<div class="besides-slider-right">';
                    }
                    $supermag_float_fixed++;
                }
                ?>

                <?php
            }
            wp_reset_postdata();
        }
        else{
            ?>
            <div class="beside-post clearfix">
                <figure class="beside-thumb clearfix">
                    <img src="<?php echo esc_url( get_template_directory_uri()."/assets/img/no-image-240-172.png" ); ?>"/>
                </figure>
                <div class="beside-caption clearfix" style="color: #2D2D2D">
                    <h3 class="post-title" style="color: #2D2D2D">
                        <?php _e('Select post', 'supermag' );?>
                    </h3>
                    <div class="post-date">
                        <?php _e(' Goto Appearance > Customize > Featured Section Options', 'supermag' );?>
                    </div>
                </div>
            </div>
            <div class="beside-post clearfix">
                <figure class="beside-thumb clearfix">
                    <img src="<?php echo esc_url( get_template_directory_uri()."/assets/img/no-image-240-172.png" ); ?>"/>
                </figure>
                <div class="beside-caption clearfix" style="color: #2D2D2D">
                    <h3 class="post-title">
                        <?php _e('Select another post', 'supermag' );?>
                    </h3>
                    <div class="post-date">
                        <?php _e(' Goto Appearance > Customize > Featured Section Options', 'supermag' );?>
                    </div>
                </div>
            </div>
            <?php
            echo "</div>";
            echo '<div class="besides-slider-right">';
        }
        if(!empty($supermag_beside_adds)){
            foreach ( $supermag_beside_adds as $supermag_beside_add_id){
                ?>
                <div class="beside-post clearfix">
                    <figure class="beside-thumb clearfix">
                        <a href="<?php echo esc_url( $supermag_beside_add_id['supermag-feature-add-link']); ?>" target="_blank">
                           <img src="<?php echo esc_url( $supermag_beside_add_id['supermag-feature-add']); ?>">
                        </a>
                    </figure>
                </div>
                <?php
                if( 2 == $supermag_float_fixed ){
                    echo "</div>";
                    echo '<div class="besides-slider-right">';
                }
                $supermag_float_fixed++;
            }
        }
        echo '</div><!-- .beides-slider-right -->';
        echo '</div><!-- .beides-block -->';

    }
endif;
add_action( 'supermag_action_feature_side', 'supermag_feature_side', 0 );