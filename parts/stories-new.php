<?php 
$galleries = get_field("image_gallery");
$placeholder = THEMEURI . 'images/rectangle.png';
// $main_content = get_the_content();
$authorId = '';
$author_description = get_the_author_meta('description');
$main_class = ($new_stories && $galleries) ? 'half':'full';
$new_count = ($galleries) ? count($galleries) : 0;
$img_class = ($new_count%2) ? ' default':' twocol';

if( have_rows('the_story') ): ?>

<section class="main-post-text <?php echo $main_class.$img_class ?>">
	<div class="flexwrap">
    	<div class="textcol">
			<div class="inside">
				<div class="textwrap">
				   <?php while ( have_rows('the_story') ) : the_row();

				        
				        if( get_row_layout() == 'text_block' ):
				            $text_block = get_sub_field('text_block');
				    ?>
				            <?php echo $text_block; ?>

				        
				        <?php elseif( get_row_layout() == 'gallery' ): 
				            $new_galleries = get_sub_field('gallery'); ?>
				            
				            <div id="carousel-images" class="camp-caro swap">
								<div class="loop owl-carousel owl-theme">
								<?php foreach ($new_galleries as $g) { ?>
									<div class="item">
										<div class="image" style="background-image:url('<?php echo $g['url']?>')">
											<a href="<?php echo $g['url']?>" data-fancybox class="popup-image">
											<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
											</a>
										</div>
									</div>
								<?php } ?>
								</div>
							</div>

				        <?php endif;
				        ?>

				    
				    <?php endwhile; ?>
				    <?php if ($author_description) { ?>
						<div class="author-bio"><?php echo $author_description ?></div>	
					<?php } ?>
					<div class="post-social-share"><?php //echo do_shortcode('[addtoany]') ?></div>
			    </div>
    		</div>
		</div>

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

<?php else :
    // Do something...
endif;
?>





		

		

