<?php 
$catObj = get_the_terms( get_the_ID(), 'category' );
$catNameArray = array();
$filmCat = '';

foreach ( $catObj as $slug ) {
$catNameArray[] = $slug->slug;
}
// echo '<pre>';
// print_r($catObj);
// echo '</pre>';
if( in_array('films', $catNameArray) ) {
$filmCat = 'yes';
}
 ?>
<article id="post-id-<?php the_ID(); ?>" class="entry <?php echo $divclass ?>">
				<div class="inner-wrap">

					<?php if ($featImg) { ?>
					<div class="imagecol">
						<?php
							if( $filmCat == 'yes' ) {
							?>
							<div class="videoBtn">
								<a href="<?php echo $pagelink ?>" class="play-btn large"></a>
							</div>
							<?php } ?>
						<div class="blurred" style="background-image:url('<?php echo $featThumb[0] ?>')"></div>
						<div class="image fadeIn wow" data-wow-delay="<?php echo $sec;?>s" style="background-image:url('<?php echo $featImg[0] ?>')">

							<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="helper">
						</div>
					</div>
					<?php } ?>

					<?php if ($content || $title) { ?>
					<div class="textcol">
						<div class="inside fadeIn wow" data-wow-delay="<?php echo $sec;?>s">
							<div class="wrap">
								<h2 class="title"><?php echo $title; ?></h2>
								<?php $postdate = get_the_date('M j, Y'); ?>
								<div class="store-postdate"><span><?php echo $postdate ?></span></div>

								<?php if ($content) { ?>
									<div class="text">
										<?php //echo shortenText(strip_tags($content),200,' ','...'); ?>
										<?php the_excerpt(); ?>		
									</div>
								<?php } ?>
								<div class="buttondiv">
									<a href="<?php echo $pagelink ?>" class="btn-sm xs"><span>See More</span></a>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>

				</div>
</article>