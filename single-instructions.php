<?php
get_header(); 
$passport = ''; // reset variable
$post_type = get_post_type();
$post_id = get_the_ID();
$heroImage = get_field("full_image");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
$terms = get_the_terms($post_id,"instructions-template");
$template = ($terms) ? $terms[0]->slug : 'default';
$register = get_field("registration_link");
$registerBtn = ( isset($register['title']) && $register['title'] ) ? $register['title'] : 'Register';
$registerLink = ( isset($register['url']) && $register['url'] ) ? $register['url'] : '';
$regiserTarget = ( isset($register['target']) && $register['target'] ) ? $register['target'] : '_self';

$passport = get_field('passport_btn');
$passLabel = get_field('passport_label');
$idArray = array('40','41','42','43','53','54','55','56','57','58','59');
if( $passport == 'all' ) {
	$pp = 'data-accesso-launch';
} elseif(in_array($passport, $idArray )) {
	$pp = 'data-accesso-package="'.$passport.'"';
} else {
	$pp = 'data-accesso-keyword="'.$passport.'"';
}


if($registerLink) {
	if($regiserTarget=='_self') {
		$plink = parse_external_url($registerLink);
		$regiserTarget = $plink['target'];
	}
}
?>
<?php if($passport) { ?>
	<div class="outer-banner-wrap">
		<div class="top">
			<a <?php if($passport){echo $pp;} ?> href="#" class="button-arrow">
				<span><?php if($passLabel){echo $passLabel;}else{echo 'REGISTER';} ?></span>
			</a>
		</div>
		<?php get_template_part("parts/single-banner"); ?>
	</div>
<?php } else { ?>
<?php if ($registerLink) { ?>
	<div class="outer-banner-wrap">
		<div class="top">
			<a href="<?php echo $registerLink ?>" target="<?php echo $regiserTarget ?>" class="button-arrow">
				<span><?php echo $registerBtn ?></span>
			</a>
		</div>
		<?php get_template_part("parts/single-banner"); ?>
	</div>	
<?php } else { ?>
<?php get_template_part("parts/single-banner"); ?>
<?php } ?>
<?php } ?>
<div id="primary" class="content-area-full content-default <?php echo $has_banner;?> temp-<?php echo $template;?>">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<section class="text-centered-section full">
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

			<?php get_template_part("parts/instructions-".$template); ?>

		<?php endwhile; ?>

		
		<?php  /* FAQ */ 
			$customFAQTitle = 'FAQ';
			include( locate_template('parts/content-faqs.php') ); 
		?>

	</main>
</div><!-- #primary -->


<?php get_template_part("parts/similar-posts"); ?>


<script type="text/javascript">
jQuery(document).ready(function($){
	if( $('.loop').length>0 ) {
		$('.loop').owlCarousel({
	    center: true,
	    items:2,
	    nav: true,
	    loop:true,
	    margin:12,
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
	}
});
</script>
<?php
include( locate_template('inc/pagetabs-script.php') ); 
include( locate_template('inc/faqs.php') );  
get_footer();
