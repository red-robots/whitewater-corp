<?php
/*===== ROW 4: STORIES =====*/
$row4_title = get_field('row4_title');  
$row4_text = get_field('row4_text');  
$row4_button_name = get_field('row4_button_name');  
$row4_button_link = get_field('row4_button_link');  
$sample = THEMEURI . "images/sample.jpg";  
$blank_image = THEMEURI . "images/rectangle.png";
?>
<?php if ($row4_title) { ?>
<section id="section-stories" class="homerow row4">
	<div class="wrapper inner-content text-center">
		<!-- <div class="icondiv"><span class="video"></span></div> -->
		<!-- <h2 class="stitle"><?php //echo $row4_title ?></h2> -->
		<div class="shead-icon text-center">
			<div class="icon"><span class="ci-video"></span></div>
			<h2 class="stitle"><?php echo $row4_title ?></h2>
		</div>

		<?php if ($row4_text) { ?>
		<div class="wrapper narrow"><div class="title-text"><?php echo $row4_text ?></div></div>
		<?php } ?>

		<?php if ($row4_button_name && $row4_button_link) { ?>
		<div class="buttondiv">
			<a href="<?php echo $row4_button_link['url'] ?>" target="<?php echo $row4_button_link['target'] ?>" class="btn-sm"><span><?php echo $row4_button_name ?></span></a>
		</div>	
		<?php } ?>
	</div>

	<?php /* VIDEOS */ ?>
	<?php  
	//$post_type = 'story';
	$post_type = 'post';
	$per_page = 2;
	$args = array(
		'posts_per_page'	=> $per_page,
		'post_type'		=> $post_type,
		'post_status'	=> 'publish',
		'meta_key'		=> 'show_on_homepage',
		'meta_value'	=> 'yes'
	);
	$posts = new WP_Query($args);
	if ( $posts->have_posts() ) { 
	$totalpost = $posts->found_posts;  
	
	?>
	<div class="home-video-gallery full count<?php echo $totalpost?> numblocks<?php echo $per_page?>">
		<div class="inner-wrap">
			<div class="flexwrap">
				<?php $i=1; while ( $posts->have_posts() ) : $posts->the_post(); 
				$post_title = get_the_title(); 
				$videoURL = get_field("video");
				$custom_thumb = get_field("image");
				$thumbType = get_field("thumbnail_type");
				$thumbnail_type = ($thumbType=='custom_image') ? $thumbType : 'default_image';
				$video_thumbnail = '';
				$default_thumb = '';
				$youtubeID = '';
				$vimeoID = '';
				$is_video_vimeo = '';
				$pageLink = get_permalink();
				$catObj = get_the_terms( get_the_ID(), 'category' );
				$catNameArray = array();
				$filmCat = '';
				
				foreach ( $catObj as $slug ) {
					$catNameArray[] = $slug->slug;
				}
				// echo '<pre>';
				// print_r($catNameArray);
				// echo '</pre>';
				if( in_array('films', $catNameArray) ) {
					$filmCat = 'yes';
				}

				

				//Youtube
				if ( (strpos( strtolower($videoURL), 'youtube.com') !== false) || (strpos( strtolower($videoURL), 'youtu.be') !== false) ) {
					if(strpos( strtolower($videoURL), 'youtu.be') !== false) {
						$parts = explode("/",$videoURL);
						$youtubeID = end($parts);
					}
					if(strpos( strtolower($videoURL), 'youtube.com') !== false) {
						$parts = parse_url($videoURL);
						parse_str($parts['query'], $query);
						$youtubeID = (isset($query['v']) && $query['v']) ? $query['v']:''; 
					}
					$video_thumbnail = 'https://i.ytimg.com/vi/'.$youtubeID.'/maxresdefault.jpg';
					$default_thumb = $video_thumbnail;
					$is_video_vimeo = ' video__youtube';
				}

				//Vimeo
				
				$video_link = $videoURL;
				if (strpos( strtolower($videoURL), 'vimeo.com') !== false) {
					$vimeo_parts = explode("/",$videoURL);
					$parts = ($vimeo_parts && array_filter($vimeo_parts) ) ? array_filter($vimeo_parts) : '';
					$vimeoId = ($parts) ?  preg_replace('/\s+/', '', end($parts)) : '';
					$vimeoData = ($vimeoId) ? get_vimeo_data($vimeoId) : '';
					$video_link = $videoURL;
					$videoURL .= '?autoplay=1';
					$is_video_vimeo = ' video__vimeo';


					// if($vimeoData) { 
					// 	//$video_thumbnail = $vimeoData->thumbnail_large;
					// 	$video_thumbnail =  $vimeoData['thumbnail_large'];
					// 	$default_thumb = $video_thumbnail;
					// }

					$data = json_decode( file_get_contents( 'https://vimeo.com/api/oembed.json?url=' . $videoURL ) );
					if($data) {
						$video_thumbnail =  $data->thumbnail_url;
						$default_thumb = $video_thumbnail;
					}

				}


				if($thumbnail_type=='default_image') {
					$video_thumbnail = $default_thumb;
				} else {
					if($custom_thumb) {
						$video_thumbnail = $custom_thumb['url'];
						$is_video_vimeo = '';
					}
				}

				$imageBg = ($video_thumbnail) ? ' style="background-image:url('.$video_thumbnail.')"':'';

				if ($i==1) { ?>
				<div class="colLeft video-big">
					<div class="imagediv storyVideo wave-effect<?php echo $is_video_vimeo ?>"<?php echo $imageBg ?> data-url="<?php echo $video_link ?>">
						<img src="<?php echo $blank_image ?>" alt="" aria-hidden="true" class="blankImg">
						
						<?php 
						// if ($thumbnail_type=='default_image') { 
						// instead of seeing if it was the default image, let's check to see if it is categorized as film
						if( $filmCat == 'yes' ) {
						?>
						<div class="videoBtn">
							<a href="#" class="play-btn large"></a>
						</div>
						<?php } ?>

						<span class="wave">
							<svg class="waveSvg" shape-rendering="auto" preserveAspectRatio="none" viewBox="0 24 150 28" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path id="a" d="m-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z"/></defs><g class="waveAnimation"><use x="85" y="5" xlink:href="#a"/></g></svg>
						</span>
						<a href="<?php echo $pageLink ?>" class="videoLink">
							<span class="videoName"><span><?php echo $post_title ?></span></span>
						</a>
						<div class="mobile-name"><?php echo $post_title ?></div>
					</div>
					
				</div>
				<div class="colRight small-videos">
					<div class="wrap">
				<?php } else { ?>
						<div class="sm-video">
							<div class="thumb storyVideo wave-effect<?php echo $is_video_vimeo ?>"<?php echo $imageBg ?> data-url="<?php echo $video_link ?>">
								<img src="<?php echo $blank_image ?>" alt="" aria-hidden="true" class="blankImg">
								<?php 
								// if ($thumbnail_type=='default_image') { 
								// instead of seeing if it was the default image, let's check to see if it is categorized as film
								if( $filmCat == 'yes' ) {
									?>
								<div class="videoBtn">
									<a href="#" class="play-btn large"></a>
								</div>
								<?php } ?>
								
								<span class="wave">
									<svg class="waveSvg" shape-rendering="auto" preserveAspectRatio="none" viewBox="0 24 150 28" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path id="a" d="m-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z"/></defs><g class="waveAnimation"><use x="85" y="5" xlink:href="#a"/></g></svg>
								</span>
								<a href="<?php echo $pageLink ?>" class="videoLink">
									<span class="videoName"><span><?php echo $post_title ?></span></span>
								</a>
								<div class="mobile-name"><?php echo $post_title ?></div>
							</div>
							
						</div>
				<?php } ?>
				<?php $i++; endwhile; wp_reset_postdata(); ?>
					</div><!-- .wrap -->
				</div><!-- .colRight -->
			</div>
		</div>
	</div>
	<?php } ?>

</section>
<?php } ?>