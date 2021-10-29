<?php
/**
 * Template Name: Stories
 */
$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
get_header(); ?>

<div id="primary" class="content-area-full stories-page <?php echo $has_banner ?>">
	<main id="main" class="site-main fw-left" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			if( get_the_content() ) { ?>
			<section class="text-centered-section">
				<div class="wrapper text-center">
					<div class="intro-text"><?php the_content(); ?></div>
				</div>
			</section>
			<?php } ?>
		<?php endwhile; ?>


		<?php get_template_part('parts/content-stories'); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
