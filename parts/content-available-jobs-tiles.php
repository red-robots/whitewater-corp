<?php
$placeholder = THEMEURI . 'images/rectangle.png';

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
$taxonomy = 'department';
$Eterms = get_terms( array(
    'taxonomy' => $taxonomy,
    'hide_empty' => false,
) );

$posts = new WP_Query($args);
if( $posts->have_posts() ) { ?>
	<section id="section-activities" data-section="<?php echo $title4 ?>" class="section-content camp-activities activities-parent-page">
			<?php if ($title4) { ?>
			<div class="shead-icon text-center">
				<div class="icon"><span class="ci-nametag"></span></div>
				<h2 class="stitle"><?php echo $title4 ?></h2>
			</div>
			<?php } ?>

			


		<div class="entryList flexwrap">
		<!-- <div class="entries-inner wrapper text-center"> -->


			


			<?php 

			
			// echo '<pre>';
			// print_r($terms);
			// echo '</pre>';
			$i = 0;
			foreach( $Eterms as $t ) { 
				$i++;
				//$img = ( $images && isset($images[0]) ) ? $images[0] : '';
				$thumbnail = get_field('tile_image', $taxonomy . '_' . $t->term_id);
				$img = ( $thumbnail && isset($thumbnail['url']) ) ? $thumbnail['url'] : '';
				$thumbnail = $img;
				// echo '<pre>';
				// print_r($thumbnail);
				// echo '</pre>';
			?>
				
					<div id="entryBlock<?php echo $i; ?>" class="fbox <?php echo 'hasImage'; ?>">
						<div class="inside text-center">
							<div class="imagediv <?php echo 'hasImage'; ?>">
								<a href=".<?php echo $t->slug; ?>" class="link inline">
									<?php if ($thumbnail) { ?>
										<span class="img" style="background-image:url('<?php echo $thumbnail; ?>')"></span>
									<?php } ?>
									<img src="<?php echo $placeholder; ?>" alt="" aria-hidden="true" class="placeholder">
								</a>
							</div>
							<div class="titlediv">
								<p class="name"><?php echo $t->name; ?></p>
								<div class="buttondiv">
									<a href=".<?php echo $t->slug; ?>" class="inline btn-sm xs"><span>Learn More</span></a>
								</div>
							</div>
						</div>
					</div>
				
			<?php } ?>
			</div>


			<?php foreach( $Eterms as $t ) {  
					$tDesc = term_description($t->term_id);
					$gallery = get_field('gallery', $taxonomy . '_' . $t->term_id);
					// echo '<pre>';
					// print_r($gallery);
					// echo '</pre>';
				?>
			<div style="display: none;">
				<div class="jobs-pop <?php echo $t->slug; ?>">
					<?php if($gallery) { ?>
						<div class="popslide-cont">
							<div class="pop-flexslider flexslider">
								<ul class="slides">
									<?php foreach( $gallery as $g ) { ?>
										<li><img 
											src="<?php echo $g['sizes']['medium_large']; ?>" 
											width="<?php echo $g['sizes']['medium_large-width']; ?>" 
											height="<?php echo $g['sizes']['medium_large-height']; ?>"></li>
									<?php } ?>
								</ul>
							</div>
						</div>	
					<?php } ?>
					<div class="content">
						<h2><?php echo $t->name; ?></h2>
						<?php if($tDesc ){ ?><p><?php echo $tDesc; ?></p><?php } ?>
						<h3>Available Jobs</h3>
						<?php  
							$args = array(
							'post_type' => 'job',
							'posts_per_page' => -1,
							'tax_query' => array(
								array(
									'taxonomy' => $taxonomy,
									'field'    => 'slug',
									'terms'    => $t->slug,
								),
							),
						);
						$query = new WP_Query( $args );
						if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
						<?php endwhile; endif; ?>
					</div>
					
				</div>
			</div>
			<?php 
			// echo '<pre>';
			// 	print_r($jobbers);
			// 	echo '</pre>'; 
			?>
			<?php } ?>

			<?php include(locate_template('parts/job-benefits.php')); ?>



			<?php /* Entries */ ?>
			<div class="post-type-entries columns3 <?php echo $postype ?>">
				<div class="wrapper">
					<div id="data-container">
						<div class="posts-inner">
							
							<div class="flex-inner">
								<?php if ($postsByDepartment) { ?>
									
									<?php foreach ($postsByDepartment as $p) {
										// echo '<pre>';
										// print_r($p);
										// echo '</pre>';
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
												<!-- <div class="depart-desc"><?php echo $desc; ?></div> -->
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
		<!-- </div> -->
	</section>
<?php } ?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		 $("#tabs a").on("click",function(e){
		    e.preventDefault();
		    var panel = $(this).attr('data-rel');
		    $("#tabs li").not(this).removeClass('active');
		    $(this).parents("li").addClass('active');
		    if( $(panel).length ) {
		      $(".info-panel").not(panel).removeClass('active');
		      $(".info-panel").not(panel).find('.info-inner').removeClass('fadeIn');
		      $(panel).addClass('active');
		      //$(panel).find('.info-inner').addClass('fadeIn').slideToggle();
		      $(panel).find('.info-inner').toggleClass('fadeIn');
		    }
		  });

	  $(".info-title").on("click",function(e){
	    var parent = $(this).parents('.info-panel');
	    var parent_id = parent.attr("id");
	    $("#tabs li").removeClass('active');
	    $('.info-panel').not(parent).find('.info-inner').hide();
	    $('.info-panel').not(parent).removeClass('active');
	    parent.find('.info-inner').toggleClass('fadeIn').slideToggle();
	    if( parent.hasClass('active') ) {
	      parent.removeClass('active');
	      $('#tabs a[data-rel="#'+parent_id+'"]').parents('li').removeClass('active');
	    } else {
	      parent.addClass('active');
	      $('#tabs a[data-rel="#'+parent_id+'"]').parents('li').addClass('active');
	    }

	  });

  });	

</script>