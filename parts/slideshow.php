<?php
$post_id = get_the_ID();
$use_parent_page = false;
if( isset($parent_page_id) && $parent_page_id ) {
	$post_id = $parent_page_id;
	$use_parent_page = true;
}
$placeholder = THEMEURI . 'images/rectangle-lg.png';
$videoHelper = THEMEURI . 'images/rectangle-narrow.png';
$is_subpage = (is_home() || is_front_page()) ? false : true;
$top_notification = get_field("top_notification",$post_id);
$banner = get_field("full_image",$post_id);

$is_single_post = ( is_single() ) ? true : false;
$is_default_slide = ($is_single_post && $banner) ? false : true;

if($use_parent_page) {
	$is_default_slide = true;
}

$excludePostTypes = exclude_post_types_banner();
if ( is_singular( get_post_type() ) && in_array(get_post_type(),$excludePostTypes) ) {
	$is_default_slide = false;
}

if($is_default_slide) { ?>
	<?php 
	$flexslider = get_field( "flexslider_banner",$post_id);
	$slidesCount = ($flexslider) ? count($flexslider) : 0;
	$numSlides = ($slidesCount==1) ? 'single-slide':'multiple-slides';
	$firstImg = array();
	if($flexslider) {
		foreach($flexslider as $r) {
			if( isset($r['image']['url']) ) {
				$firstImg[] = $r['image']['url'];
			}
		}
	}
	$slide_class = ($slidesCount>1) ? 'flexslider':'static-banner';
	?>

	<?php if ( $flexslider ) { ?>
	<div id="banner">
		<div class="slides-wrapper <?php echo $slide_class ?>">
			<?php if ($is_subpage && $top_notification) { ?>
			<div class="slideTopTitle animated fadeIn">
				<div class="wrapper text-center">
					<span class="toptext"><?php echo $top_notification; ?></span>
				</div>
			</div>	
			<?php } ?>
			<ul class="slides <?php echo $numSlides ?>">
				<?php $i=0; foreach ($flexslider as $row) { 
					$is_video = ( isset($row['video']) && $row['video'] ) ? $row['video'] : '';
					$slideType = ($is_video) ? 'type-video':'type-image';
					$featuredType = ( isset($row['video_or_image']) && $row['video_or_image'] ) ? $row['video_or_image'] : ''; 
					$placeThumb = $row['placeholder']; ?>
					<?php if( $featuredType=='video' && ($row['video']||$row['native_video']) ) { ?>
						<li class="slideItem <?php echo $slideType; ?>">
							<div class="iframe-wrapper <?php echo ($row['mobile_video']||$row['mobile_image'])?'yes-mobile':'no-mobile';?>">
		                            <?php if($row['link']):?>
								    <a href="<?php echo $row['link']; ?>" class="slideLink" <?php if ( $row['target'] ):echo 'target="_blank"'; endif; ?>></a>
								<?php endif;?>
									<?php if($row['native_video']):?>
										<video class="desktop" autoPlay loop muted playsinline poster="<?php echo $placeThumb['url']; ?>">
											<source src="<?php echo $row['native_video'];?>" type="video/mp4">
										</video>
									<?php elseif($row['video']):?>
											
										<?php 
											$videoURL = $row['video'];
											$parts = parse_url($videoURL);
											parse_str($parts['query'], $query);

											?>

											<?php if ($slidesCount==1) { ?>
												<img src="<?php echo $videoHelper ?>" alt="" aria-hidden="true" class="image-size-ref-helper">	
												<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" class="image-helper-mobile">	
											<?php } else { ?>
												<?php if ( isset($firstImg[0]) && $firstImg[0] ) { ?>
													<img src="<?php echo $firstImg[0] ?>" alt="" class="image-size-ref uploadedImg">	
												<?php } else { ?>
													<img src="<?php echo $placeholder; ?>" alt="" aria-hidden="true" class="blank-image image-size-ref">
												<?php } ?>
											<?php } ?>

											<?php /* YOUTUBE VIDEO */ ?>
											<?php if (strpos( strtolower($videoURL), 'youtube.com') !== false) {
												$youtubeId = '';

												/* if iframe */
												if (strpos( strtolower($videoURL), 'youtube.com/embed') !== false) {
													$parts = extractURLFromString($videoURL);
													$youtubeId = basename($parts);
												} else {
													$youtubeId = (isset($query['v']) && $query['v']) ? $query['v']:''; 
												}

												if($youtubeId) {
													$embed_url = 'https://www.youtube.com/embed/'.$youtubeId.'?version=3&rel=0&loop=0';	
													$mainImage = 'https://i.ytimg.com/vi/'.$youtubeId.'/maxresdefault.jpg'
													?>
													<div class="outer-video-wrap">
														<div class="videoIframeDiv video-youtube video__youtube" style="background-image:url('<?php echo $mainImage?>');">
															<div id="playYoutube" class="playButtonDiv">
																<a href="#" data-type="youtube" class="playVidBtn" data-embed="<?php echo $embed_url; ?>"><span>Play</span></a>
															</div>
															<iframe class="videoIframe iframe-youtube" data-vid="youtube" src="<?php echo $embed_url; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
															<?php if (isset($row['slide_text']) && $row['slide_text']) { ?>
															<div class="slideCaption"><div class="text"><?php echo $row['slide_text'] ?></div></div>
															<?php } ?>
														</div>
													</div>
												<?php }  ?>
											<?php }  ?>

											<?php /* VIMEO VIDEO */ ?>
											<?php if( strpos( strtolower($videoURL), 'vimeo.com') !== false ) { 
												$vimeo_parts = explode("/",$videoURL);
												$parts = ($vimeo_parts && array_filter($vimeo_parts) ) ? array_filter($vimeo_parts) : '';
												$vimeoId = ($parts) ?  preg_replace('/\s+/', '', end($parts)) : '';
												$vimeoData = ($vimeoId) ? get_vimeo_data($vimeoId) : '';
												$data = json_decode( file_get_contents( 'https://vimeo.com/api/oembed.json?url=' . $videoURL ) );
												$vimeoImage = ($data) ? $data->thumbnail_url : '';
												?>
												<div class="outer-video-wrap">
													<div class="videoIframeDiv video-vimeo video__vimeo" data-id="<?php echo $vimeoId ?>" data-url="<?php echo $videoURL ?>">
														<div id="playVimeo" class="playButtonDiv">
															<a href="#" data-type="vimeo" class="playVidBtn" data-embed=""><span>Play</span></a>
														</div>
														<iframe class="videoIframe iframe-vimeo" data-vid="vimeo" src="https://player.vimeo.com/video/<?php echo $vimeoId?>" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
														<?php if (isset($row['slide_text']) && $row['slide_text']) { ?>
														<div class="slideCaption"><div class="text"><?php echo $row['slide_text'] ?></div></div>
														<?php } ?>
													</div>
												</div>
											<?php } ?>
									
									<?php endif;
									if($row['mobile_video']):?>
										<video class="mobile" autoPlay loop muted playsinline poster="<?php echo $placeThumb['url']; ?>">
											<source src="<?php echo $row['mobile_video'];?>" type="video/mp4">
										</video>
									<?php elseif($row['mobile_image']):?>
										<img class="mobile <?php if($i!==0) echo 'lazy';?>" <?php if($i!==0) echo 'data-';?>src="<?php echo $row['mobile_image']['url']; ?>"
												alt="<?php echo $row['mobile_image']['alt']; ?>">
									<?php endif;?> 
							</div><!--.iframe-wrapper-->
						</li>
					<?php } 
					elseif($featuredType=='image' && $row['image']) { ?>
					<li class="slideItem <?php echo $slideType; ?>">
						<div class="image-wrapper <?php echo $row['mobile_image']?'yes-mobile':'no-mobile';?>"
						     style="background-image: url(<?php if($row['mobile_image']):
							     echo $row['mobile_image']['url'];
						     else:
	                                 echo $row['image']['url'];
						     endif;?>);">
	                            <?php if($row['link']):?>
							    <a href="<?php echo $row['link']; ?>" class="slideLink" <?php if ( $row['target'] ):echo 'target="_blank"'; endif; ?>>
							<?php endif;?>
	                                    <img class="desktop <?php if($i!==0) echo 'lazy';?>" <?php if($i!==0) echo 'data-';?>src="<?php echo $row['image']['url']; ?>"
								     alt="<?php echo $row['image']['alt']; ?>">
	                                    <?php if($row['mobile_image']):?>
	                                        <img class="mobile <?php if($i!==0) echo 'lazy';?>" <?php if($i!==0) echo 'data-';?>src="<?php echo $row['mobile_image']['url']; ?>"
	                                             alt="<?php echo $row['mobile_image']['alt']; ?>">
	                                    <?php endif;?>
	                            <?php if($row['link']):?>
							    </a>
	                            <?php endif;?>
						</div><!--.image-wrapper-->
						<?php if ( isset($row['slide_text']) && $row['slide_text'] ) { ?>
						<div class="slideCaption"><div class="text"><?php echo $row['slide_text'] ?></div></div>
						<?php } ?>
					</li>
					<?php } ?>
				<?php $i++; } ?>
			</ul>

		</div>
	</div>
	<?php } else { ?>
	<div class="no-banner-spacer"></div>
	<?php } ?>

<?php } ?>