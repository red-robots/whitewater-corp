<?php
$blank_image = THEMEURI . "images/square.png";
$square = THEMEURI . "images/square.png";
$rectangle = THEMEURI . "images/rectangle-lg.png";
$canceledImage = THEMEURI . "images/canceled.svg";
$portrait_spacer = THEMEURI . "images/portrait.png";






function get_race_posts() {
  $url = 'https://center.whitewater.org/wp-json/wp/v2/race?per_page=99';
  $response = wp_remote_get($url);
  if ( is_wp_error( $response ) ) {
    return false;
  }
  $posts = json_decode( wp_remote_retrieve_body( $response ), true );



// echo '<pre>';
// print_r($posts);
// echo '</pre>';


  $race_posts = array();
  foreach ($posts as $post) {
    $race_post = array(
		'title' => $post['title']['rendered'],
		'pagelink' => $post['link'],
		'locationname' => $post['acf']['eventlocation_text'],
		'start' => $post['acf']['start_date'],
		'end' => $post['acf']['end_date'],
		'hidePostfromMainPage' => $post['acf']['hidePostfromMainPage'],
		'event_date' => $event_date,
		'short_description' => $short_description,
		'eventStatus' => ( $post['acf']['eventstatus'] ) ? $post['acf']['eventstatus']:'upcoming',
		'thumbImage' => $post['acf']['thumbnail_image'],
		'eventlocation' => array(),
		'terms' => array(),
		'loc_terms' => array(),
    );

    // Get terms. Need to find a better way to do this.
    if( in_array(28, $post['activity_type']) ){ $race_post['terms'][] = 'mountain-biking'; }
    if( in_array(27, $post['activity_type']) ){ $race_post['terms'][] = 'climbing'; }
    if( in_array(47, $post['activity_type']) ){ $race_post['terms'][] = 'running'; }
    if( in_array(82, $post['activity_type']) ){ $race_post['terms'][] = 'deep-water-solo'; }
    if( in_array(159, $post['activity_type']) ){ $race_post['terms'][] = 'ice-skating'; }
    if( in_array(25, $post['activity_type']) ){ $race_post['terms'][] = 'kayaking'; }
    if( in_array(85, $post['activity_type']) ){ $race_post['terms'][] = 'mtb-adventure-race'; }
    if( in_array(83, $post['activity_type']) ){ $race_post['terms'][] = 'open-water-swim'; }
    if( in_array(24, $post['activity_type']) ){ $race_post['terms'][] = 'rafting'; }
    if( in_array(195, $post['activity_type']) ){ $race_post['terms'][] = 'road-cycling'; }
    if( in_array(84, $post['activity_type']) ){ $race_post['terms'][] = 'stand-up-paddleboard'; }
    if( in_array(86, $post['activity_type']) ){ $race_post['terms'][] = 'triathlon'; }
    if( in_array(26, $post['activity_type']) ){ $race_post['terms'][] = 'yoga'; }
    
	if (!empty($post['acf']['eventlocation'])) {
    	foreach( $post['acf']['eventlocation'] as $rl ){
    		$race_post['eventlocation'][] = array(
		        'value' => $rl['value'], // Store the location value
		        'label' => $rl['label'] // Store the location label
		      );
    	}
	}

	// foreach ($race_post['eventlocation'] as $location) {
 //      if ($location['value'] === 'pisgah') {
 //        $race_posts[] = $race_post;
 //        // break;
 //      }
 //    }

	if( empty($post['acf']['hidePostfromMainPage']) ) {
	    $race_posts[] = $race_post;
	}

  }
  return $race_posts;
}

$races = get_race_posts();


// echo '<pre>';
// print_r($races);
// echo '</pre>';

$i=1; 
?>

	<div id="form-ui" class="filter-wrapper">
			<div class="wrapper">
				
				<div class="filter-inner">
					<div class="flexwrap">
						<div class="select-wrap">
							<label>Status</label>
							<div class="facetwp-facet facetwp-facet-race_event_status facetwp-type-fselect" data-type="fselect">
								<div class="fs-wrap multiple fs-rest ">
									<div class="fs-label-wrap">
										<div class="fs-label">Any</div>
										<span class="fs-arrow"></span>
									</div>
									<div class="fs-dropdown fs-hidden">
										<div class="fs-options">
											<div class="fs-option">
												<label class="chexbox">
													<input type="checkbox" value="*" /> All
												</label>
											</div>
											<div class="fs-option">
												<label class="chexbox">
													<input type="checkbox" value=".completed" /> Completed
												</label>
											</div>
											<div class="fs-option">
												<label class="chexbox">
													<input type="checkbox" value=".upcoming" /> Upcoming
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						

						<?php if ( do_shortcode('[facetwp facet="race_series_discipline"]') ) { 

								// for now keep this. It loads the fselect.css file.

						 } ?>
						<?php 
						$zurl = 'https://center.whitewater.org/wp-json/wp/v2/activity_type';

						$zresponse = wp_remote_get($zurl);

						if (is_array($zresponse) && !is_wp_error($zresponse)) {
						    $zterms = json_decode(wp_remote_retrieve_body($zresponse)); ?>
						<div class="select-wrap">
							<label>Discipline</label>
							<div class="facetwp-facet facetwp-facet-race_event_status facetwp-type-fselect" data-type="fselect">
								<div class="fs-wrap multiple fs-rest ">
									<div class="fs-label-wrap">
										<div class="fs-label">Any</div>
										<span class="fs-arrow"></span>
									</div>
									<div class="fs-dropdown fs-hidden">
										<div class="fs-options">
											<?php foreach ($zterms as $zterm) { ?>
											<div class="fs-option">
												<label class="chexbox">
													<input type="checkbox" value=".<?php  echo $zterm->slug; ?>" /> <?php  echo $zterm->name; ?>
												</label>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						

						<!-- <div id="resetBtn" class="select-reset-wrap <?php //echo ($has_filter) ? '':'hide'; ?>">
							<a href="<?php //echo get_permalink(); ?>" class="resetpage">Reset</a>
						</div> -->
						<!-- <button onclick="FWP.reset()" class="resetBtn jobs"><span>Reset</span></button> -->
					</div>
				</div>

			</div>
		</div>

	<div class="post-type-entries <?php echo $postype ?>">
		<div id="data-container">
			<div class="posts-inner animate__animated animate__fadeIn">
				<div id="rest-isotope" class="flex-inner result countItems<?php echo $totalFound?>">
					
					<?php 
					function sort_events($races) {
					    usort($races, function($a, $b) {
					        if ($a['eventStatus'] === $b['eventStatus']) {
					            if ($a['eventStatus'] === 'upcoming') {
					                return strtotime($a['start']) - strtotime($b['start']);
					            } elseif ($a['eventStatus'] === 'completed') {
					                return strtotime($b['start']) - strtotime($a['start']);
					            }
					        } else {
					            if ($a['eventStatus'] === 'upcoming') {
					                return -1;
					            } elseif ($b['eventStatus'] === 'upcoming') {
					                return 1;
					            }
					        }
					    });
					    return $races;
					}

					$sorted_events = sort_events($races);
					
			    ?>

		      <?php 
		      foreach ($sorted_events as $event) {
		      	
      				$p = $event['pID'];
					$title = $event['title'];
					$pagelink = $event['pagelink'];
					$locationname = $event['locationname'];
					$start = $event['start'];
					$end = $event['end'];
					$event_date = get_event_date_range($start, $end);
					$short_description = get_field("short_description",$id);
					$eventStatus = (isset($event['eventStatus']) && $event['eventStatus']) ? $event['eventStatus']:'upcoming';
					$thumbImage = $event['thumbImage'];
					$main_event_date = get_field("main_event_date",$id);
					$aT = $event['terms'];
							
							?>
							<div id="post-<?php echo $id?>" class="item rest postbox <?php echo ($thumbImage) ? 'has-image':'no-image' ?> <?php echo $eventStatus ?> <?php echo implode(" ", $aT); ?>" data-filter="">
								<div class="inside">
									<?php if ($eventStatus=='completed') { ?>
										<div class="event-completed"><span>Event Complete</span></div>
									<?php } ?>
									<div class="linkwrap js-blocksz">
										<a href="<?php echo $pagelink ?>" class="photo wave-effect js-blocksz">
											<?php if ($thumbImage) { ?>
												<!-- <div class="imagediv" style="background-image:url('<?php //echo $thumbImage['sizes']['medium_large'] ?>')"></div> -->
												<img src="<?php echo $thumbImage['url']; ?>" alt="<?php echo $thumbImage['title'] ?>" class="feat-img" style="visibility:visible;">
											<?php } else { ?>
												<div class="imagediv"></div>
												<img src="<?php echo $blank_image ?>" alt="" class="feat-img placeholder">
											<?php } ?>
											<span class="boxTitle">
												<span class="twrap">
													<span class="t1"><?php echo $title ?></span>
													<?php if ($event_date) { ?>
													<span class="t2"><?php echo $event_date ?></span>
													<?php } ?>
												</span>
											</span>
											
											<?php get_template_part('parts/wave-SVG'); ?>

											<?php if ($eventStatus=='canceled') { ?>
											<span class="canceledStat">
												<img src="<?php echo $canceledImage ?>" alt="" aria-hidden="true">
											</span>	
											<?php } ?>
										</a>
										<img src="<?php echo $portrait_spacer; ?>" alt="" aria-hidden="true" class="rectangle-spacer">
									</div>
									<div class="details">
										<div class="info">
											<h3 class="event-name js-title"><?php echo $title ?></h3>
											<?php if ($event_date) { ?>
											<div class="event-date"><?php echo $event_date ?></div>
											<?php } ?>
											<?php if ($short_description) { ?>
											<div class="short-description"><?php echo $short_description; ?></div>	
											<?php } ?>
											<div class="race-location">
												<div class="map">
													<img src="<?php bloginfo('template_url'); ?>/images/map.png">
												</div>
												<div class="location">
													<?php echo $locationname; ?>
												</div>
											</div>
											<div class="button">
												<a href="<?php echo $pagelink ?>" class="btn-sm"><span>See Details</span></a>
											</div>
										</div>
									</div>

									<?php if( is_user_logged_in() && current_user_can('administrator') ) {
												$editLink = get_edit_post_link($id); ?>
									<div class="editpostlink"><a href="<?php echo $editLink ?>">Edit</a></div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
		      <?php //} ?>

				</div>
			</div>
		</div>
	</div>






