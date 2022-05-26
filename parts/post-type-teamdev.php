<?php
$placeholder = THEMEURI . 'images/rectangle.png';
$perpage = -1;
$posttype = 'teamdev';
$args = array(
	'posts_per_page'   => $perpage,
	'post_type'        => $posttype,
	'post_status'      => 'publish'
);
$entries = new WP_Query($args); 
if ( $entries->have_posts() ) { ?>
<section class="flex-container store-listings full nomtop">
	<?php $i=1; while ( $entries->have_posts() ) : $entries->the_post(); ?>
		<?php 
		$title = get_the_title(); 
		$text = get_the_content();
		$slides = get_field("image_slides");
		$brands = get_field("brands");
		$columnClass = ( $slides && ($text || $brands) ) ? 'half':'full';
		$columnClass .= ($i % 2) ? ' odd':' even';
		?>
		<div id="entry<?php echo $i ?>" data-section="<?php echo $title ?>" class="entry <?php echo $columnClass ?>">
			<div class="flexwrap wow fadeIn">
				
				<?php if ($text || $brands) { ?>
				<div class="block textcol">
					<div class="inside">
						<div class="wrap">
							<div class="text text-center">
								<h2 class="stitle"><?php echo $title ?></h2>
								<?php if ($text) { ?>
									<?php the_content(); ?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>	
				<?php } ?>

				<?php if ($slides) { $count = count($slides); ?>
				<div class="block imagecol">
					<div class="inside">
							<div id="subSlider<?php echo $i?>" class="flexslider posttypeslider <?php echo ($count>1) ? 'doSlider':'noSlider'?>">
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
				</div>
				<?php } ?>

			</div>
		</div>
	<?php $i++; endwhile; wp_reset_postdata(); ?>
</section>
<?php } ?>

<script type="text/javascript">
jQuery(document).ready(function($){
	// if( $(".doSlider").length>0 ) {
	// 	$(".doSlider").each(function(){
	// 		var slideId = $(this).attr("id");
	// 		$("#"+slideId+".doSlider").flexslider({
	// 	    animation: "slide"
	// 	  });
	// 	});
	// }
});
</script>
