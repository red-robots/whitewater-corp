<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/jquery.fancybox.min.css">
<script defer src="<?php bloginfo( 'template_url' ); ?>/assets/svg-with-js/js/fontawesome-all.js"></script>

<?php if ( is_singular(array('post')) ) { 
global $post;
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post_id); 
$featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
<!-- SOCIAL MEDIA META TAGS -->
<meta name="p:domain_verify" content="e83439f2b3d98cad131ab8782461a8e2"/>
<meta name="facebook-domain-verification" content="vcbl42j06vfl4vocp07qka3fcdtyir" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:url"		content="<?php echo get_permalink(); ?>" />
<meta property="og:type"	content="article" />
<meta property="og:title"	content="<?php echo get_the_title(); ?>" />
<meta property="og:description"	content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
<?php if ($featImg) { ?>
<meta property="og:image"	content="<?php echo $featImg[0] ?>" />
<?php } ?>
<!-- end of SOCIAL MEDIA META TAGS -->
<?php } ?>
<script>
var currentURL = '<?php echo get_permalink();?>';
var params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v});
</script>

<script>!function(e,t,n,s,a,c,p,i,o,u){e[a]||((i=e[a]=function(){i.process?i.process.apply(i,arguments):i.queue.push(arguments)}).queue=[],i.pixelId="cbd42ac9-c947-41a0-a340-cc2163106c8c",i.t=1*new Date,(o=t.createElement(n)).async=1,o.src="https://found.ee/dmp/pixel.js?t="+864e5*Math.ceil(new Date/864e5),(u=t.getElementsByTagName(n)[0]).parentNode.insertBefore(o,u))}(window,document,"script",0,"foundee");foundee('', 'Y');</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-9PW6PHW0M8"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-9PW6PHW0M8');
</script>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '236370623380911');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=236370623380911&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
<?php wp_head(); ?>
</head>

<?php
$heroImage = get_field("full_image");
$postHeroImage = get_field("post_image_full");
$flexbanner = get_field("flexslider_banner");
$xBodyClass = 'pageNoBanner';
if($heroImage) {
	$xBodyClass = ($heroImage) ? 'pageHasBanner':'pageNoBannerr';
} else {
	if($flexbanner) {
		$xBodyClass = ($flexbanner) ? 'pageHasBanner':'pageNoBanner';
	}
}
if($postHeroImage) {
	$xBodyClass = ($postHeroImage) ? 'pageHasBanner':'pageNoBanner';
}
?>
<body <?php body_class($xBodyClass); ?>>

<div id="page" class="site cf">
	<div id="overlay"></div>
	<a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>

	<?php
	/* NAVIGATION */
	get_template_part("parts/navigation");
	get_template_part("parts/navigation-center");
	get_template_part("parts/navigation-pisgah");
	get_template_part("parts/navigation-santee");
	get_template_part("parts/navigation-grayson");
	?>


	

	<header id="masthead" class="site-header" role="banner">
		
		<!-- <div id="topSearchBar" class="top-search-bar">
			<div class="wrapper">
				<div class="form-wrapper">
					<?php echo get_search_form(); ?>
					<a href="#" id="topsearchBtn"><i class="fas fa-search"></i></a>
					<a href="#" id="closeTopSearch"><span>Close</span></a>
				</div>
			</div>
		</div> -->
		<div class="navbar">
			<div class="wrapper cf">
				<?php if( is_front_page() ) {?>
		            <h1 class="logo">
			            <a href="<?php bloginfo('url'); ?>">
			            	<img src="<?php bloginfo('template_url'); ?>/images/logo.png">
			            </a>
		            </h1>
		        <?php } else { ?>
		        	<div class="logo">
		            	<a href="<?php bloginfo('url'); ?>">
			            	<img src="<?php bloginfo('template_url'); ?>/images/logo.png">
			            </a>
		            </div>
		        <?php } ?>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="sr"><?php esc_html_e( 'MENU', 'bellaworks' ); ?></span><span class="bar"></span></button>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php get_template_part("parts/slideshow"); ?>

	<div id="content" class="site-content">
