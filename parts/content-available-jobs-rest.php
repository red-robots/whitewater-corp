<?php


// Job Type "jobtype"
// - Full time = 51
// - Part time = 48

// Job Locations "joblocation"
// - Charlotte = 50

// Job Departments "department"
// - Administration = 52
// - Facilities = 55
// - Food & Beverage = 54
// - Guest Services = 53
// - Outdoor Activities = 49
// - Water Sports = 95
$Administration = array();
$Facilities = array();
$Food = array();
$Guest = array();
$Outdoor = array();
$Water = array();



// $response = wp_remote_get( 'https://whitewater.org/wp-json/wp/v2/job?per_page=100&jobtype=51' );
$response = wp_remote_get( 'https://whitewater.org/wp-json/wp/v2/job?per_page=100' );
// echo '<pre style="background-color: #fff;">';
// print_r($response);
// echo '<?pre>';
        if( is_array($response) ) :
            $code = wp_remote_retrieve_response_code( $response );
            if(!empty($code) && intval(substr($code,0,1))===2): 
                $body = json_decode(wp_remote_retrieve_body( $response),true);

   //          echo '<pre style="background-color: #fff;">';
			// print_r($body);
			// echo '<?pre>';
$count = 0;

            foreach ($body as $post) :

            	if( $post['department']['0'] == '52' ) {
            		$Administration[] = $post;
            	} elseif( $post['department']['0'] == '55' ) {
            		$Facilities[] = $post;
            	} elseif( $post['department']['0'] == '54' ) {
            		$Food[] = $post;
            	} elseif( $post['department']['0'] == '53' ) {
            		$Guest[] = $post;
            	} elseif( $post['department']['0'] == '49' ) {
            		$Outdoor[] = $post;
            	} elseif( $post['department']['0'] == '95' ) {
            		$Water[] = $post;
            	} 
					// $thumbId = get_post_thumbnail_id(); 
					// $featImg = wp_get_attachment_image_src($thumbId,'large');
					// $featImg = $post['fimg_url'];
					// // $featThumb = wp_get_attachment_image_src($thumbId,'thumbnail');
					// $featThumb = $post['acf']['image']['url'];

					// $content = $post['content'];
					// $title = $post['title']['rendered'];
					// $divclass = (($content || $title) && $featImg) ? 'half':'full';
					// $pagelink = $post['link'];

					

					//echo '<li>'.$title.'</li>';

			endforeach;
			// echo $count;
endif;endif;



	$defaultLocation = get_default_job_location();
	$title4 = get_field("title4");
	$canceledImage = THEMEURI . "images/canceled.svg";
	$filter_message = get_field("filter_message");
	$postype = 'job';
	$job_location = ( isset($_GET['_job_locations']) && $_GET['_job_locations'] ) ? explode(",",$_GET['_job_locations']) : $defaultLocation;
	$job_type = ( isset($_GET['_job_types']) && $_GET['_job_types'] ) ? explode(",",$_GET['_job_types']):'';
	$job_department = ( isset($_GET['_job_department']) && $_GET['_job_department'] ) ? explode(",",$_GET['_job_department']):'';
	$tax_query = array();
	$postsByDepartment = array();
	$countLocation = ($job_location && is_array($job_location)) ? count($job_location) : 0;


	if($job_location) {
		$tax_query[] = array(
			'taxonomy' => 'joblocation',
			'field' => 'slug',
			'terms' => $job_location,
			'operator' => 'IN'
    );
	}
	if($job_type) {
		$tax_query[] = array(
			'taxonomy' => 'jobtype',
			'field' => 'slug',
			'terms' => $job_type,
			'operator' => 'IN'
    );
	}
	if($job_department) {
		$tax_query[] = array(
			'taxonomy' => 'department',
			'field' => 'slug',
			'terms' => $job_department,
			'operator' => 'IN'
    );
	}

	$count_query = ($tax_query) ? count($tax_query):0;
	if($count_query>1) {
		$tax_query['relation'] = 'OR';
	}

	$per_page = ($tax_query) ? -1 : 1;
	$args = array(
		'posts_per_page'	=> $per_page,
		'post_type'				=> $postype,
		'post_status'			=> 'publish',
		'facetwp'					=> true
	);

	if($tax_query) {
		$args['tax_query'] = $tax_query;
		$entries = get_posts($args);
		
		if($entries) {
			foreach($entries as $e) {
				$id = $e->ID;
				$terms = get_the_terms($e,'department');
				if($terms) {
					foreach($terms as $term) {
						$term_id = $term->term_id;
						$term_name = $term->name;
						$postsByDepartment[$term_id]['department'] = $term_name;
						$postsByDepartment[$term_id]['entries'][] = $e;
					}
				}
			}
		}
	}


$posts = new WP_Query($args);
//if( $posts->have_posts() ) { ?>
	<section id="section4" data-section="<?php echo $title4 ?>" class="section-content entries-with-filter">
		<div class="entries-inner wrapper text-center">

			<?php if ($title4) { ?>
			<div class="shead-icon text-center">
				<div class="icon"><span class="ci-nametag"></span></div>
				<h2 class="stitle"><?php echo $title4 ?></h2>
			</div>
			<?php } ?>

			<?php if ($filter_message) { ?>
			<div class="filter-message">
				<div class="wrapper narrow">
						<div id="fm"><?php echo $filter_message ?></div>
				</div>
			</div>
			<?php } ?>

			<?php /* Filter Options */ 

					// Job Types
					// $jobType = get_terms(
				 //        array(
				 //            'taxonomy' => 'jobtype',
				 //            'hide_empty' => true
				 //        )
				 //    );
				    // Job Locations
					// $jobLocation = get_terms(
				 //        array(
				 //            'taxonomy' => 'joblocation',
				 //            'hide_empty' => true
				 //        )
				 //    );
				 //    // Departments
					// $department = get_terms(
				 //        array(
				 //            'taxonomy' => 'department',
				 //            'hide_empty' => true
				 //        )
				 //    );
				$jT = array();
				$jL = array();
				$jD = array();
				// Job Types
				    $jobType = wp_remote_get('https://whitewater.org/wp-json/wp/v2/jobtype');
				    if( is_array($jobType) ) :
			            $code = wp_remote_retrieve_response_code( $jobType );
				            if(!empty($code) && intval(substr($code,0,1))===2): 
				                $bodyType = json_decode(wp_remote_retrieve_body( $jobType),true);
						    	// Add to array for later
				            foreach( $body as $jobT ) {
				            	$jL['slug'] = $jobT['slug'];
				            	$jL['name'] = $jobT['name'];
				            }
					endif; endif;
					// Job Types
				    $jobLocation = wp_remote_get('https://whitewater.org/wp-json/wp/v2/joblocation');
				    if( is_array($jobLocation) ) :
			            $code = wp_remote_retrieve_response_code( $jobLocation );
				            if(!empty($code) && intval(substr($code,0,1))===2): 
				                $bodyLocation = json_decode(wp_remote_retrieve_body( $jobLocation),true);
						    	// Add to array for later
				    //         echo '<pre>';
				    // print_r($body);
				    // echo '</pre>';
				            foreach( $body as $jobT ) {
				            	$jT['slug'] = $jobT['slug'];
				            	$jT['name'] = $jobT['name'];
				            }
					endif; endif;
					// Job Types
				    $department = wp_remote_get('https://whitewater.org/wp-json/wp/v2/department');
				    if( is_array($department) ) :
			            $code = wp_remote_retrieve_response_code( $department );
				            if(!empty($code) && intval(substr($code,0,1))===2): 
				                $bodyDepartment = json_decode(wp_remote_retrieve_body( $department),true);
						    	// Add to array for later
				            // foreach( $body as $jobT ) {
				            // 	$jD['slug'] = $jobT['slug'];
				            // 	$jD['name'] = $jobT['name'];
				            // }
					endif; endif;
					

				 //    // echo $jL['slug'];
				 //    foreach( $jL as $j ) {
				 //    	echo '<< '.$j['slug'].' >>';
				 //    }

			?>
			<div class="filter-wrapper filterstyle optionsnum3">
				<div id="filterWap" class="wrapper">
					
					<div class="filter-inner">
						<div class="flexwrapfilters">

							<div class="filter-label">
								<div class="inside"><span>Filter By</span></div>
							</div>

							
							<!-- <?php if( !empty($bodyLocation) ) { ?>
								<div class="filter-group" data-filter-group="job-location">
									<div class="select-wrap-man ">
										<div class="facetwp-facet-man  facetwp-type-fselect-man">
											<select class="filters-select facetwp-dropdown-man" >
												<option value="*">Location</option>
												<?php foreach( $bodyLocation as $j ) { ?>
													<option value=".<?php echo $j['slug']; ?>"><?php echo $j['name']; ?></option>
												<?php } ?>
											</select>
										</div> 
									</div>
								</div>
							<?php } ?> -->
							<?php if( !empty($bodyType) ) { ?>
								<div class="filter-group" data-filter-group="job-type">
									<div class="select-wrap-man ">
										<div class="facetwp-facet-man  facetwp-type-fselect-man">
											<select class="filters-select facetwp-dropdown-man" >
												<option value="*">Position Type</option>
												<?php foreach( $bodyType as $j ) { ?>
													<option value=".<?php echo $j['slug']; ?>"><?php echo $j['name']; ?></option>
												<?php } ?>
											</select>
										</div> 
									</div>
								</div>
							<?php } ?>
							<!-- <?php if( !empty($bodyDepartment) ) { ?>
								<div class="filter-group" data-filter-group="job-department">
									<div class="select-wrap-man ">
										<div class="facetwp-facet-man  facetwp-type-fselect-man">
											<select class="filters-select-dept facetwp-dropdown-man" >
												<option value="*">Department</option>
												<?php foreach( $bodyDepartment as $j ) { ?>
													<option value="<?php echo $j['slug']; ?>"><?php echo $j['name']; ?></option>
												<?php } ?>
											</select>
										</div> 
									</div>
								</div>
							<?php } ?> -->

							<!-- <div class="button-group">
								<button class="is_checked">asdffdf</button>
							</div> -->


							<!-- <?php if ( do_shortcode('[facetwp facet="job_locations"]') ) { ?>
							<div class="select-wrap jobLoc">
								<?php echo do_shortcode('[facetwp facet="job_locations"]'); ?>
							</div>
							<?php } ?>

							<?php if ( do_shortcode('[facetwp facet="job_types"]') ) { ?>
							<div class="select-wrap jobType">
								<?php echo do_shortcode('[facetwp facet="job_types"]'); ?>
							</div>
							<?php } ?>

							<?php if ( do_shortcode('[facetwp facet="job_department"]') ) { ?>
							<div class="select-wrap jobDept">
								<?php echo do_shortcode('[facetwp facet="job_department"]'); ?>
							</div>
							<?php } ?> -->

							<!-- <button onclick="FWP.reset()" class="resetBtn jobs"><span>Reset</span></button> -->

						</div>
					</div>
				</div>
			</div>

			<?php /* Entries */ 
				$jobLocation = '';
				$jobTypesList = '';
				function jobtype($type) {
					$a = '';
					if($type == '51') {
						$a = 'full-time-positions';
					} elseif($type == '48') {
						$a = 'part-time-and-seasonal-positions';
					}
					return $a;
				}
				function joblocation($loc) {
					$b = '';
					if($loc == '50') {
						$b = 'charlotte';
					} //elseif($loc == '48') {
					// 	$b = 'part-time';
					// }
					return $b;
				}
				function depart($dept) {
					$c = '';
					if($dept == '52') {
						$c = 'administration';
					} elseif($dept == '55') {
						$c = 'facilities';
					} elseif($dept == '45') {
						$c = 'food-and-beverage';
					} elseif($dept == '53') {
						$c = 'guest-services';
					} elseif($dept == '49') {
						$c = 'outdoor-activities';
					} elseif($dept == '95') {
						$c = 'water-sports';
					}
					return $c;
				}
			?>
			
			<div class="post-type-entries columns3 <?php echo $postype ?> ">
				<div class="wrapper employment-grid">
					<div id="data-container">
						<div class="posts-inner">
							
							<div class="flex-inner">

								<?php if($Administration) { ?>
								<div class="job-group show-dept administration">
									<div class="job-department"><span>Administration</span></div>
									<?php 
									foreach( $Administration as $job ) { 
											$link = $job['link'];
											$title = $job['title']['rendered'];
											$type = $job['jobtype']['0'];
											$loc = $job['joblocation']['0'];
											$dept = $job['department']['0'];
											// echo '<pre style="text-align: left;">';
											// print_r($job);
											// echo '</pre>';
										?>
										<div class="joblist <?php echo jobtype($type).' '.joblocation($loc); ?>">
											<a href="<?php echo $link ?>" target="_blank"><?php echo $title; ?></a>
											<?php if ($jobLocation) { ?>
											<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
											<?php } ?>
										</div>	
									<?php } ?>
								</div>
								<?php } ?>

								<?php if($Facilities) { ?>
								<div class="job-group show-dept facilities">
									<div class="job-department"><span>Facilities</span></div>
									<?php 
									foreach( $Facilities as $job ) { 
											$link = $job['link'];
											$title = $job['title']['rendered'];
											$type = $job['jobtype']['0'];
											$loc = $job['joblocation']['0'];
											$dept = $job['department']['0'];
										?>
										<div class="joblist <?php echo jobtype($type).' '.joblocation($loc); ?>">
											<a href="<?php echo $link ?>" target="_blank"><?php echo $title; ?></a>
											<?php if ($jobLocation) { ?>
											<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
											<?php } ?>
										</div>	
									<?php } ?>
								</div>
								<?php } ?>

								<?php if($Food) { ?>
								<div class="job-group show-dept food-and-beverage">
									<div class="job-department"><span>Food & Beverage</span></div>
									<?php 
									foreach( $Food as $job ) { 
											$link = $job['link'];
											$title = $job['title']['rendered'];
											$type = $job['jobtype']['0'];
											$loc = $job['joblocation']['0'];
											$dept = $job['department']['0'];
										?>
										<div class="joblist <?php echo jobtype($type).' '.joblocation($loc); ?>">
											<a href="<?php echo $link ?>" target="_blank"><?php echo $title; ?></a>
											<?php if ($jobLocation) { ?>
											<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
											<?php } ?>
										</div>	
									<?php } ?>
								</div>
								<?php } ?>

								<?php if($Guest) { ?>
								<div class="job-group show-dept guest-services">
									<div class="job-department"><span>Guest Services</span></div>
									<?php 
									foreach( $Guest as $job ) { 
											$link = $job['link'];
											$title = $job['title']['rendered'];
											$type = $job['jobtype']['0'];
											$loc = $job['joblocation']['0'];
											$dept = $job['department']['0'];
										?>
										<div class="joblist <?php echo jobtype($type).' '.joblocation($loc); ?>">
											<a href="<?php echo $link ?>" target="_blank"><?php echo $title; ?></a>
											<?php if ($jobLocation) { ?>
											<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
											<?php } ?>
										</div>	
									<?php } ?>
								</div>
								<?php } ?>

								<?php if($Outdoor) { ?>
								<div class="job-group show-dept outdoor-activities">
									<div class="job-department"><span>Outdoor Activities</span></div>
									<?php 
									foreach( $Outdoor as $job ) { 
											$link = $job['link'];
											$title = $job['title']['rendered'];
											$type = $job['jobtype']['0'];
											$loc = $job['joblocation']['0'];
											$dept = $job['department']['0'];
										?>
										<div class="joblist <?php echo jobtype($type).' '.joblocation($loc); ?>">
											<a href="<?php echo $link ?>" target="_blank"><?php echo $title; ?></a>
											<?php if ($jobLocation) { ?>
											<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
											<?php } ?>
										</div>	
									<?php } ?>
								</div>
								<?php } ?>

								<?php if($Water) { ?>
								<div class="job-group show-dept water-sports">
									<div class="job-department"><span>Water Sports</span></div>
									<?php 
									foreach( $Water as $job ) { 
											$link = $job['link'];
											$title = $job['title']['rendered'];
											$type = $job['jobtype']['0'];
											$loc = $job['joblocation']['0'];
											$dept = $job['department']['0'];
										?>
										<div class="joblist <?php echo jobtype($type).' '.joblocation($loc).' '.depart($dept); ?>">
											<a href="<?php echo $link ?>" target="_blank"><?php echo $title; ?></a>
											<?php if ($jobLocation) { ?>
											<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
											<?php } ?>
										</div>	
									<?php } ?>
								</div>
								<?php } ?>



								

								<?php 
								if( $posts->have_posts() ) {
									$i=1; while ( $posts->have_posts()) : $posts->the_post(); ?>
										<!-- <div class="hide" style="display:none;"><?php echo get_the_title(); ?></div> -->
									<?php $i++; endwhile; wp_reset_postdata(); 
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</section>
<?php //} ?>