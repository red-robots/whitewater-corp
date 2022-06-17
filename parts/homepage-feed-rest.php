<?php 
// foreach( $feed_type as $ft ) {
// 	$type = $ft;
// 	if($type=='events'){$type='festival';}
// }
// foreach( $feed_source as $fs ) {
// 	$source = $fs;

// }
$type = $feed_type;
$source = $feed_source;
$response = wp_remote_get( 'https://'.$source.'.whitewater.org/wp-json/wp/v2/'.$type.'?per_page=6' );
//$response = 'https://'.$source.'.whitewater.org/wp-json/wp/v2/'.$type.'?per_page=6' ;
// echo $response;

if( is_array($response) ) :
    $code = wp_remote_retrieve_response_code( $response );
    if(!empty($code) && intval(substr($code,0,1))===2): 
        $body = json_decode(wp_remote_retrieve_body( $response),true); ?>
		    <div class="featured-events-section full">
				<div class="wrapper-full">
					<div class="flexwrap">
					<?php 
					$i = 1; 
			    	foreach( $body as $post ):
			    		// echo '<pre style="background-color:#fff;">';
				    	// print_r($post);
				    	// echo '</pre>';
			    		$rectangle = get_bloginfo('template_url') . '/images/rectangle-narrow.png';
						$square = get_bloginfo('template_url') . '/images/square.png';
						$dateNow = date('Y-m-d');
						$pid = $post['id'];
						$pType = $post['type'];
						$title = $post['title']['rendered'];
						$pagelink = $post['link'];
						$thumbImage = $post['acf']['thumbnail_image']['url'];
						$mobileBannerImg = $post['acf']['mobile-banner']['url'];
						// $mobileImage2 = $post['id'];

						$mobileThumbURL = '';
						$mobileThumbALT = '';
						if($mobileBannerImg) {
							$mobileThumbURL = $post['acf']['mobile-banner']['url'];
							$mobileThumbALT = $post['acf']['mobile-banner']['alt'];
						} else {
							if($mobileImage2) {
								$mobileThumbURL = $mobileImage2['url'];
								$mobileThumbALT = $mobileImage2['title'];
							}
						}

						$start = $post['acf']['start_date'];
						$end = $post['acf']['end_date'];
						$event_date = get_event_date_range($start,$end);
						?>
	    					<div class="postbox view-full <?php echo ($thumbImage) ? 'has-image':'no-image' ?>">
								<a href="<?php echo $pagelink ?>" class="inside boxlink wave-effect" target="_blank">
									
									<?php if ($thumbImage) { ?>
										<div class="imagediv image-square">
											<div class="img" style="background-image:url('<?php echo $thumbImage ?>')">
												<img src="<?php echo $square ?>" alt="" class="feat-img placeholder no-image">
												<img src="<?php echo $thumbImage ?>" alt="<?php echo $thumbImage ?>" class="feat-img image-square" style="display:none!important;">
											</div>
										</div>
									<?php } else { ?>
										<div class="imagediv noImage">
											<img src="<?php echo $square ?>" alt="" class="feat-img placeholder no-image">
										</div>
									<?php } ?>

									<div class="details">
										<div class="info">
											<div class="event-name"><?php echo $title ?></div>
											<?php if ($event_date) { ?>
											<div class="event-date"><?php echo $event_date ?></div>
											<?php } ?>
										</div>
									</div>
									<span class="wave">
										<svg class="waveSvg" shape-rendering="auto" preserveAspectRatio="none" viewBox="0 24 150 28" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path id="a" d="m-160 44c30 0 58-18 88-18s58 18 88 18 58-18 88-18 58 18 88 18v44h-352z"/></defs><g class="waveAnimation"><use x="85" y="5" xlink:href="#a"/></g></svg>
									</span>
								</a>
							</div>
	    			<?php endforeach; ?>
					</div>
				</div>
			</div>
	<?php endif; ?>
<?php endif; ?>
