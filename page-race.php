<?php
/**
 * Template Name: Race Series
 */

get_header(); 
$blank_image = THEMEURI . "images/square.png";
$square = THEMEURI . "images/square.png";
$rectangle = THEMEURI . "images/rectangle-lg.png";
?>

<div id="primary" data-post="<?php echo get_the_ID()?>" class="content-area-full festival-page race-series-page">
		<?php while ( have_posts() ) : the_post(); ?>
			
				<div class="intro-text-wrap">
					<div class="wrapper">
						<h1 class="page-title"><span><?php the_title(); ?></span></h1>
						<?php if( get_the_content() ) { ?>
						<div class="intro-text"><?php the_content(); ?></div>
						<?php } ?>
					</div>
				</div>
			
		<?php endwhile;  ?>

		<?php get_template_part("parts/race-series-filter"); ?>



		<?php // Popups for Marketing 
		$popup_on = get_field('popup_on');
		$popup_creative = get_field('popup_creative');
		$popup_text = get_field('popup_text');
		$popup_link = get_field('popup_link');
		// echo '<pre>';
		// print_r($popup_link);
		// echo '</pre>';
		?>
		<div style="display: none;">
			<div class="race-popup ajax" id="race-pop">
					<?php if($popup_creative){ ?>
						<div class="race-pop-img">
							<img src="<?php echo $popup_creative['url']; ?>" width="<?php echo $popup_creative['width']; ?>" height="<?php echo $popup_creative['height']; ?>" >
						</div>
					<?php } ?>
					<?php if($popup_text){ ?>
						<div class="race-pop-txt">
							<?php echo $popup_text; ?>
						</div>
					<?php } ?>
				<?php if($popup_link) {?>
					<div class="button popbtn">
						<a 
						href="<?php echo $popup_link['url']; ?>" 
						target="<?php echo $popup_link['target']; ?>" 
						class="btn-sm">
						<span><?php echo $popup_link['title']; ?></span></a>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php if( $popup_on == 'yes' ){ ?>
			<?php if (!isset($_COOKIE['racepup'])): ?>

			    <!-- replace this whatever you want to show -->
			    <script>
			    	$(document).ready(function(){
					    $.colorbox({
					    	inline:true, 
					    	href:".ajax",
					    	innerWidth: 300
					    });
					});
			    </script>

			    <?php
			    setcookie('racepup', true,  time()+2592000); // 30 days
			    ?>

			<?php endif; ?>
		<?php } ?>
		



</div><!-- #primary -->
<script type="text/javascript">
(function($) {
	var hasFilter = '<?php echo ( isset($_GET['_race_event_status']) || isset($_GET['_race_series_discipline']) ) ? '1':''?>';
	if(hasFilter) {
		$("#resetBtn").removeClass('hide');
	}
})(jQuery);
</script>
<?php
get_footer();
