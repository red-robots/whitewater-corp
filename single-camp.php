<?php
$placeholder = THEMEURI . 'images/rectangle.png';
$square = THEMEURI . 'images/square.png';
$banner = get_field("full_image");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
$currentPostId = get_the_ID();

$status = get_field('registration_status');
$registerLink = get_field('registrationLink');
$regTarget = get_field('registrationLinkTarget');
$status_custom_message = get_field('status_custom_message');
$registerButton = 'Register';
$registerTarget = ( isset($regTarget[0]) && $regTarget[0]=='yes' ) ? '_blank':'_self';


$passport = get_field('passport_btn');
$passLabel = get_field('passport_label');
$idArray = array('31','32','33','34','35','36','37');
if( $passport == 'all' ) {
	$pp = 'data-accesso-launch';
} elseif(in_array($passport, $idArray )) {
	$pp = 'data-accesso-package="'.$passport.'"';
} else {
	$pp = 'data-accesso-keyword="'.$passport.'"';
}

get_header(); ?>
<div class="hero-wrapper hero-register-button">
<?php get_template_part("parts/single-banner"); ?>
<?php if ($status=='open') { ?>
	<?php if($passport) { ?>
		<div class="stats open">
			<a <?php if($passport){echo $pp;} ?> href="#" class="registerBtn">
				<?php if($passLabel){echo $passLabel;}else{echo 'REGISTER';} ?>
			</a>
		</div>
	<?php } else { ?>
		<?php if ($registerButton && $registerLink) { ?>
			<div class="stats open"><a href="<?php echo $registerLink ?>" target="<?php echo $registerTarget ?>" class="registerBtn"><?php echo $registerButton ?></a></div>
		<?php } ?>
	<?php } ?>
<?php } else if($status=='closed') { ?>
	<div class="stats closed">SOLD OUT</div>
<?php } else if($status=='custom') { ?>

	<?php if ($status_custom_message) { ?>
	<div class="stats closed custom-message-banner"><div class="innerTxt"><?php echo $status_custom_message ?></div></div>
	<?php } ?>

<?php } ?>
</div>

<div id="primary" class="content-area-full summer-camps <?php echo $has_banner ?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<section class="text-centered-section full<?php echo ($banner) ? '':' noBanner' ?>">
				<div class="wrapper text-center">
					<div class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<?php if ( get_the_content() ) { ?>
					<div class="text"><?php the_content(); ?></div>
					<?php } ?>
				</div>
			</section>


			<?php get_template_part("parts/subpage-tabs"); ?>


			<?php  
			$price = get_field("price");
			$ages = get_field("ages");
			$dates = get_field("date_range");
			$info['price'] = array('Price',$price);
			$info['ages'] = array('Ages',$ages);
			$info['dates'] = array('Dates',$dates);
			?>

			<section class="section-price-ages full">
				<div class="flexwrap">
					<?php foreach ($info as $n) { ?>
						<div class="info">
							<div class="wrap">
								<div class="label"><?php echo $n[0] ?></div>
								<div class="val"><?php echo $n[1] ?></div>
							</div>
						</div>	
					<?php } ?>
				</div>

				<?php 
				if( $galleries = get_field("gallery") ) { ?>

					<div class="flexslider swap">
						<ul class="slides">
							<?php foreach ($galleries as $g) { ?>
								<li>
									<img src="<?php echo $g['url']; ?>" alt="" aria-hidden="true" />
								</li>
							<?php } ?>
						</ul>
					</div>

				<div id="carousel-images" class="camp-caro swap">
					<div class="loop owl-carousel owl-theme">
					<?php foreach ($galleries as $g) { ?>
						<div class="item">
							<div class="image" style="background-image:url('<?php echo $g['url']?>')">
								<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
							</div>
						</div>
					<?php } ?>
					</div>
				</div>


				<?php } ?>
			</section>

			<?php 
			/* SCHEDULE */
			//$sched_title = get_field("schedule_title");
			$sched_title = "SCHEDULE";
			$schedules = get_field("schedule_items");
			if($schedules) { ?>
			<section id="section-schedule" data-section="<?php echo $sched_title ?>" class="section-content">
				<div class="wrapper">

					<?php if ($sched_title) { ?>
					<div class="shead-icon text-center">
						<div class="icon"><span class="ci-menu"></span></div>
						<h2 class="stitle"><?php echo $sched_title ?></h2>
					</div>
					<?php } ?>
					
					<div class="schedules-list">
						<ul class="items">
						<?php foreach ($schedules as $s) { ?>
							<li class="item">
								<div class="time"><?php echo $s['time'] ?></div>
								<div class="event"><?php echo $s['event'] ?></div>
							</li>
						<?php } ?>
						</ul>
					</div>

				</div>
			</section>
			<?php } ?>
			
		<?php endwhile; ?>


		<?php get_template_part("parts/camp-activities"); ?>
		<?php get_template_part('parts/single-camp-registrations'); ?>
		<?php get_template_part('parts/single-camp-additional'); ?>
		

		<?php  /* FAQ */ 
			$customFAQTitle = 'FAQ';
			include( locate_template('parts/content-faqs.php') ); 
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_template_part("parts/similar-posts"); ?>

<?php
/* EVENT SPONSORS */
$sponsor_section_title = get_field("sponsor_section_title");  
$sponsors = get_field("sponsors");  
if($sponsors) { ?>
<section id="section-sponsors" class="section-content">
	<div class="wrapper">
		<?php if ($sponsor_section_title) { ?>
		<div class="titlediv">
			<h2 class="sectionTitle text-center"><?php echo $sponsor_section_title ?></h2>
		</div>
		<?php } ?>
		
		<div class="sponsors-list">
			<div class="flexwrap">
				<?php foreach ($sponsors as $s) { 
				$link = get_field("image_website",$s['ID']);
				?>
				<span class="sponsor">
					<?php if ($link) { ?>
						<a href="<?php echo $link ?>" target="_blank"><img src="<?php echo $s['url'] ?>" alt="<?php echo $s['title'] ?>"></a>
					<?php } else { ?>
						<img src="<?php echo $s['url'] ?>" alt="<?php echo $s['title'] ?>">
					<?php } ?>
				</span>	
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<?php } ?>

<?php 
include( locate_template('inc/pagetabs-script.php') );  
include( locate_template('inc/faqs.php') );  
?>

<script type="text/javascript">
jQuery(document).ready(function($){
	$('.loop').owlCarousel({
    center: true,
    items:2,
    nav: true,
    loop:true,
    margin:15,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
      600:{
       	items:2
      },
      400:{
       	items:1
      }
    }
	});
});
</script>
<?php
get_footer();
