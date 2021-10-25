	</div><!-- #content -->
	
	<?php  
	$address = get_field("address","option");
	$phone = get_field("phone","option");
	$email = get_field("email","option");
	$social_media = get_social_links();
	$links[] = get_field("group1","option");
	$links[] = get_field("group2","option");
	$footLinks = array();
	if($links) {
		foreach($links as $n) {
			if($n['title'] && $n['links']) {
				$footLinks[] = $n;
			}
		}
	}
	$subscribe = get_field("group3","option");
	?>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footTop full">
			<div class="wrapper">
				<div class="columnWrap">
					<div class="footcol contactCol">
						<div class="coltitle">Contact</div>
						<?php if ($phone) { ?>
						<div class="info phone"><i class="icon fas fa-phone"></i><a href="tel:<?php echo format_phone_number($phone) ?>"><?php echo $phone ?></a></div>
						<?php } ?>
						
						<?php if ($address) { ?>
						<div class="info address"><i class="icon fas fa-map-marker-alt"></i><?php echo $address ?></div>
						<?php } ?>

						<?php if ($email) { ?>
						<div class="info email"><i class="icon fas fa-envelope"></i><a href="mailto:<?php echo antispambot($email,1) ?>"><?php echo antispambot($email) ?></a></div>
						<?php } ?>
					</div>

					<?php if ($footLinks) { ?>
						<?php foreach ($footLinks as $e) { 
							$c_title = $e['title'];
							$c_links = $e['links'];
							$link = (isset($e['foot_parent_link']['url']) && $e['foot_parent_link']['url']) ? $e['foot_parent_link']['url'] : '';
							$linkTarget = (isset($e['foot_parent_link']['target']) && $e['foot_parent_link']['target']) ? $e['foot_parent_link']['target'] : '_self';
							$link_open = '';
							$link_close = '';
							if($link) {
								$link_open = '<a class="pagelink" href="'.$link.'" target="'.$linkTarget.'">';
								$link_close = '</a>';
							}
						?>
						<div class="footcol footlinks">
							<div class="coltitle">
								<?php echo $link_open.$c_title.$link_close; ?>			
							</div>
							<?php if ($c_links) { ?>
							<ul class="flinks">
								<?php foreach ($c_links as $a) { 
								$link = $a['link'];
								$target =  ($link) ? ' target="'.$link['target'].'"':'';  ?>
								<li><a href="<?php echo $link['url'] ?>"<?php echo $target ?>><?php echo $link['title'] ?></a></li>
								<?php } ?>
							</ul>
							<?php } ?>
						</div>
						<?php } ?>
					<?php } ?>

					<div class="footcol subscribeCol">
						<?php if ( isset($subscribe['title']) && $subscribe['title'] ) { ?>
							<div class="coltitle"><?php echo $subscribe['title']; ?></div>
						<?php } ?>
						<?php if ( isset($subscribe['subscribe_form_code']) && $subscribe['subscribe_form_code'] ) { ?>
							<div id="footSubscribeForm" class="subscribeForm"><?php echo $subscribe['subscribe_form_code']; ?><a id="subscribeBtnIcon"><i class="subicon fas fa-paper-plane"></i></a></div>
						<?php } ?>

						<?php 
							/* SOCIAL MEDIA LINKS */ 
							$social_links_order = get_field("social_links_order","option");
							$links_order = array();
							if($social_links_order) {
								$parts = explode(",",$social_links_order);
								if($parts) {
									foreach($parts as $p) {
										$str = preg_replace('/\s+/','',$p);
										if($str) {
											$links_order[] = $str;
										}
									}
								}
							}
						?>
						<?php if ($social_media) { ?>
						<div class="foot-social-media">
							<?php get_template_part("parts/social-media"); ?>		
						</div>	
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		
		<?php if( $sponsors = get_field("sponsors","option") ) { ?>
		<div class="footSponsors full text-center">
			<div class="coltitle">Sponsors</div>
			<div class="inner">
			<?php foreach ($sponsors as $s) { 
				$img = $s['image'];
				$sitelink = $s['website'];
				$s_open_link = '';
				$s_close_link = '';
				if($sitelink) {
					$s_open_link = '<a href="'.$sitelink.'" target="_blank">';
					$s_close_link = '</a>';
				}
				if($img) {?>
				<span class="sponsor-logo">
				<?php echo $s_open_link; ?>
					<img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>">
				<?php echo $s_close_link; ?>
				<?php } ?>
				</span>
			<?php } ?>
			</div>
		</div>
		<?php } ?>
		<div id="copyright" class="copyright-section full">
			<div class="wrapper">
				<div class="copyright-inner">
					<div class="col-left">
						<span class="copyright-info">&copy; <?php echo date('Y') . ' ' . get_field('copyright', 'option') ?></span>
					</div>
					<div class="col-right">
						<?php if ( has_nav_menu('footer') ) { ?>
						<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu','container_class'=>'footer-menu' ) ); ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->
<div id="loaderDiv"> <div class="loaderInline"> <div class="sk-chase"> <div class="sk-chase-dot"></div> <div class="sk-chase-dot"></div> <div class="sk-chase-dot"></div> <div class="sk-chase-dot"></div> <div class="sk-chase-dot"></div> <div class="sk-chase-dot"></div> </div> </div> </div>
<?php wp_footer(); ?>
</body>
</html>
