<div class="overlay-flex">
	<?php if($logoOverlay) { ?>
		<div class="logo-overlay"><img src="<?php echo $logoOverlay['url'] ?>"></div>
	<?php } ?>
	<?php if ( isset($row['slide_text']) && $row['slide_text'] ) { ?>
		<div class="slideCaption">
			<div class="text" style="color: <?php echo $tColor; ?>">
				<?php echo $row['slide_text'] ?>
			</div>
		</div>
	<?php } ?>
	<?php if( $fbutton ) { ?>
		<div class="button-center">
		<?php 
		foreach ($fbutton as $b) { 
			$buttonTitle = (isset($b['cta_button']['title']) && $b['cta_button']['title']) ? $b['cta_button']['title'] : '';
			$buttonLink = (isset($b['cta_button']['url']) && $b['cta_button']['url']) ? $b['cta_button']['url'] : '';
			$buttonTarget = (isset($b['cta_button']['target']) && $b['cta_button']['target']) ? $b['cta_button']['target'] : '_self';
?>
		<div class="buttondiv">
			<a href="<?php echo $buttonLink ?>" target="<?php echo $buttonTarget ?>" class="btn-sm xs"
					style="border: 1px solid <?php echo $tColor; ?>; color: <?php echo $tColor; ?>"
				>
				<span><?php echo $buttonTitle ?></span>
			</a>
		</div>
	<?php } ?>
		</div>
	<?php } ?>
</div>