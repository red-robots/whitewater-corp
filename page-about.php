<?php
/**
 * Template Name: About Us
 */
$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
$timeline_data = get_field("timeline_data");
?>
<style type="text/css">
<?php
$n=1; foreach ($timeline_data as $k=>$d) { 
$move = ( isset($d['moveup']) && $d['moveup'] ) ? $d['moveup'] : '';
if ($move) { ?>
  @media screen and (min-width:820px) { #history-info-<?php echo $n ?>{transform: translateY(<?php echo $move ?>%)!important; } }
<?php }
$n++; } ?>
</style>
<?php get_header(); ?>

<div id="primary" class="content-area-full about-page <?php echo $has_banner ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( get_the_content() ) { ?>
			<section class="text-centered-section">
					<div class="wrapper text-center">
						<?php the_content(); ?>
					</div>
			</section>
			<?php } ?>

			<!-- TIMELINE -->
			<?php  
			$year_now = date('Y');
			$year_prev = $year_now - 1;
			$timeline_title = get_field("timeline_title");
			$timeline_img_bg = get_field("timeline_img_bg");
			$timeline_bg = ($timeline_img_bg) ? ' style="background-image:url('.$timeline_img_bg['url'].')"':'';
			if($timeline_title || $timeline_data) { ?>
			<div id="timeline-area" class="timeline-wrapper">
				<?php if ($timeline_title) { ?>
				<div class="timeline-large-title">
					<div class="wrapper">
						<h2 class="col-title"><?php echo $timeline_title ?></h2>
					</div>
					<?php if ($timeline_img_bg) { ?>
					<div class="imagebg"<?php echo $timeline_bg ?>></div>
					<?php } ?>
				</div>
				<?php } ?>

				<?php 
				
				if ($timeline_data) { ?>
				<div class="timeline">
					<div class="wrapper">
						<div class="timeline-inner">
							<?php  
							$count_timeline = count($timeline_data);
							$n=1; foreach ($timeline_data as $k=>$d) { 
								$year = $d['year']; 
								$description = $d['description']; 
								$image = $d['image']; 
								$selected = ($n==1) ? ' selected':'';
								$interval = $year_prev + $k;
								$has_text_image = ($description && $image) ? 'half':'full';
								$class = ($n==1) ? ' first':'';
                				$class .= ($image) ? ' hasimage':' noimage';
								$class .= ($n==$count_timeline) ? ' last':'';
                				$class .= ($n % 2) ? ' odd':' even';
							  ?>
								<div id="history-info-<?php echo $n ?>" class="history<?php echo $class ?>">
									<div class="h-title"><?php echo $year ?></div>
									<?php if ($description || $image) { ?>
									<div class="h-text <?php echo $has_text_image ?>">
										<?php if ($description) { ?>
											<div class="text"><?php echo $description ?></div>
										<?php } ?>
										<?php if ($image) { ?>
										<div class="photo">
											<a data-fancybox href="<?php echo $image['url'] ?>"  class="pic" style="background-image:url('<?php echo $image['url'] ?>')">
												<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="actual-image">
												<img src="<?php echo get_images_dir('square.png') ?>" alt="" aria-hidden="true" class="helper">
											</a>
										</div>
										<?php } ?>
									</div>
									<?php } ?>
								</div>
							<?php $n++; } ?>
							<div class="middle-line"></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
			<?php } ?>



			<?php  
			$mission = get_field("mission_text");
			$video = get_field("video_embed");
			$section_class = ($mission && $video) ? 'half':'full';
			?>
			<?php if ($mission || $video) { ?>
			<section class="section-text-and-image <?php echo $section_class ?>">
				<div class="flexwrap">
					<?php if ($mission) { ?>
					<div class="leftcol">
						<div class="wrap">
							<div class="inner"><?php echo $mission; ?></div>
						</div>
					</div>	
					<?php } ?>

					<?php if ($video) { ?>
					<div class="rightcol videoCol">
						<div class="inside">
							<div class="iframe-wrap"><?php echo $video; ?></div>
							<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="placeholder">
						</div>
					</div>	
					<?php } ?>
				</div>
			</section>	
			<?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
