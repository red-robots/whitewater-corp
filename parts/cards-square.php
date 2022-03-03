<?php 
$rectangle = THEMEURI . "images/rectangle.png";
$square = THEMEURI . "images/square.png";
$sSectionTitle = get_sub_field('section_title_sq');
$sSectionIcon = get_sub_field('section_icon_sq');
$sDataSection = sanitize_title_with_dashes($sSectionTitle);
 ?>
<section id="classes" data-section="<?php echo $sDataSection; ?>" class="home-square-cards section-content section-classes post-type-entries <?php echo $wrapClass ?>">
	<div class="wrapper titlediv">
		<div class="shead-icon text-center">
			<div class="icon"><span class="ci-task"></span></div>
			<h2 class="stitle"><?php echo $sSectionTitle ?></h2>
		</div>
	</div>
	<div id="data-container">
		<div class="posts-inner">
			<div class="flex-inner">
			<?php 
			if ( have_rows('card_sq') ) :
			$i=1; while ( have_rows('card_sq') ) : the_row(); 
				$id = get_the_ID();
				// $title = get_the_title();
				// $pagelink = get_permalink();
				$thumbImage = get_sub_field("image_sq");
				$short_description = get_sub_field("short_description_sq");
				$title = get_sub_field("title_sq");
				$pagelink = get_sub_field("link_sq");
				$newTab = get_sub_field("open_sq");
				$btnLabel = get_sub_field("button_label_sq");
				if( $newTab == 'new' ){
					$target = '_blank';
				} else {
					$target = '_self';
				}
				// echo '<pre>';
				// print_r($thumbImage);
				// echo '</pre>';
			?>
			<div class="postbox animated fadeIn <?php echo ($thumbImage) ? 'has-image':'no-image' ?>">
				<div class="inside">
					<a href="<?php echo $pagelink ?>" class="photo" target="<?php echo $target; ?>">
						<?php if ($thumbImage) { ?>
							<span class="imagediv" style="background-image:url('<?php echo $thumbImage['sizes']['large'] ?>')"></span>
							<img src="<?php echo $rectangle ?>" alt="" class="feat-img placeholder">
						<?php } else { ?>
							<span class="imagediv"></span>
							<img src="<?php echo $rectangle ?>" alt="" class="feat-img placeholder">
						<?php } ?>
					</a>

					<div class="details">
						<div class="info">
							<h3 class="event-name"><?php echo $title ?></h3>
							<?php if ($short_description) { ?>
							<div class="short-description">
								<?php echo $short_description ?>
							</div>
							<?php } ?>
						</div>
					</div>

				</div>
				<div class="button">
					<a href="<?php echo $pagelink ?>" class="btn-sm"  target="<?php echo $target; ?>">
						<span><?php if( $btnLabel ) { echo $btnLabel; } else { echo 'See Details'; }?></span>
					</a>
				</div>
			</div>
			<?php $i++; endwhile; endif; //wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
</section>