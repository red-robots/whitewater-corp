<?php
/**
 * Template Name: Team Development
 */
$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
get_header(); ?>
<div id="primary" class="content-area-full outfitters <?php echo $has_banner ?>">
	<main id="main" class="site-main fw-left" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

		
			<section class="text-centered-section">
				<div class="wrapper text-center">
					<div class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<?php if ( get_the_content() ) { ?>
					<div class="text"><?php the_content(); ?></div>
					<?php } ?>
				</div>
			</section>

			<?php get_template_part("parts/subpage-tabs"); ?>

			<?php
			$hours_title = get_field("hours_title");
			$hours = get_field("hours");
			$store_image = get_field("store_image");
			$map_image = get_field("map_image");
			$mapClass = ( ($hours||$store_image) &&  $map_image ) ? 'half':'full';
			if( $hours||$store_image||$map_image ) { ?>
			<section id="section-event-details" class="section-content store-hours-info <?php echo $mapClass ?>">
				<div class="colwrapper">

					<?php if ($hours || $store_image) { ?>
					<div class="infocol first hours-location">
						<?php if ($hours) { ?>
						<div class="block text-center b1">
							<div class="inside">
								<?php if ($hours_title) { ?>
								<h2 class="stitle"><?php echo $hours_title ?></h2>
								<?php } ?>
								<div class="hoursCol"><?php echo $hours ?></div>
							</div>
						</div>	
						<?php } ?>

						<?php if ($store_image) { ?>
						<div class="block b2">
							<div class="inside">
								<span class="image" style="background-image:url('<?php echo $store_image['url'] ?>')"></span>
								<img src="<?php echo $store_image['url'] ?>" alt="<?php echo $store_image['title'] ?>" class="mapImg" />
							</div>
						</div>	
						<?php } ?>
					</div>
					<?php } ?>


					<?php if ($map_image) { ?>
					<div class="infocol second mapcol">
						<img src="<?php echo $map_image['url'] ?>" alt="<?php echo $map_image['title'] ?>" class="map-image" />
					</div>
					<?php } ?>

				</div>
			</section>
			<?php } ?>

		<?php endwhile; ?>

		<?php get_template_part("parts/post-type-teamdev"); ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php include( locate_template('inc/pagetabs-script.php') );  ?>
<?php
get_footer();
