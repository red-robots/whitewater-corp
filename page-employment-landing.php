<?php
/**
 * Template Name: Employment Portal
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
get_header(); 

if( is_page('waiver') ) {
	$pageClass = 'waiver';
} else {
	$pageClass = '';
}
?>

<div id="primary" class="content-area-full content-default page-default-template <?php echo $has_banner ?>">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<section class="text-centered-section">
				<div class="wrapper text-center">
					<div class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<div class="<?php echo $pageClass; ?>">
						<?php the_content(); ?>
					</div>
					<?php if( have_rows('icons') ) : ?>
						<div class="cf-forms">
							<?php while( have_rows('icons') ) : the_row();
							$title = get_sub_field('title', 'option');
							$icon = get_sub_field('icon', 'option');
							$link = get_sub_field('link', 'option');
							// $pdf = get_sub_field('pdf', 'option');
							// $fOrLink = get_sub_field('form_or_link', 'option');
							
							// if( $fOrLink == 'link' ) {
							// 	$nLink = $link;
							// } else {
							// 	$nLink = $pdf;
							// }
							// echo '<pre>';
							// print_r($title);
							// echo '</pre>';
							 

					?>

						
							<div class="cf-form">
								<a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>">
									<?php if( $icon ) { ?>
										<div class="cf-icon">
											<img src="<?php echo $icon['url']; ?>">
										</div>
									<?php } ?>
									<?php if( $title ) { ?>
										<h3 class="cf-title">
											<?php echo $title; ?>
										</h3>
									<?php } ?>
								</a>
							</div>
						


					<?php endwhile; ?>
					</div>
					<?php 
					endif; // end repeater loop ?>
				</div>
			</section>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
