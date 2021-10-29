<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); 
$post_type = get_post_type();
$heroImage = get_field("full_image");
$flexbanner = get_field("flexslider_banner");
$has_hero = 'no-banner';
if($heroImage) {
	$has_hero = ($heroImage) ? 'has-banner':'no-banner';
} else {
	if($flexbanner) {
		$has_hero = ($flexbanner) ? 'has-banner':'no-banner';
	}
}

get_template_part("parts/subpage-banner");

$rectangle_placeholder = get_bloginfo("template_url") . '/images/video-helper.png';
$post_id = get_the_ID(); ?>
	
<?php if ($post_type=='post') { ?>

	<?php  
	$thumbId = get_post_thumbnail_id($post_id); 
	$featImg = wp_get_attachment_image_src($thumbId,'full');
	$has_feat_image = ($featImg) ? 'has-banner':'no-banner';
	$video = get_field("video");
	$videoId = '';
	$vimeo_video_id = '';
	if($video) {
		if (strpos($video, '/youtu.be/') !== false) {
		  $parts = explode("/",$video);
		  $videoId = end($parts);
		}
		else if (strpos($video, 'youtube.com') !== false) {
		  $parts = parse_url($video);
		  parse_str($parts['query'], $query);
		  $videoId = (isset($query['v']) && $query['v']) ? $query['v'] : '';
		}
		else if (strpos($video, 'vimeo.com') !== false) {
		  $vimeo_video_id = basename($video);
		}
	}
	?>

	<div id="primary" class="content-area-full content-default single-post <?php echo $has_feat_image;?> post-type-<?php echo $post_type;?>">

		<?php if($videoId) { ?>
		<div class="post-hero-image video-wrap">
			<div class="video-frame">
				<div class="video">
					<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoId?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<img src="<?php echo $rectangle_placeholder ?>" alt="" aria-hidden="true" class="helper">
				</div>
			</div>	
		</div>
		<?php } else if($vimeo_video_id) { ?>

			<div class="post-hero-image video-wrap">
				<div class="video-frame">
					<div class="video">
						<iframe id="vimeoVideoFrame" src="https://player.vimeo.com/video/<?php echo $vimeo_video_id?>?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
						<script src="https://player.vimeo.com/api/player.js"></script>
						<?php if ($featImg) {  $hero_alt = get_the_title($thumbId);  ?>
						<a id="videoCustomImage" style="background-image:url('<?php echo $featImg[0] ?>')" class="videoCustomImage"><span class="sr-only">play video</span></a>
						<img src="<?php echo $featImg[0] ?>" alt="" aria-hidden="true" class="helper" style="visibility:hidden;">
						<?php } else { ?>
						<img src="<?php echo $rectangle_placeholder ?>" alt="" aria-hidden="true" class="helper">
						<?php } ?>
					</div>
				</div>
			</div>

		<?php } else { ?>

			<?php if ($featImg) { 
				$hero_alt = get_the_title($thumbId); 
				$photographer = get_field("photographer",$thumbId);
				$photolocation = get_field("location",$thumbId);
			?>
			<div class="post-hero-image">
				<img src="<?php echo $featImg[0] ?>" alt="<?php echo $hero_alt ?>" class="featured-image">
				<?php if ( $photographer||$photolocation ) { ?>
				<a class="view-photo-credit"><span class="camera-icon"><i class="fas fa-camera"></i></span></a>
				<span class="photo-credit">
					<span><strong>Photographer:</strong> <?php echo $photographer ?></span>
					<span><strong>Location:</strong> <?php echo $photolocation ?></span>
				</span>
				<?php } ?>
			</div>
			<?php } ?>

		<?php } ?>

		<main id="main" data-postid="post-<?php the_ID(); ?>" class="site-main" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php
				$short_description = get_field("short_description_text");
				$custom_post_author = get_field("custom_post_author");
				$postdate = get_the_date('F j, Y');
				?>
				<section class="text-centered-section dark">
					<div class="wrapper text-center">
						<div class="page-header">
							<h1 class="page-title"><?php the_title(); ?></h1>
							<?php if ($custom_post_author) { ?>
								<p class="author">By <?php echo $custom_post_author; ?></p>
							<?php } ?>
							<?php if ($postdate) { ?>
								<p class="postdate">Posted on <?php echo $postdate; ?></p>
							<?php } ?>
						</div>

						<div class="post-content <?php echo ($videoId) ? 'twocol':'onecol'; ?>">
							<?php if ($short_description) { ?>
							<div class="shortdesc">
								<?php echo anti_email_spam($short_description); ?>
							</div>	
							<?php } ?>
						</div>
					</div>
				</section>


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
								<div class="textwrap"><?php echo anti_email_spam( $main_content ); ?></div>
								<?php if ($author_description) { ?>
								<div class="author-bio"><?php echo $author_description ?></div>	
								<?php } ?>
								<div class="post-social-share"><?php echo do_shortcode('[addtoany]') ?></div>
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

			<?php endwhile; ?>
		</main>

	</div>

	<?php /* EXPLORE OTHER ACTIVITIES */ ?>
	<?php get_template_part("parts/similar-posts"); ?>

<?php } else { ?>

	<div id="primary" class="content-area-full content-default <?php echo $has_hero;?> post-type-<?php echo $post_type;?>">

		<?php get_template_part('parts/post-type-'.$post_type); ?>
	
	</div><!-- #primary -->

<?php } ?>




<script type="text/javascript">
jQuery(document).ready(function($){

	$(".view-photo-credit").hover(function(){
	  $(this).next(".photo-credit").addClass("show");
	  }, function(){
	  $(this).next(".photo-credit").removeClass("show");
	});

	$("#videoCustomImage").on("click",function(){
		var src = $("#vimeoVideoFrame").attr("src");
		var newURL = src + '&autoplay=1';
		$("#vimeoVideoFrame").attr("src",newURL);
		$(this).hide();
	});

	if( $("#section-checkin").length>0 ) {
		var nextEL = $("#section-checkin").next();
		if( nextEL.length>0 ) {
			var className = nextEL[0].className;
			if(className=='explore-other-stuff') {
				$("#section-checkin").css("margin-bottom","0");
			}
		}
	}

});
</script>

<?php
get_footer();
