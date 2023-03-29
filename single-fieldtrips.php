<?php
get_header(); 
$rectangle = THEMEURI . "images/rectangle.png";
$square = THEMEURI . "images/square.png";
$banner = get_field("fieldtrip_featured_image");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
get_template_part("parts/subpage-banner");
?>

<div id="primary" class="content-area-full content-default page-default-template single-fieldtrips <?php echo $has_banner ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			<section class="text-centered-section">
				<div class="wrapper text-center">
					<div class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<?php the_content(); ?>
				</div>
			</section>

			<?php get_template_part("parts/subpage-tabs"); ?>

			<?php
			$opt = get_field("fieldtrip_options");
			$educational_programs = ( isset($opt['educational_programs']) ) ? $opt['educational_programs'] : '';
			$pass_activities = ( isset($opt['pass_activities']) ) ? $opt['pass_activities'] : '';
			$grades = ( isset($opt['grades']) ) ? $opt['grades'] : '';
			$activity_options = ( isset($opt['activity_options']) ) ? $opt['activity_options'] : '';
			$price = ( isset($opt['price']) ) ? $opt['price'] : '';
			$opt = FALSE;
			if($opt) { ?>
			<section class="section-price-ages full">
				<div class="flexwrap">

					<div class="info">
						<div class="wrap">
							<div class="inner">
								<div class="label">Grades</div>
								<div class="val"><?php echo $grades ?></div>
							</div>
						</div>
					</div>	

					<div class="info">
						<div class="wrap">
							<div class="inner">
								<div class="label">Price</div>
								<div class="val"><?php echo $price ?></div>
							</div>
						</div>
					</div>	


					<div class="info">
						<div class="wrap">
							<div class="inner">
								<div class="label">Activity Options</div>
								<div class="val"><?php echo $activity_options ?></div>
							</div>
						</div>
					</div>	
						
				</div>
			</section>
			<?php } ?>

		<?php endwhile; ?>

		<?php
		/* PROGRAM OPTIONS */
		$prog_section_title = get_field("prog_section_title");
		$prog_repeater_blocks = get_field("prog_repeater_blocks");
		if($prog_repeater_blocks) { 
			$prog_count = count($prog_repeater_blocks);
		?>
		<section id="program-options" data-section="<?php echo $prog_section_title ?>" class="section-content program-options columns<?php echo $prog_count?> full">
			<?php if ($prog_section_title) { ?>
			<div class="shead-icon text-center">
				<div class="icon"><span class="ci-sun"></span></div>
				<h2 class="stitle"><?php echo $prog_section_title ?></h2>
			</div>
			<?php } ?>

			<div class="columns-wrapper">
				<div class="flexwrap">
					<?php foreach ($prog_repeater_blocks as $p) {
						$p_image = $p['image']; 
						$p_title = $p['title']; 
						$p_text = $p['text']; 
						$p_features = $p['features']; 
						$p_price = $p['price']; 
						$haspic = ($p_image) ? 'haspic':'nopic';
						$link = (isset($p['pagelink']['url']) && $p['pagelink']['url']) ? $p['pagelink']['url'] : '';
						$linkName = (isset($p['pagelink']['title']) && $p['pagelink']['title']) ? $p['pagelink']['title'] : 'Inquire';
						$linkTarget = (isset($p['pagelink']['target']) && $p['pagelink']['target']) ? $p['pagelink']['target'] : '_self';
						?>
					<div class="pblock <?php echo $haspic ?>">
						<div class="inside">
							<div class="image">
								<?php if ($p_image) { ?>
								<div class="feat-image" style="background-image:url('<?php echo $p_image['url'] ?>')"></div>
								<?php } ?>
								<img src="<?php echo $rectangle ?>" alt="" aria-hidden="true" class="helper">
							</div>
							<div class="details">
								<?php if ($p_title) { ?>
								<h3 class="head"><?php echo $p_title ?></h3>
								<?php } ?>

								<?php if ($p_text) { ?>
								<div class="text"><?php echo $p_text ?></div>
								<?php } ?>

								<?php if ($p_features) { ?>
								<div class="features">
									<ul>
									<?php foreach ($p_features as $feat) { 
										$f_title = $feat['heading'];
										$f_text = $feat['text'];
										?>
										<li>
											<?php if ($f_title) { ?>
											<p class="txt1"><strong><?php echo $f_title ?></strong></p>
											<?php } ?>
											<?php if ($f_text) { ?>
											<p class="txt2"><?php echo $f_text ?></p>
											<?php } ?>
										</li>
									<?php } ?>
									</ul>
								</div>
								<?php } ?>

								<?php if ($p_price) { ?>
									<div class="price"><span><?php echo $p_price ?></span></div>
								<?php } ?>

								<?php if ($link) { ?>
								<div class="button">
									<a href="<?php echo $link ?>" target="<?php echo $linkTarget ?>" class="btn-sm xs"><span><?php echo $linkName ?></span></a>
								</div>
								<?php } ?>
								
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</section>
		<?php } ?>

		<?php
		/* CLASSES */
		$classes_section_title = get_field("classes_section_title");
		$repeater_blocks = get_field("repeater_blocks");
		if($repeater_blocks) { ?>
		<section id="classes" data-section="<?php echo $classes_section_title ?>" class="section-content full">
			<?php if ($classes_section_title) { ?>
			<div class="shead-icon text-center">
				<div class="icon"><span class="ci-sun"></span></div>
				<h2 class="stitle"><?php echo $classes_section_title ?></h2>
			</div>
			<?php } ?>

			<div class="post-type-entries">
				<div id="data-container">
					<div class="posts-inner">
						<div class="flex-inner">
							<?php foreach ($repeater_blocks as $e) { 
								$title = $e['title'];
								$description = $e['text'];
								$thumbImage = $e['image'];
								$grades2 = $e['grades'];
								$hours = $e['hours'];
								//$display_option = ($e['display_option']) ? 'fullwidth' : 'normal';
								$blockWidth = ( isset($e['blockWidth']) && $e['blockWidth'] ) ? $e['blockWidth'] : '';
								$display_option = ($blockWidth) ? ' style="width:'.$blockWidth.'%"':'';
								$blockClass = ($blockWidth) ? ' has-custom-width block'.$blockWidth:'';
								?>
								<div class="postbox animated fadeIn <?php echo ($thumbImage) ? 'has-image':'no-image' ?><?php echo $blockClass ?>"<?php echo $display_option ?>>
									<div class="inside">
										
										<div class="photo">
											<?php if ($thumbImage) { ?>
												<span class="imagediv" style="background-image:url('<?php echo $thumbImage['sizes']['medium_large'] ?>')"></span>
												<img src="<?php echo $rectangle ?>" alt="" class="feat-img placeholder">
											<?php } else { ?>
												<span class="imagediv"></span>
												<img src="<?php echo $rectangle ?>" alt="" class="feat-img placeholder">
											<?php } ?>
										</div>

										<div class="details">
											<div class="info">
												<h3 class="event-name"><?php echo $title ?></h3>
												<?php if ($description) { ?>
												<div class="short-description">
													<?php echo $description ?>
												</div>
												<?php } ?>

												<?php if($grades2 || $hours) { ?>
												<div class="options">
													<?php if($grades2) { ?>
													<span>Grades <?php echo $grades2 ?></span>
													<?php } ?>

													<?php if($hours) { ?>
													<span><?php echo $hours ?></span>
													<?php } ?>
												</div>
												<?php } ?>

											</div>
										</div>

									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
		</section>
		<?php } ?>


		<?php
		/* Pass Activities */
		$pass_section_title = get_field("pass_section_title");
		$repeater_blocks2 = get_field("repeater_blocks2");
		$pass_notes = get_field("pass_notes");
		if($repeater_blocks2) { ?>
		<section id="pass-activities" data-section="<?php echo $pass_section_title ?>" class="section-content full">
			<?php if ($pass_section_title) { ?>
			<div class="shead-icon text-center">
				<div class="icon"><span class="ci-task"></span></div>
				<h2 class="stitle"><?php echo $pass_section_title ?></h2>
			</div>
			<?php } ?>

			<div class="post-type-entries">
				<div id="data-container">
					<div class="posts-inner">
						<div class="flex-inner">
							<?php foreach ($repeater_blocks2 as $e) { 
								$title = $e['title'];
								$description = $e['text'];
								$thumbImage = $e['image'];
								$grades2 = $e['grades'];
								$hours = $e['hours'];
								//$display_option = ($e['display_option']) ? 'fullwidth' : 'normal';
								$blockWidth = ( isset($e['blockWidth']) && $e['blockWidth'] ) ? $e['blockWidth'] : '';
								$display_option = ($blockWidth) ? ' style="width:'.$blockWidth.'%"':'';
								$blockClass = ($blockWidth) ? ' has-custom-width block'.$blockWidth:'';
								$link = (isset($e['pagelink']['url']) && $e['pagelink']['url']) ? $e['pagelink']['url'] : '';
								$linkTarget = (isset($e['pagelink']['target']) && $e['pagelink']['target']) ? $e['pagelink']['target'] : '_self';
								$link_open = '';
								$link_close = '';
								if($link) {
									$link_open = '<a class="pagelink" href="'.$link.'" target="'.$linkTarget.'">';
									$link_close = '</a>';
								}
								?>
								<div class="postbox passActivity animated fadeIn <?php echo ($link) ? 'haslink':'nolink'; ?> <?php echo ($thumbImage) ? 'has-image':'no-image' ?><?php echo $blockClass ?>"<?php echo $display_option ?>>
									<div class="inside">
										
										<div class="photo">
											<?php echo $link_open; ?>
											<?php if ($thumbImage) { ?>
												<span class="imagediv" style="background-image:url('<?php echo $thumbImage['sizes']['medium_large'] ?>')"></span>
												<img src="<?php echo $rectangle ?>" alt="" class="feat-img placeholder">
											<?php } else { ?>
												<span class="imagediv"></span>
												<img src="<?php echo $rectangle ?>" alt="" class="feat-img placeholder">
											<?php } ?>
											<?php echo $link_close; ?>
										</div>

										<div class="details js-blocks">
											<div class="info">
												<?php echo $link_open; ?>
													<h3 class="event-name"><?php echo $title ?></h3>
													<?php if ($description) { ?>
													<div class="short-description">
														<?php echo $description ?>
													</div>
													<?php } ?>

													<?php if($grades2 || $hours) { ?>
													<div class="options">
														<?php if($grades2) { ?>
														<span>Grades <?php echo $grades2 ?></span>
														<?php } ?>

														<?php if($hours) { ?>
														<span><?php echo $hours ?></span>
														<?php } ?>
													</div>
													<?php } ?>
												<?php echo $link_close; ?>
											</div>
										</div>

									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

			<?php if ($pass_notes) { ?>
			<div class="important-notes-red">
				<div class="wrapper text-center"><?php echo $pass_notes ?></div>
			</div>	
			<?php } ?>
		</section>
		<?php } ?>

		<?php
		/* FAQs */
		$customFAQTitle = 'FAQ';
		$customFAQClass = 'custom-class-faq graybg';
		include( locate_template('parts/content-faqs.php') );
		include( locate_template('inc/faqs.php') );
		?>


		<?php
		/* Form */
		$form_section_title = get_field("form_section_title");
		$form_content = get_field("content");
		$pass_notes = get_field("pass_notes");
		if($form_content) { ?>
		<section id="form-section" data-section="<?php echo $form_section_title ?>" class="section-content group-form-section full">
			<div id="inquiry-form">
				<?php if ($form_section_title) { ?>
				<div class="shead-icon text-center">
					<h2 class="stitle"><?php echo $form_section_title ?></h2>
				</div>
				<?php } ?>

				<div class="form-content">
					<div class="wrapper narrow"><?php echo $form_content ?></div>
				</div>
			</div>
		</section>
		<?php } ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_template_part("parts/bottom-content-fieldtrips"); ?>



<?php
include( locate_template('inc/pagetabs-script.php') );
get_footer();
