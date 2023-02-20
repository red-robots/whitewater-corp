<?php
/* Main Navigation */
global $post;
$current_post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : '';
$current_url = ($current_post_id) ? get_permalink($current_post_id) : '';
$current_url = ($current_url) ? rtrim($current_url,"/") : '';

$parents = get_field("parent_menu_grayson","option");
$childenMenuItems = array();

$secondary_menu = get_field("secondary_menu","option");

if($parents) { ?>

<div id="site-navigationp" class="graysonnav">
	<a href="#" id="closeNav" class="closeNav graysonclose"><span>x</span></a>


	<div class="nav__content">
  	<?php //get_template_part('parts/prenav'); ?>
  	<div class="nav-inner">
  		<nav class="navigationz animated grayson">
  			<ul class="menu">
  				<?php $i=1; foreach ($parents as $p) { 
  					$parent_name = $p['parent_menu_name'];
  					$parent_link = $p['parent_menu_link'];
  					$parentURL = (isset($parent_link['url']) && $parent_link['url']) ? $parent_link['url']:'#';
  					$link_target = ( isset($parent_link['target']) && $parent_link['target'] ) ? $parent_link['target']:'_self';
  					// $link_target = '_self';
  					// if( $parentURL && (strpos($parentURL, 'http') !== false) ) {
  					// 	$linkparts = parse_external_url($parentURL);
  					// 	$link_target = $linkparts['target'];
  					// }

  					$children_menu = $p['children_menu'];
  					$has_children = ($p['has_children_menu']=='yes') ? true : false;
  					$has_children_class = ($has_children) ? ' has-children':'';
  					$parent_class = '';
  					$parent_id = 'parent-menu-' . $i;
  					if($has_children) {
  						$parent_class = ' has-children';
  					}
  					if($parent_name) { 
  						if($children_menu) {
  							foreach($children_menu as $cm) {
  								$childenMenuItems[$parent_id]['parent_name'] = $parent_name;
  								$childenMenuItems[$parent_id]['children_data'][] = $cm;
  							}
  						} ?>
  					<li id="<?php echo $parent_id ?>" class="parent-link<?php echo $parent_class ?>">
  						<?php if ($parent_link) { ?>
  						<a href="<?php echo $parentURL ?>" data-parent=".<?php echo $parent_id ?>" class="parentlink" target="<?php echo $link_target ?>"><span><?php echo $parent_name ?></span></a>
  						<?php } else { ?>
  						<a href="#" class="parentlink<?php echo $has_children_class ?>" data-parent=".<?php echo $parent_id ?>"><span><?php echo $parent_name ?></span></a>
  						<?php } ?>
  					</li>
  					<?php } ?>
  				<?php $i++; } ?>
  			</ul>
  			<div class="squiggly"><div class="line"></div></div>

  			<?php if ($secondary_menu) { ?>
  			<div class="secondary-menu">
  				<ul class="menu2">
  				<?php foreach ($secondary_menu as $sm) { 
  					$s = $sm['link'];
  					$s_icon = $sm['icon_class'];
  					if($s) {
  						$s_name = $s['title'];
  						$s_link = $s['url'];
  						$s_target = ($s['target']) ? $s['target'] : '_self';
  						?>
  						<li>
  							<a href="<?php echo $s_link ?>" target="<?php echo $s_target ?>">
  								<span><?php echo $s_name ?></span>
  								<?php if ($s_icon) { ?>
  								<i class="navIcon <?php echo $s_icon ?>"></i>
  								<?php } ?>
  							</a>
  						</li>
  					<?php } ?>
  				<?php } ?>
  				</ul>
  				<form action="<?php bloginfo('url'); ?>/" method="get">
  				    <input class="nav-search" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
  				    <!-- <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" /> -->
  				</form>
  			</div>
  			<?php } ?>
  		</nav>
  	</div>

  	<?php /* CHILDREN MENU */ 
  	if($childenMenuItems) { ?>

  		<div id="childrenNavs" class="navigation-children-grayson navigation__children">
  			<a href="#" id="closeNavChild" class="closeNav graysonclose"><span>x</span></a>
  			<div class="navchild-inner">
  				
  				<?php $c=1; foreach ($childenMenuItems as $k=>$ch) { 
  					$parent_name = $ch['parent_name'];
  					$childrenData = $ch['children_data'];
  					if($childrenData) { ?>
  					<div class="children-group-grayson <?php echo $k ?>" data-parent="<?php echo $k ?>">
  						<div class="parent-name"><?php echo $parent_name ?></div>
  						<div class="children-menu-wrap">
  							<?php foreach ($childrenData as $e) { 
  								$child_menu_name = $e['child_menu_name'];
  								$child_menu_pagelink = $e['child_menu_pagelink'];
  								$child_menu_target = ( isset($e['child_menu_pagelink_target'][0]) ) ? true : false;
  								$child_links = $e['child_menu_links'];
  								$childTarget = ($child_menu_target) ? ' target="_blank"':''
  								?>
  								<div class="children-menu-content">
  									<?php if ($child_menu_name) { ?>
  										<div class="submenu-name">
  											<?php if ($child_menu_pagelink && (strpos($child_menu_pagelink, 'http') !== false)) { ?>
  											<a href="<?php echo $child_menu_pagelink ?>" class="cmenu-link"<?php echo $childTarget ?>><?php echo $child_menu_name ?></a>
  											<?php } else { ?>
  												<?php echo $child_menu_name ?>
  											<?php } ?>
  										</div>
  									<?php } ?>
  									
  									<?php if ($child_links) { ?>
  										<div class="submenu-links">
  											<ul class="submenu">
  												<?php foreach ($child_links as $ld) { 
  													$n = $ld['link'];
  													if($n) {
  														$name = $n['title'];
  														$link = ($n['url']) ? rtrim($n['url'],"/") : '#';
  														$target = ($n['target']) ? $n['target'] : '_self';
  														$res = ($link) ? get_page_id_by_permalink($link) : '';
  														$pageID = ( isset($res->ID) ) ? $res->ID : '';
  														$link_class = ($pageID) ? 'internal menu-page-' . $pageID : 'external';
  														if($pageID && $pageID==$current_post_id) {
  															$link_class .= ' current_page_item';
  														}
  														if($name) { ?>
  														<li class="<?php echo $link_class ?>" data-pageid="<?php echo $pageID ?>">
  															<a href="<?php echo $link ?>" target="<?php echo $target ?>" class="child-link"><span><?php echo $name; ?></span></a>
  														</li>
  														<?php } ?>
  													<?php } ?>

  												<?php } ?>
  											</ul>
  										</div>
  									<?php } ?>
  								</div>
  							<?php } ?>
  						</div>
  					</div>
  					<?php } ?>
  				<?php $c++; } ?>


  			</div>
  		</div>

  	<?php } ?>
  </div>


</div>

<?php } ?>