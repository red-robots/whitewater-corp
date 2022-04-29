<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2><?php the_title(  ); ?></h2>

		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
		<div class="clear"></div>
		<div class="button">
			<a href="<?php the_permalink(); ?>" class="btn-sm"  target="<?php echo $target; ?>">
				<span><?php if( $btnLabel ) { echo $btnLabel; } else { echo 'See Details'; }?></span>
			</a>
		</div>
	</div><!-- .entry-summary -->

	<!-- <footer class="entry-footer">
		<?php bellaworks_entry_footer(); ?>
	</footer>.entry-footer -->
</article><!-- #post-## -->
