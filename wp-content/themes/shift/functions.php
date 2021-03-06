<?php

require_once( trailingslashit( get_template_directory() ) . 'theme-options.php' );
foreach ( glob( trailingslashit( get_template_directory() ) . 'inc/*' ) as $filename ) {
	include $filename;
}

if ( ! function_exists( ( 'ct_shift_set_content_width' ) ) ) {
	function ct_shift_set_content_width() {
		if ( ! isset( $content_width ) ) {
			$content_width = 891;
		}
	}
}
add_action( 'after_setup_theme', 'ct_shift_set_content_width', 0 );

if ( ! function_exists( ( 'ct_shift_theme_setup' ) ) ) {
	function ct_shift_theme_setup() {

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );
		add_theme_support( 'infinite-scroll', array(
			'container' => 'loop-container',
			'footer'    => 'overflow-container',
			'render'    => 'ct_shift_infinite_scroll_render'
		) );
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true
		) );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'shift' )
		) );

		load_theme_textdomain( 'shift', get_template_directory() . '/languages' );
	}
}
add_action( 'after_setup_theme', 'ct_shift_theme_setup', 10 );

if ( ! function_exists( ( 'ct_shift_register_widget_areas' ) ) ) {
	function ct_shift_register_widget_areas() {

		register_sidebar( array(
			'name'          => esc_html__( 'Primary Sidebar', 'shift' ),
			'id'            => 'primary',
			'description'   => esc_html__( 'Widgets in this area will be shown in the sidebar next to the main post content', 'shift' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>'
		) );
	}
}
add_action( 'widgets_init', 'ct_shift_register_widget_areas' );

if ( ! function_exists( ( 'ct_shift_customize_comments' ) ) ) {
	function ct_shift_customize_comments( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-author">
				<?php
				echo get_avatar( get_comment_author_email(), 36, '', get_comment_author() );
				?>
				<span class="author-name"><?php comment_author_link(); ?></span>
			</div>
			<div class="comment-content">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'shift' ) ?></em>
					<br/>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div>
			<div class="comment-footer">
				<span class="comment-date"><?php comment_date(); ?></span>
				<?php comment_reply_link( array_merge( $args, array(
					'reply_text' => esc_html_x( 'Reply', 'noun: reply to this comment', 'shift' ),
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) ); ?>
				<?php edit_comment_link( esc_html_x( 'Edit', 'noun: edit this comment', 'shift' ) ); ?>
			</div>
		</article>
		<?php
	}
}

if ( ! function_exists( 'ct_shift_update_fields' ) ) {
	function ct_shift_update_fields( $fields ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$label     = $req ? '*' : ' ' . __( '(optional)', 'shift' );
		$aria_req  = $req ? "aria-required='true'" : '';

		$fields['author'] =
			'<p class="comment-form-author">
	            <label for="author">' . esc_html_x( "Name", "noun", "shift" ) . $label . '</label>
	            <input id="author" name="author" type="text" placeholder="' . esc_attr__( "Jane Doe", "shift" ) . '" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30" ' . $aria_req . ' />
	        </p>';

		$fields['email'] =
			'<p class="comment-form-email">
	            <label for="email">' . esc_html_x( "Email", "noun", "shift" ) . $label . '</label>
	            <input id="email" name="email" type="email" placeholder="' . esc_attr__( "name@email.com", "shift" ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) .
			'" size="30" ' . $aria_req . ' />
	        </p>';

		$fields['url'] =
			'<p class="comment-form-url">
	            <label for="url">' . esc_html__( "Website", "shift" ) . '</label>
	            <input id="url" name="url" type="url" placeholder="http://google.com" value="' . esc_attr( $commenter['comment_author_url'] ) .
			'" size="30" />
	            </p>';

		return $fields;
	}
}
add_filter( 'comment_form_default_fields', 'ct_shift_update_fields' );

if ( ! function_exists( 'ct_shift_update_comment_field' ) ) {
	function ct_shift_update_comment_field( $comment_field ) {

		$comment_field =
			'<p class="comment-form-comment">
	            <label for="comment">' . _x( "Comment", "noun", "shift" ) . '</label>
	            <textarea required id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	        </p>';

		return $comment_field;
	}
}
add_filter( 'comment_form_field_comment', 'ct_shift_update_comment_field' );

if ( ! function_exists( 'ct_shift_remove_comments_notes_after' ) ) {
	function ct_shift_remove_comments_notes_after( $defaults ) {
		$defaults['comment_notes_after'] = '';
		return $defaults;
	}
}
add_action( 'comment_form_defaults', 'ct_shift_remove_comments_notes_after' );

if ( ! function_exists( 'ct_shift_filter_read_more_link' ) ) {
	function ct_shift_filter_read_more_link() {
		global $post;
		$ismore             = strpos( $post->post_content, '<!--more-->' );
		$read_more_text     = get_theme_mod( 'read_more_text' );
		$new_excerpt_length = get_theme_mod( 'excerpt_length' );
		$excerpt_more       = ( $new_excerpt_length === 0 ) ? '' : '&#8230;';
		$output = '';

		// add ellipsis for automatic excerpts
		if ( empty( $ismore ) ) {
			$output .= $excerpt_more;
		}
		// Because i18n text cannot be stored in a variable
		if ( empty( $read_more_text ) ) {
			$output .= '<div class="more-link-wrapper"><a class="more-link" href="' . esc_url( get_permalink() ) . '">' . __( 'Continue Reading', 'shift' ) . '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span></a></div>';
		} else {
			$output .= '<div class="more-link-wrapper"><a class="more-link" href="' . esc_url( get_permalink() ) . '">' . esc_html( $read_more_text ) . '<span class="screen-reader-text">' . esc_html( get_the_title() ) . '</span></a></div>';
		}
		return $output;
	}
}
add_filter( 'the_content_more_link', 'ct_shift_filter_read_more_link' ); // more tags
add_filter( 'excerpt_more', 'ct_shift_filter_read_more_link', 10 ); // automatic excerpts

// handle manual excerpts
if ( ! function_exists( 'ct_shift_filter_manual_excerpts' ) ) {
	function ct_shift_filter_manual_excerpts( $excerpt ) {
		$excerpt_more = '';
		if ( has_excerpt() ) {
			$excerpt_more = ct_shift_filter_read_more_link();
		}
		return $excerpt . $excerpt_more;
	}
}
add_filter( 'get_the_excerpt', 'ct_shift_filter_manual_excerpts' );

if ( ! function_exists( 'ct_shift_excerpt' ) ) {
	function ct_shift_excerpt() {
		global $post;
		$show_full_post = get_theme_mod( 'full_post' );
		$ismore         = strpos( $post->post_content, '<!--more-->' );

		if ( $show_full_post === 'yes' || $ismore ) {
			the_content();
		} else {
			the_excerpt();
		}
	}
}

if ( ! function_exists( 'ct_shift_custom_excerpt_length' ) ) {
	function ct_shift_custom_excerpt_length( $length ) {

		$new_excerpt_length = get_theme_mod( 'excerpt_length' );

		if ( ! empty( $new_excerpt_length ) && $new_excerpt_length != 25 ) {
			return $new_excerpt_length;
		} elseif ( $new_excerpt_length === 0 ) {
			return 0;
		} else {
			return 25;
		}
	}
}
add_filter( 'excerpt_length', 'ct_shift_custom_excerpt_length', 99 );

if ( ! function_exists( 'ct_shift_remove_more_link_scroll' ) ) {
	function ct_shift_remove_more_link_scroll( $link ) {
		$link = preg_replace( '|#more-[0-9]+|', '', $link );
		return $link;
	}
}
add_filter( 'the_content_more_link', 'ct_shift_remove_more_link_scroll' );

if ( ! function_exists( 'ct_shift_featured_image' ) ) {
	function ct_shift_featured_image() {

		global $post;
		$featured_image = '';

		if ( has_post_thumbnail( $post->ID ) ) {

			if ( is_singular() ) {
				$featured_image = '<div class="featured-image">' . get_the_post_thumbnail( $post->ID, 'full' ) . '</div>';
			} else {
				$featured_image = '<div class="featured-image"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . get_the_post_thumbnail( $post->ID, 'full' ) . '</a></div>';
			}
		}

		$featured_image = apply_filters( 'ct_shift_featured_image', $featured_image );

		if ( $featured_image ) {
			echo $featured_image;
		}
	}
}

if ( ! function_exists( 'ct_shift_social_array' ) ) {
	function ct_shift_social_array() {

		$social_sites = array(
			'twitter'       => 'shift_twitter_profile',
			'facebook'      => 'shift_facebook_profile',
			'google-plus'   => 'shift_googleplus_profile',
			'pinterest'     => 'shift_pinterest_profile',
			'linkedin'      => 'shift_linkedin_profile',
			'youtube'       => 'shift_youtube_profile',
			'vimeo'         => 'shift_vimeo_profile',
			'tumblr'        => 'shift_tumblr_profile',
			'instagram'     => 'shift_instagram_profile',
			'flickr'        => 'shift_flickr_profile',
			'dribbble'      => 'shift_dribbble_profile',
			'rss'           => 'shift_rss_profile',
			'reddit'        => 'shift_reddit_profile',
			'soundcloud'    => 'shift_soundcloud_profile',
			'spotify'       => 'shift_spotify_profile',
			'vine'          => 'shift_vine_profile',
			'yahoo'         => 'shift_yahoo_profile',
			'behance'       => 'shift_behance_profile',
			'codepen'       => 'shift_codepen_profile',
			'delicious'     => 'shift_delicious_profile',
			'stumbleupon'   => 'shift_stumbleupon_profile',
			'deviantart'    => 'shift_deviantart_profile',
			'digg'          => 'shift_digg_profile',
			'github'        => 'shift_github_profile',
			'hacker-news'   => 'shift_hacker-news_profile',
			'amazon'        => 'shift_amazon_profile',
			'google-wallet' => 'shift_google_wallet_profile',
			'yelp'          => 'shift_yelp_profile',
			'steam'         => 'shift_steam_profile',
			'vk'            => 'shift_vk_profile',
			'snapchat'      => 'shift_snapchat_profile',
			'bandcamp'      => 'shift_bandcamp_profile',
			'etsy'          => 'shift_etsy_profile',
			'quora'         => 'shift_quora_profile',
			'ravelry'       => 'shift_ravelry_profile',
			'meetup'        => 'shift_meetup_profile',
			'telegram'      => 'shift_telegram_profile',
			'podcast'       => 'shift_podcast_profile',
			'weibo'         => 'shift_weibo_profile',
			'tencent-weibo' => 'shift_tencent_weibo_profile',
			'500px'         => 'shift_500px_profile',
			'foursquare'    => 'shift_foursquare_profile',
			'slack'         => 'shift_slack_profile',
			'slideshare'    => 'shift_slideshare_profile',
			'qq'            => 'shift_qq_profile',
			'whatsapp'      => 'shift_whatsapp_profile',
			'skype'         => 'shift_skype_profile',
			'wechat'        => 'shift_wechat_profile',
			'xing'          => 'shift_xing_profile',
			'paypal'        => 'shift_paypal_profile',
			'email'         => 'shift_email_profile',
			'email-form'    => 'shift_email_form_profile'
		);

		return apply_filters( 'ct_shift_social_array_filter', $social_sites );
	}
}

if ( ! function_exists( 'ct_shift_social_icons_output' ) ) {
	function ct_shift_social_icons_output() {

		$social_sites = ct_shift_social_array();

		foreach ( $social_sites as $social_site => $profile ) {

			if ( strlen( get_theme_mod( $social_site ) ) > 0 ) {
				$active_sites[ $social_site ] = $social_site;
			}
		}

		if ( ! empty( $active_sites ) ) {

			echo "<ul class='social-media-icons'>";

			foreach ( $active_sites as $key => $active_site ) {

				if ( $active_site == 'email-form' ) {
					$class = 'fa fa-envelope-o';
				} else {
					$class = 'fa fa-' . $active_site;
				}

				echo '<li>';
				if ( $active_site == 'email' ) { ?>
					<a class="email" target="_blank"
					   href="mailto:<?php echo antispambot( is_email( get_theme_mod( $key ) ) ); ?>">
						<i class="fa fa-envelope" title="<?php echo esc_attr_x( 'email', 'noun', 'shift' ); ?>"></i>
						<span class="screen-reader-text"><?php echo esc_html_x('email', 'noun', 'shift'); ?></span>
					</a>
				<?php } elseif ( $active_site == 'skype' ) { ?>
					<a class="<?php echo esc_attr( $active_site ); ?>" target="_blank"
					   href="<?php echo esc_url( get_theme_mod( $key ), array( 'http', 'https', 'skype' ) ); ?>">
						<i class="<?php echo esc_attr( $class ); ?>"
						   title="<?php echo esc_attr( $active_site ); ?>"></i>
						<span class="screen-reader-text"><?php echo esc_html( $active_site );  ?></span>
					</a>
				<?php } else { ?>
					<a class="<?php echo esc_attr( $active_site ); ?>" target="_blank"
					   href="<?php echo esc_url( get_theme_mod( $key ) ); ?>">
						<i class="<?php echo esc_attr( $class ); ?>"
						   title="<?php echo esc_attr( $active_site ); ?>"></i>
						<span class="screen-reader-text"><?php echo esc_html( $active_site );  ?></span>
					</a>
					<?php
				}
				echo '</li>';
			}
			echo "</ul>";
		}
	}
}

/*
 * WP will apply the ".menu-primary-items" class & id to the containing <div> instead of <ul>
 * making styling difficult and confusing. Using this wrapper to add a unique class to make styling easier.
 */
if ( ! function_exists( ( 'ct_shift_wp_page_menu' ) ) ) {
	function ct_shift_wp_page_menu() {
		wp_page_menu( array(
				"menu_class" => "menu-unset",
				"depth"      => - 1
			)
		);
	}
}

if ( ! function_exists( ( 'ct_shift_nav_dropdown_buttons' ) ) ) {
	function ct_shift_nav_dropdown_buttons( $item_output, $item, $depth, $args ) {

		if ( $args->theme_location == 'primary' ) {

			if ( in_array( 'menu-item-has-children', $item->classes ) || in_array( 'page_item_has_children', $item->classes ) ) {
				$item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><button class="toggle-dropdown" aria-expanded="false" name="toggle-dropdown"><span class="screen-reader-text">' . _x( "open menu", "verb: open the menu", "shift" ) . '</span></button>', $item_output );
			}
		}

		return $item_output;
	}
}
add_filter( 'walker_nav_menu_start_el', 'ct_shift_nav_dropdown_buttons', 10, 4 );

if ( ! function_exists( ( 'ct_shift_sticky_post_marker' ) ) ) {
	function ct_shift_sticky_post_marker() {

		if ( is_sticky() && ! is_archive() ) {
			echo '<div class="sticky-status"><span>' . __( "Featured", "shift" ) . '</span></div>';
		}
	}
}
add_action( 'ct_shift_sticky_post_status', 'ct_shift_sticky_post_marker' );

if ( ! function_exists( ( 'ct_shift_reset_customizer_options' ) ) ) {
	function ct_shift_reset_customizer_options() {

		if ( empty( $_POST['shift_reset_customizer'] ) || 'shift_reset_customizer_settings' !== $_POST['shift_reset_customizer'] ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['shift_reset_customizer_nonce'], 'shift_reset_customizer_nonce' ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$mods_array = array(
			'logo_upload',
			'search_bar',
			'full_post',
			'excerpt_length',
			'read_more_text',
			'display_post_author',
			'display_post_date',
			'display_post_comments',
			'custom_css'
		);

		$social_sites = ct_shift_social_array();

		// add social site settings to mods array
		foreach ( $social_sites as $social_site => $value ) {
			$mods_array[] = $social_site;
		}

		$mods_array = apply_filters( 'ct_shift_mods_to_remove', $mods_array );

		foreach ( $mods_array as $theme_mod ) {
			remove_theme_mod( $theme_mod );
		}

		$redirect = admin_url( 'themes.php?page=shift-options' );
		$redirect = add_query_arg( 'shift_status', 'deleted', $redirect );

		// safely redirect
		wp_safe_redirect( $redirect );
		exit;
	}
}
add_action( 'admin_init', 'ct_shift_reset_customizer_options' );

if ( ! function_exists( ( 'ct_shift_delete_settings_notice' ) ) ) {
	function ct_shift_delete_settings_notice() {

		if ( isset( $_GET['shift_status'] ) ) {

			if ( $_GET['shift_status'] == 'deleted' ) {
				?>
				<div class="updated">
					<p><?php _e( 'Customizer settings deleted.', 'shift' ); ?></p>
				</div>
				<?php
			} else if ( $_GET['shift_status'] == 'activated' ) {
				?>
				<div class="updated">
					<p><?php printf( __( '%s successfully activated!', 'shift' ), wp_get_theme( get_template() ) ); ?></p>
				</div>
				<?php
			}
		}
	}
}
add_action( 'admin_notices', 'ct_shift_delete_settings_notice' );

if ( ! function_exists( ( 'ct_shift_body_class' ) ) ) {
	function ct_shift_body_class( $classes ) {

		global $post;
		$full_post = get_theme_mod( 'full_post' );
		$layout    = get_theme_mod( 'layout' );

		if ( $full_post == 'yes' ) {
			$classes[] = 'full-post';
		}
		if ( $layout == 'left' ) {
			$classes[] = 'left-sidebar';
		}

		return $classes;
	}
}
add_filter( 'body_class', 'ct_shift_body_class' );

if ( ! function_exists( ( 'ct_shift_post_class' ) ) ) {
	function ct_shift_post_class( $classes ) {
		$classes[] = 'entry';

		return $classes;
	}
}
add_filter( 'post_class', 'ct_shift_post_class' );

if ( ! function_exists( ( 'ct_shift_custom_css_output' ) ) ) {
	function ct_shift_custom_css_output() {

		if ( function_exists( 'wp_get_custom_css' ) ) {
			$custom_css = wp_get_custom_css();
		} else {
			$custom_css = get_theme_mod( 'custom_css' );
		}

		if ( $custom_css ) {
			$custom_css = ct_shift_sanitize_css( $custom_css );

			wp_add_inline_style( 'ct-shift-style', $custom_css );
			wp_add_inline_style( 'ct-shift-style-rtl', $custom_css );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'ct_shift_custom_css_output', 20 );

if ( ! function_exists( ( 'ct_shift_svg_output' ) ) ) {
	function ct_shift_svg_output( $type ) {

		$svg = '';

		if ( $type == 'toggle-navigation' ) {

			$svg = '<svg width="24px" height="18px" viewBox="0 0 24 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
				        <g transform="translate(-148.000000, -36.000000)" fill="#6B6B6B">
				            <g transform="translate(123.000000, 25.000000)">
				                <g transform="translate(25.000000, 11.000000)">
				                    <rect x="0" y="16" width="24" height="2"></rect>
				                    <rect x="0" y="8" width="24" height="2"></rect>
				                    <rect x="0" y="0" width="24" height="2"></rect>
				                </g>
				            </g>
				        </g>
				    </g>
				</svg>';
		}

		return $svg;
	}
}

if ( ! function_exists( ( 'ct_shift_add_meta_elements' ) ) ) {
	function ct_shift_add_meta_elements() {

		$meta_elements = '';

		$meta_elements .= sprintf( '<meta charset="%s" />' . "\n", esc_html( get_bloginfo( 'charset' ) ) );
		$meta_elements .= '<meta name="viewport" content="width=device-width, initial-scale=1" />' . "\n";

		$theme    = wp_get_theme( get_template() );
		$template = sprintf( '<meta name="template" content="%s %s" />' . "\n", esc_attr( $theme->get( 'Name' ) ), esc_attr( $theme->get( 'Version' ) ) );
		$meta_elements .= $template;

		echo $meta_elements;
	}
}
add_action( 'wp_head', 'ct_shift_add_meta_elements', 1 );

if ( ! function_exists( ( 'ct_shift_infinite_scroll_render' ) ) ) {
	function ct_shift_infinite_scroll_render() {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', 'archive' );
		}
	}
}

if ( ! function_exists( 'ct_shift_get_content_template' ) ) {
	function ct_shift_get_content_template() {

		/* Blog */
		if ( is_home() ) {
			get_template_part( 'content', 'archive' );
		} /* Post */
		elseif ( is_singular( 'post' ) ) {
			get_template_part( 'content' );
		} /* Page */
		elseif ( is_page() ) {
			get_template_part( 'content', 'page' );
		} /* Attachment */
		elseif ( is_attachment() ) {
			get_template_part( 'content', 'attachment' );
		} /* Archive */
		elseif ( is_archive() ) {
			get_template_part( 'content', 'archive' );
		} /* Custom Post Type */
		else {
			get_template_part( 'content' );
		}
	}
}

// allow skype URIs to be used
if ( ! function_exists( ( 'ct_shift_allow_skype_protocol' ) ) ) {
	function ct_shift_allow_skype_protocol( $protocols ) {
		$protocols[] = 'skype';

		return $protocols;
	}
}
add_filter( 'kses_allowed_protocols' , 'ct_shift_allow_skype_protocol' );

// trigger theme switch on link click and send to Appearance menu
function ct_shift_welcome_redirect() {

	$welcome_url = add_query_arg(
		array(
			'page'         => 'shift-options',
			'shift_status' => 'activated'
		),
		admin_url( 'themes.php' )
	);
	wp_safe_redirect( esc_url_raw( $welcome_url ) );
}
add_action( 'after_switch_theme', 'ct_shift_welcome_redirect' );