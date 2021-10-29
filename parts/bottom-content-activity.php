<?php
$current_post_id = get_the_ID();
$placeholder = THEMEURI . 'images/rectangle-lg.png';
$articles = get_field("global_single_post_featured_articles","option");

$taxonomy = 'activity_type';
$related['terms'] = array('films','stories');
$related['taxonomy'] = 'category';
$related['post_type'] = 'post';
$relatedPosts = get_categories_by_page_id($current_post_id,$taxonomy,$related);

if($relatedPosts) { 
$count = count($relatedPosts);  
$colClass = ($count>1) ? 'half':'full';

$stories_text = get_field("stories_text","option");
$stories_edit_link = admin_url() . 'admin.php?page=acf-options-global-options&fsec=stories-text';
?>
<section id="section-featured-posts" class="section-content <?php echo $colClass ?> clear">
	<div class="wrapper">
		<div class="shead-icon text-center">
			<div class="icon"><span class="ci-video"></span></div>
			<h2 class="stitle">Stories</h2>
			<?php if ($stories_text) { ?>
			<div class="subtext">
				<?php echo $stories_text ?>
				<?php if( current_user_can( 'administrator' ) ){ ?>
				<div class="edit-entry"><a href="<?php echo $stories_edit_link ?>" style="text-decoration:underline;">Edit Text</a></div>
				<?php } ?>
			</div>	
			<?php } ?>
		</div>
	</div>
	<div class="flexwrap">
		<?php foreach ($relatedPosts as $rel) { 
			$r_post_id = $rel->ID;
			$r_title = $rel->post_title;
			$r_content = $rel->post_content;
			$r_exceprt = ($r_content) ? shortenText( strip_tags($r_content), 250, " ", "...") : '';
			$r_thumb_id = get_post_thumbnail_id($r_post_id);
			$r_img = wp_get_attachment_image_src($r_thumb_id,'full');
 			$r_term_id = $rel->term_id;
 			$r_taxonomy = $rel->taxonomy;
 			$r_pagelink = get_permalink($r_post_id);
 			$r_image_bg = ($r_img) ? ' style="background-image:url('.$r_img[0].')"':'';
 			$r_img_class = ($r_img) ? 'has-image':'no-image';
 			$r_icon = '';
 			$related_terms = ( isset($rel->related_terms) && $rel->related_terms ) ? $rel->related_terms : '';
 			if($related_terms) {
 				$r_icon = get_field("category_icon",$related_terms);
 			}
			?>
			
			<div class="block">
				<div class="inside">

					<div class="textwrap js-blocks">
						<div class="inner-wrap">

							<?php if ($r_icon) { ?>
								<div class="icon"><span style="background-image:url('<?php echo $r_icon['url'] ?>')"></span></div>
							<?php } ?>

							<h3 class="sectionTitle"><span><?php echo $r_title ?></span></h3>

							<?php if ($r_exceprt) { ?>
								<div class="text"><?php echo $r_exceprt ?></div>
							<?php } ?>

							<div class="button">
								<a href="<?php echo $r_pagelink ?>" class="btn-sm xs"><span>Read More</span></a>
							</div>
						</div>
					</div>

					<div class="feat-image <?php echo $r_img_class ?>">
						<div class="bg"<?php echo $r_image_bg ?>>
							<img src="<?php echo $placeholder ?>" alt="">
						</div>
					</div>

				</div>
			</div>

		<?php } ?>
	</div>
</section>
<?php } ?>



<?php /* EXPLORE OTHER ACTIVITIES */ ?>
<?php get_template_part("parts/similar-posts"); ?>

