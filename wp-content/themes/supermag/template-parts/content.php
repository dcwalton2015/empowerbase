<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AcmeThemes
 * @subpackage Supermag
 */
global $supermag_customizer_all_values;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php supermag_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	if ( $supermag_customizer_all_values['supermag-blog-archive-layout'] == 'left-image') {
		?>
		<!--post thumbnal options-->
		<div class="post-thumb">
			<?php
			if( has_post_thumbnail() ):
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail' );
			else:
				$image_url[0] = get_template_directory_uri().'/assets/img/no-image-500-280.png';
			endif;
			?>
			<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
		</div><!-- .post-thumb-->
	<?php
	}
	?>

	<div class="entry-content">
		<?php
		the_excerpt();
		?>
		<a class="read-more" href="<?php the_permalink(); ?> "><?php _e('Read More', 'supermag'); ?></a>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'supermag' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php supermag_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
