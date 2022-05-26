<?php
/**
 * Template Name: Team 
 */
//$photo_helper = THEMEURI . 'images/square.png';
$photo_helper = THEMEURI . 'images/rectangle-lg.png';
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
					<div class="text" style="margin-bottom:20px"><?php the_content(); ?></div>
					<?php } ?>
				</div>
			</section>

		<?php endwhile; ?>


		<?php if( $teams = get_field("team_details") ) { ?>
		<section class="team-staff-section">
			<div class="wrapper">
				<?php foreach ($teams as $tm) { 
					$photo = $tm['photo'];
					$name = $tm['title'];
					$jobtitle = $tm['jobtitle'];
					$bio = $tm['bio'];
					$hasphoto = ($photo) ? 'hasphoto':'nophoto';
					?>
					<div class="team-info">
						<div class="photo <?php echo $hasphoto ?>">
							<?php if ($photo) { ?>
							<div class="pic" style="background-image:url('<?php echo $photo['url']?>')"><img src="<?php echo $photo_helper ?>" alt="" aria-hidden="true" class="resizer"></div>
							<?php } else { ?>
								<div class="nopic"><img src="<?php echo $photo_helper ?>" alt="" aria-hidden="true" class="resizer"></div>
							<?php } ?>
						</div>

						<div class="bio">

							<?php if ($name || $jobtitle) { ?>
							<div class="titlediv">
								<?php if ($name) { ?>
								<h2 class="name"><?php echo $name ?></h2>	
								<?php } ?>
								<?php if ($jobtitle) { ?>
								<h3 class="job"><?php echo $jobtitle ?></h3>	
								<?php } ?>
							</div>
							<?php } ?>

							<?php if ($bio) { ?>
							<div class="bio-text"><?php echo $bio ?></div>	
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>	
		</section>
		<?php } ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
