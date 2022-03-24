<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bellaworks
 */

get_header(); ?>
<?php  
$t1 = get_field("404_title_small","option");
$red = get_field("404_title_red","option");
$text = get_field("404_text","option");
$bg = get_field("404_bg_image","option");
$style = ($bg) ? ' style="background-image:url('.$bg['url'].')"':'';
?>
<main id="main" class="site-main page404 custom404" role="main"<?php echo $style ?>>
	<div class="wrapper">
		<section class="content404">
			<?php if ($t1) { ?>
			<p class="t1"><small><?php echo $t1 ?></small></p>	
			<?php } ?>
			<?php if ($red) { ?>
			<h2 class="t2"><span><?php echo $red ?></span></h2>	
			<?php } ?>

			<?php if ($text) { ?>
			<div class="text"><?php echo $text ?></div>
			<?php } ?>
		</section>
	</div>
</main>
<?php
get_footer();
