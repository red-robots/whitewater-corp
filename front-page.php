<?php 

get_header(); 
?>
<div id="primary" class="content-area-full homepage">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();
			$intro = get_field('intro');
			// get_template_part( 'parts/content', 'page' );
			?>
			<!-- <div class="intro-text-wrap home">
				<div class="wrapper">
					<?php if ( $intro ) { ?>
					<div class="intro-text"><?php echo $intro; ?></div>
					<?php } ?>
				</div>
			</div> -->
			<!-- <section class="main-description">
				<div class="wrapper text-center">
					<h1 class="pagetitle"><span><?php echo get_the_title(); ?></span></h1>
					<?php echo $main_description ?>
				</div>
			</section> -->
			<?php 
				// $cards = get_field('card_contents');
					// echo '<pre>';
					// print_r($cards);
					// echo '</pre>';

				if( have_rows('card_contents') ): while ( have_rows('card_contents') ) : the_row();
					// $cards = get_sub_field('square_cards');
					// echo '<pre>';
					// print_r($cards);
					// echo '</pre>';
				if( get_row_layout() == 'horizontal_card_section' ):
					// $cards = get_sub_field('card_horiz');
					// echo '<pre>';
					// print_r($cards);
					// echo '</pre>';
					include(locate_template('parts/card-horizontal.php'));
					
				elseif( get_row_layout() == 'square_card_sectionz' ):
					// $cards = get_sub_field('square_cards');
					// echo '<pre>';
					// print_r($cards);
					// echo '</pre>';
					include(locate_template('parts/cards-square.php'));
				// elseif( get_row_layout() == 'rest_api_feed' ):
					elseif( get_row_layout() == 'tabbed_section' ):
					// $cards = get_sub_field('feeds');
					// echo '<pre>';
					// print_r($cards);
					// echo '</pre>';
					include(locate_template('parts/homepage-feed-tabs.php'));
				else:
					// do something
					echo 'Nothing Here!';
				endif;
			endwhile; endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->
<script>
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
<?php
get_footer();
