<?php
/**
 * Template Name: Sitemap
 */

$placeholder = THEMEURI . 'images/rectangle.png';
$banner = get_field("flexslider_banner");
$has_banner = ($banner) ? 'hasbanner':'nobanner';
get_header(); ?>

<div id="primary" class="content-area-full content-default page-default-template sitemappage <?php echo $has_banner ?>">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<section class="text-centered-section">
				<div class="wrapper text-center">
					<div class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</div>
					<?php the_content(); ?>
				</div>
			</section>

		<?php endwhile; ?>

		<section class="site-map">
				<div class="wrapper">
					
					<?php
					/* Main Navigation */
					global $post;
					$current_post_id = ( isset($post->ID) && $post->ID ) ? $post->ID : '';
					$current_url = ($current_post_id) ? get_permalink($current_post_id) : '';
					$current_url = ($current_url) ? rtrim($current_url,"/") : '';

					$parents = get_field("parent_menu","option");
					$childenMenuItems = array();
					$secondary_menu = get_field("secondary_menu","option");

					if($parents) { ?>
					<div id="sitemapLinks">
						<ul class="smap">
							<?php $i=1; foreach ($parents as $p) { 
								$parent_name = $p['parent_menu_name'];
								$parent_link = $p['parent_menu_link'];
								$parentURL = (isset($parent_link['url']) && $parent_link['url']) ? $parent_link['url']:'#';
								$link_target = ( isset($parent_link['target']) && $parent_link['target'] ) ? $parent_link['target']:'_self';
								$children_menu = $p['children_menu'];
								$has_children = ($p['has_children_menu']=='yes') ? true : false;
								$has_children_class = ($has_children) ? ' has-children':'';
								$parent_class = '';
								$parent_id = 'parent-menu-' . $i;
								if($has_children) {
									$parent_class = ' has-children';
								}
								if($parent_name) { ?>
								<li id="smap-<?php echo $parent_id ?>" class="parent-link<?php echo $parent_class ?>">
									<?php if ($parent_link) { ?>
									<a href="<?php echo $parentURL ?>" data-parent=".<?php echo $parent_id ?>" class="parentlink pagelink" target="<?php echo $link_target ?>"><span><?php echo $parent_name ?></span></a>
									<?php } else { ?>
									<span class="nolink"><?php echo $parent_name ?></span>
									<?php } ?>

									<?php if ($children_menu) { ?>
									<ul class="sublinks">
										<?php foreach ($children_menu as $e) { 
											$child_menu_name = $e['child_menu_name'];
											$child_menu_pagelink = $e['child_menu_pagelink'];
											$child_menu_target = ( isset($e['child_menu_pagelink_target'][0]) ) ? true : false;
											$child_links = $e['child_menu_links'];
											$childTarget = ($child_menu_target) ? ' target="_blank"':''
											?>
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
										<?php } ?>
									</ul>	
									<?php } ?>
								</li>
								<?php } ?>
							<?php $i++; } ?>
						</ul>
					</div>
					<?php } ?>

					</div>
				</section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
