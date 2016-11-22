<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AcmeThemes
 * @subpackage Supermag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php supermag_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<!--post thumbnal options-->
	<div class="single-feat clearfix">
		<figure class="single-thumb single-thumb-full">
			<?php
			$sidebar_layout = supermag_sidebar_selection();
			if( $sidebar_layout == "no-sidebar"){
				$thumbnail = 'large';
				$no_image = get_template_directory_uri().'/assets/img/no-image-840-480.png';
			}
			else{
				$thumbnail = 'medium';
				$no_image = get_template_directory_uri().'/assets/img/no-image-660-365.png';

			}
			if( has_post_thumbnail() ):
				the_post_thumbnail( $thumbnail );
			else:
				$img_url[0] = $no_image;
				?>
				<img src="<?php echo esc_url( $img_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" />
				<?php
			endif;
			?>
		</figure>
	</div><!-- .single-feat-->

	<div class="entry-content">
		<?php the_content(); ?>
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

