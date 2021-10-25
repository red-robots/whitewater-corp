<?php
$placeholder = THEMEURI . 'images/rectangle.png';
$placeholder2 = THEMEURI . 'images/rectangle-narrow.png';
$section_title = get_sub_field('section_title_horiz');
$section_icon = get_sub_field('section_icon_horiz');
$services = get_field("groupevents_featuredservices");
//if($services) { ?>
<div class="group-services-wrapper">
	<?php $i=1; 
	if( have_rows('card_horiz') ): while( have_rows('card_horiz') ): the_row();
	//foreach ($services as $e) { 
		$title = get_sub_field('title_card_horiz');
		$description = get_sub_field('short_description_horiz');
		$button = ( isset($e['button']) && $e['button'] ) ? $e['button'] : "";
		$buttonName = get_sub_field('button_label_horiz'); 
		$buttonLink = get_sub_field('button_link_horiz'); 
		$slides = get_sub_field('gallery_horiz');
		//$buttonList = $e['buttons'];
		$open = get_sub_field('open_horiz');
		if( $open == 'self' ) {
			$open = '_self';
		} else {
			$open = '_blank';
		}
		// echo '<pre>';
		// print_r($slides);
		// echo '</pre>';

		$boxClass = ( ($title || $description) && $slides ) ? 'half':'full';
			if( ($title || $description) || $slides) {
				$colClass = ($i % 2) ? ' odd':' even'; ?>
			<section id="services<?php echo $i?>" data-section="<?php echo $title ?>" class="section-content menu-sections group-events-services">
				<div class="columns-2">
					<div class="mscol <?php echo $boxClass.$colClass ?>">
						
						<?php if ( $title || $description ) { ?>
						<div class="textcol">
							<div class="inside">

								<div class="info">
									<?php if ($title) { ?>
										<h3 class="mstitle"><?php echo $title ?></h3>
									<?php } ?>

									<?php if ($description) { ?>
										<div class="textwrap">
											<div class="mstext"><?php echo $description ?></div>
										</div>
									<?php } ?>

									<?php /* Button */ ?>
									<?php //if ($buttonName && $buttonLink) { ?>
									<!-- <div class="buttondiv">
										<a href="<?php //echo $buttonLink ?>" target="<?php //echo $buttonTarget ?>" class="btn-sm pagelink"><span><?php //echo $buttonName ?></span></a>
									</div> -->
									<?php // } ?>


									<?php /* Multiple Buttons */ ?>
									<?php if ($buttonLink) { ?>
										<div class="buttonGroup">
											<div class="buttondiv">
												<a href="<?php echo $buttonLink ?>" class="btn-sm pagelink" target="<?php echo $open; ?>">
													<span>
														<?php if( $buttonName ) { echo $buttonName; } else { echo 'See Details'; }?>
													</span>
												</a>
											</div>
										</div>
									<?php } ?>

								</div><!-- .info -->

							</div><!-- .inside -->
						</div><!-- .textcol -->	
						<?php } ?>

						<?php if ( $slides ) { ?>
						<div class="gallerycol">
							<div class="flexslider">
								<ul class="slides">
									<?php $helper = THEMEURI . 'images/rectangle-narrow.png'; ?>
									<?php foreach ($slides as $s) { ?>
										<li class="slide-item" style="background-image:url('<?php echo $s['url']?>')">
											<img src="<?php echo $helper ?>" alt="" aria-hidden="true" class="placeholder">
											<img src="<?php echo $s['url'] ?>" alt="<?php echo $s['title'] ?>" class="actual-image" />
										</li>
									<?php } ?>
								</ul>
							</div>
						</div>	
						<?php } ?>

					</div>
				</div>
			</section>
	
		<?php $i++; } ?>

	<?php endwhile; endif; //} ?>

</div>
<?php //} ?>