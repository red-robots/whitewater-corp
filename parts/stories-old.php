<?php  
$galleries = get_field("image_gallery");
$main_content = get_the_content();
$authorId = '';
$author_description = get_the_author_meta('description');
$main_class = ($main_content && $galleries) ? 'half':'full';
$new_count = ($galleries) ? count($galleries) : 0;
$img_class = ($new_count%2) ? ' default':' twocol';

if($main_content || $galleries) { ?>
<section class="main-post-text <?php echo $main_class.$img_class ?>">
	<div class="flexwrap">
		<?php if ($main_content) { ?>
		<div class="textcol">
			<div class="inside">
				<div class="textwrap"><?php echo $main_content; ?></div>
				<?php if ($author_description) { ?>
				<div class="author-bio"><?php echo $author_description ?></div>	
				<?php } ?>
				<div class="post-social-share"><?php //echo do_shortcode('[addtoany]') ?></div>
			</div>
		</div>	
		<?php } ?>

		<?php if ($galleries) { ?>
			<div class="imagescol">
				<?php  
					$imgMain = $galleries[0];
					$imgMainID = $imgMain['ID'];
					$imgClass = get_field("media_custom_class",$imgMainID);
				?>

				<?php if ( count($galleries)>1 ) { ?>
					
					<?php if ($new_count % 2) { ?>

						<div class="masonry top<?php echo ($imgClass) ? ' ' . $imgClass:'' ?>">
							<div class="block first">
								<a href="<?php echo $imgMain['url'] ?>" data-fancybox class="popup-image"><img src="<?php echo $imgMain['url'] ?>" alt="<?php echo $imgMain['title'] ?>"></a>
								
							</div>
						</div>
						
						<?php unset($galleries[0]); ?>

					<?php } ?>
					
					<div class="masonry">
						<?php 
						$i=1; foreach ($galleries as $g) { 
							$g_ID = $g['ID'];
							$g_class = get_field("media_custom_class",$g_ID);
							$photographer = get_field("photographer",$g_ID);
							$photolocation = get_field("location",$g_ID);
							?>
							<div class="block photoframe <?php echo ($g_class) ? ' ' . $g_class:'' ?>">
								<a href="<?php echo $g['url'] ?>" data-fancybox class="popup-image">
									<img src="<?php echo $g['url'] ?>" alt="<?php echo $g['title'] ?>">
								</a>
								<?php if ( $photographer||$photolocation ) { ?>
								<a class="view-photo-credit"><span class="camera-icon"><i class="fas fa-camera"></i></span></a>
								<span class="photo-credit">
									<span><strong>Photographer:</strong> <?php echo $photographer ?></span>
									<span><strong>Location:</strong> <?php echo $photolocation ?></span>
								</span>
								<?php } ?>
							</div>
						<?php $i++; } ?>
					</div>

				<?php } else { ?>

					<div class="masonry top<?php echo ($imgClass) ? ' ' . $imgClass:'' ?>">
						<div class="block first">
							<img src="<?php echo $imgMain['url'] ?>" alt="<?php echo $imgMain['title'] ?>">
						</div>
					</div>

				<?php } ?>
			</div>	
		<?php } ?>

	</div>
</section>
<?php } ?>