<?php 

get_header(); 
?>
<div id="primary" class="content-area-full homepage">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post();
			$intro = get_field('intro');
			// get_template_part( 'parts/content', 'page' );
			?>
			<div class="intro-text-wrap">
				<div class="wrapper">
					<?php if ( $intro ) { ?>
					<div class="intro-text"><?php echo $intro; ?></div>
					<?php } ?>
				</div>
			</div>
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
				else:
					// do something
					echo 'Nothing Here!';
				endif;
			endwhile; endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
