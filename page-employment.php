<?php
/**
 * Template Name: Employment
 */

get_header(); 
$blank_image = THEMEURI . "images/rectangle.png";
$square = THEMEURI . "images/square.png";
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
$currentPageLink = get_permalink();
$defaultLocation = get_default_job_location();
?>

<div id="primary" data-post="<?php echo get_the_ID()?>" class="content-area-full employment-page <?php echo $has_banner ?>">
	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php if( get_the_content() ) { ?>
				<div class="intro-text-wrap">
					<div class="wrapper">
						<h1 class="page-title"><span><?php the_title(); ?></span></h1>
						<div class="intro-text"><?php the_content(); ?></div>
					</div>
				</div>
			<?php } ?>
		<?php endwhile;  ?>

		<?php get_template_part("parts/subpage-tabs"); ?>

		<?php get_template_part("parts/content-available-jobs") ?>

		<?php
			$icon1 = get_field("icon1");
			$title1 = get_field("title1");
			$text1 = get_field("text1");
			$gallery1 = get_field("gallery1");
			$class1 = ( ($title1 || $text1) && $gallery1 ) ? 'half':'full';
			if( ($title1 || $text1) || $gallery1 ) { ?>
			<section id="section1" data-section="<?php echo $title1 ?>" class="text-and-gallery <?php echo $class1 ?>">
				<div class="mscol <?php echo $class1 ?>">
					
					<?php if ($title1 || $text1) { ?>
					<div class="textcol">
						<div class="inside">
							<div class="info">
								<?php if ($icon1) { ?>
								<div class="icondiv"><span style="background-image:url('<?php echo $icon1['url'];?>')"></span></div>	
								<?php } ?>
								<?php if ($title1) { ?>
								<h3 class="mstitle"><?php echo $title1 ?></h3>	
								<?php } ?>
								<?php if ($text1) { ?>
								<div class="textwrap"><?php echo $text1 ?></div>	
								<?php } ?>
							</div>
						</div>
					</div>
					<?php } ?>

					<?php if ($gallery1) { ?>
					<div class="gallerycol">
						<div class="flexslider">
							<ul class="slides">
								<?php $helper = THEMEURI . 'images/rectangle-narrow.png'; ?>
								<?php foreach ($gallery1 as $s) { ?>
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
			</section>
			<?php } ?>

		<?php
			$title2 = get_field("title2");
			$title2 = ($title2) ? $title2 : '';
			$video_code = get_field("video_code");
			$gallery1 = get_field("gallery1");
			if( $video_code ) { ?>
			<section id="section2" data-section="<?php echo $title2 ?>" class="section-content section-video">
				<div class="wrapper narrow">
					<div class="video-frame">
						<?php echo $video_code ?>
						<img src="<?php echo $blank_image ?>" alt="" aria-hidden="true" class="video-helper" />		
					</div>
				</div>
			</section>
			<?php } ?>

			<?php
			$showHide = get_field("show_hide");
			$left_image = get_field("left_image");
			$left_text = get_field("left_text");
			$jobfairTypes = get_field("jobfair_types");
			$jobfairTitle = get_field("jobfair_types_title");
			$showFaqs = get_field("faqs_visibility");

			if( $showHide == 'show' ) :
			$s3 = ( ($left_image || $left_text) &&  $jobfairTypes ) ? 'half':'full';
			if( ($jobfairTitle || $jobfairTypes) || ($left_image || $left_text) ) { ?>
			<section id="section3" data-section="<?php echo $jobfairTitle ?>" class="section-content section-jobfair <?php echo $s3 ?>">
				<div class="flexwrap">

					<?php if ($left_image || $left_text) { ?>
					<div class="imagecol">
						<?php if ($left_image) { ?>
							<div class="r1"><img src="<?php echo $left_image['url'] ?>" alt="<?php echo $left_image['title'] ?>" class="left-image"></div>
						<?php } ?>
						<?php if ($left_text) { ?>
							<div class="r2">
								<div class="text"><?php echo $left_text ?></div>
							</div>
						<?php } ?>
					</div>
					<?php } ?>

					
					<div class="jobfair jobfairTypes">
						<div class="inside">
							<div class="wrap">
								<?php if ($jobfairTitle) { ?>
								<div class="shead-icon text-center">
									<div class="icon"><span class="ci-menu"></span></div>
									<h2 class="stitle"><?php echo $jobfairTitle ?></h2>
								</div>
								<?php } ?>

								<?php if ($jobfairTypes) { ?>
								<div class="schedule">
									<?php $t=1; foreach ($jobfairTypes as $j) { 
										$j_title = $j['title'];
										$schedule = $j['schedule'];
										$first_type = ($t==1) ? ' first':'';
										?>
										<div class="jobfair-type<?php echo $first_type ?>">
											<?php if ($j_title) { ?>
											<p class="job-event"><?php echo $j_title ?></p>	
											<?php } ?>

											<?php if ($schedule) { ?>
												<div class="schedule-list">
													<?php $c=1; foreach ($schedule as $s) { 
														$day = $s['day'];
														$date = $s['date'];
														$time = $s['time'];
														$button = $s['button'];
														$target = ( isset($button['target']) && $button['target'] ) ? $button['target'] : '_self';
														$is_first = ($c==1) ? ' first':'';
														?>
														<div class="info<?php echo $is_first ?>">
															<div class="time">
																<?php if ($day) { ?>
																<span class="day"><?php echo $day ?></span>	
																<?php } ?>

																<?php if ($date) { ?>
																<span class="date"><?php echo $date ?></span>	
																<?php } ?>

																<?php if ($time) { ?>
																<span class="time"><?php echo $time ?></span>	
																<?php } ?>
															</div>

															<?php if ($button) { ?>
																<div class="buttondiv">
																	<a href="<?php echo $button['url'] ?>" target="<?php echo $target ?>" class="btn-sm xs"><span><?php echo $button['title'] ?></span></a>
																</div>	
															<?php } ?>
														</div>
														<?php $c++; } ?>
												</div>		
											<?php } ?>
										</div>	
									<?php $t++; } ?>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					

				</div>
			</section>
			<?php } 
			endif;
			?>


		<?php //get_template_part("parts/content-employee-stories") ?>


		<?php
		$customFAQTitle = 'FAQ';
		$customFAQClass = 'custom-class-faq graybg';
		include( locate_template('parts/content-faqs.php') );
		if( $showFaqs != 'hide' ) {include( locate_template('inc/faqs.php') );}
		?>

</div><!-- #primary -->

<script type="text/javascript">
jQuery(document).ready(function($){
	var currentURL = window.location.href;
	var defaultJobLocation = '<?php echo $defaultLocation ?>';

	$(document).on('facetwp-refresh', function() {
    var query_string = FWP.build_query_string();
    if ( '' === query_string ) { // no facets are selected
      $('.filter-message #fm').show();
      //location.reload();
    } else {
    	$('.filter-message #fm').hide();
    }
	});

	$(document).on("click","#nextPostsBtn",function(e){
		e.preventDefault();
		var button = $(this);
		var baseURL = $(this).attr("data-baseurl");
		var currentPageNum = $(this).attr("data-current");
		var nextPageNum = parseInt(currentPageNum) + 1;
		var pageEnd = $(this).attr("data-end");
		var nextURL = baseURL + '?pg=' + nextPageNum;
		button.attr("data-current",nextPageNum);
		if(nextPageNum==pageEnd) {
			$(".loadmorediv").remove();
		}
		$(".hidden-entries").load(nextURL+" #data-container",function(){
			if( $(this).find(".posts-inner .flex-inner").length>0 ) {
				var entries = $(this).find(".posts-inner .flex-inner").html();
				$("#loaderDiv").addClass("show");
				if(entries) {
					$("#data-container .flex-inner").append(entries);
					setTimeout(function(){
						$("#loaderDiv").removeClass("show");
					},500);
				}
			}
		});
	});

	// $(document).on("click",".resetBtn",function(e){
	// 	e.preventDefault();
	// 	var link = $(this).attr("href");
	// 	$(".post-type-entries").hide();
	// });

	// $(document).on("change",".facetwp-dropdown",function(e){
	// 	$(".post-type-entries").show();
	// });
	
});
</script>
<?php
include( locate_template('inc/pagetabs-script.php') );
get_footer();
