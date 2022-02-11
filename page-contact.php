<?php
/**
 * Template Name: Contact
 */
$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
get_header(); ?>

<div id="primary" class="content-area-full contact-page <?php echo $has_banner ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( get_the_content() ) { ?>
			<section class="text-centered-section">
					<div class="wrapper text-center">
						<?php the_content(); ?>
					</div>
			</section>
			<?php } ?>

			<?php  
			$contact_info = get_field("contact_info");
			$contact_map = get_field("contact_map");
			$contact_form = get_field("contact_form");
			$contactClass = ($contact_info && $contact_map) ? 'half':'full';
			$contactWrap = ( ($contact_info && $contact_map) && $contact_form ) ? 'half':'full';

			//$info_arrs = array('company','address','phone','email');
			if($contact_info || $contact_map || $contact_form) { ?>
			<section class="section-contact-details <?php echo $contactWrap ?>">
				<div class="inner-wrap">
					<?php if ($contact_info || $contact_map) { ?>
						<div class="leftcol">
							<?php if ($contact_info) { ?>
								<div class="address col">
									<div class="inside">
										<div class="wrap"><?php echo anti_email_spam($contact_info); ?></div>
									</div>
								</div>	
							<?php } ?>

							<?php if ($contact_map) { ?>
								<div class="map col">
									<?php echo $contact_map; ?>
									<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="helper">
								</div>	
							<?php } ?>
						</div>
					<?php } ?>

					<?php if ($contact_form) { ?>
					<div class="rightcol">
						<div class="wrap">
							<div class="contact-form"><?php echo anti_email_spam($contact_form); ?></div>
						</div>
					</div>
					<?php } ?>
				</div>
			</section>
			<?php } ?>
				
			
			<?php if( $links = get_field("icons_links") ) { ?>
			<?php 
				$count = 100 / count($links); 
				$count = number_format($count,2,".","");
				$colWidth = floor($count);
			?>
			<section class="section-links-icons">
				<div class="wrapper">
					<div class="flexwrap">
					<?php foreach ($links as $e) { 
						$v_link = $e['link'];
						$v_target = ( isset($v_link['target']) && $v_link['target'] ) ? $v_link['target']:'_self';
						$v_icon = $e['icon']; ?>

						<?php if ($v_link) { ?>
						<div class="block" style="width:<?php echo $colWidth ?>%">
							<a href="<?php echo $v_link['url'] ?>" target="<?php echo $v_target ?>" class="link">
								<?php if ($v_icon) { ?>
									<span class="icon"><span style="background-image:url('<?php echo $v_icon['url']?>')"></span></span>
								<?php } ?>
								<span class="txt"><?php echo $v_link['title'] ?></span>
							</a>
						</div>	
						<?php } ?>

					<?php } ?>
					</div>
				</div>
			</section>	
			<?php } ?>

		<?php endwhile; ?>


		<?php  
		/* SOCIAL MEDIA */
		if( $social_media = get_social_links() ) { ?>
		<div class="bottom-social-media">
			<div class="wrapper">
				<div class="social-links">
					<div class="follow">Follow Us</div>
					<?php get_template_part("parts/social-media"); ?>		
				</div>
			</div>
		</div>
		<?php } ?>


	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
