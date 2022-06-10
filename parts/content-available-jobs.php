<?php
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
						// echo '<pre>';
						// print_r($term);
						// echo '</pre>';
						$term_id = $term->term_id;
						$term_name = $term->name;
						$desc = $term->description;
						$postsByDepartment[$term_id]['department'] = $term_name;
						$postsByDepartment[$term_id]['entries'][] = $e;
						$postsByDepartment[$term_id]['description'] = $desc;
					}
				}
			}
		}
	}


$posts = new WP_Query($args);
if( $posts->have_posts() ) { ?>
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

			<?php /* Filter Options */ ?>
			<div class="filter-wrapper filterstyle optionsnum3">
				<div id="filterWap" class="wrapper">
					
					<div class="filter-inner">
						<div class="flexwrap">

							<div class="filter-label">
								<div class="inside"><span>Filter By</span></div>
							</div>

							<?php if ( do_shortcode('[facetwp facet="job_locations"]') ) { ?>
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
							<?php } ?>

							<button onclick="FWP.reset()" class="resetBtn jobs"><span>Reset</span></button>

						</div>
					</div>
				</div>
			</div>

			<?php /* Entries */ ?>
			<div class="post-type-entries columns3 <?php echo $postype ?>">
				<div class="wrapper">
					<div id="data-container">
						<div class="posts-inner">
							
							<div class="flex-inner">
								<?php if ($postsByDepartment) { ?>
									
									<?php foreach ($postsByDepartment as $p) {
										
										$department = $p['department'];
										$desc = $p['description'];
										$entries = $p['entries'];
										// echo '<pre>';
										// print_r($postsByDepartment);
										// echo '</pre>';
										if($entries) { ?>
										<div class="job-group">
											<div class="job-department"><span><?php echo $department ?></span></div>
											<?php if($desc){ ?>
												<div class="depart-desc"><?php echo $desc; ?></div>
											<?php } ?>
											<?php foreach($entries as $e) { 
											$pid = $e->ID; 
											$title = $e->post_title;
											$link = get_permalink($pid); 
											$locations = get_the_terms($pid,'joblocation');
											$jobtypes = get_the_terms($pid,'jobtype');
											$jobLocation = '';
											$jobTypesList = '';
											if($locations) {
												$i=1;
												foreach($locations as $loc) {
													$comma = ($i>1) ? ', ':'';
													$jobLocation .= $comma . $loc->name;
													$i++;
												}
											}
											if($countLocation>1) {
												
											} else {
												$jobLocation = '';
											}
											// if($jobtypes) {
											// 	$j=1;
											// 	foreach($jobtypes as $jt) {
											// 		$comma = ($j>1) ? ', ':'';
											// 		$jobTypesList .= $comma . $jt->name;
											// 		$j++;
											// 	}
											// }
											
											// if($job_type) {
											// 	if($jobTypesList) {
											// 		$jobTypesList = $jobTypesList . ' &ndash; ';
											// 	}
											// } else {
											// 	$jobTypesList = '';
											// }
											?>
											<div class="joblist show">
												<a href="<?php echo $link ?>"><?php echo $title; ?></a>
												<?php if ($jobLocation) { ?>
												<div class="loc">(<?php echo $jobTypesList . $jobLocation ?>)</div>	
												<?php } ?>
											</div>	
											<?php } ?>
										</div>
										<?php } ?>
									<?php } ?>

									<?php $i=1; while ( $posts->have_posts()) : $posts->the_post(); ?>
										<div class="hide" style="display:none;"><?php echo get_the_title(); ?></div>
									<?php $i++; endwhile; wp_reset_postdata(); ?>

								<?php } ?>

								<?php 
								if( $posts->have_posts() ) {
									$i=1; while ( $posts->have_posts()) : $posts->the_post(); ?>
										<div class="hide" style="display:none;"><?php echo get_the_title(); ?></div>
									<?php $i++; endwhile; wp_reset_postdata(); 
								} ?>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</section>
<?php } ?>