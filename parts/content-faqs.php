<?php 
if( is_faqs_visible() ) {
	
	$postid = get_the_ID();
	$faq_image = get_field("faq_image"); 
	//$faqsIds = get_faqs_by_single_post($postid);
	//$faqs = get_faqs_by_assigned_page_id($faqsIds);

	$faqs = get_faq_listings($postid);
	$faq_class = ($faqs && $faq_image) ? 'half':'full';
	$has_faq_image = ($faq_image) ? ' has-image':' no-image';
	$show_default_title = ( isset($customFAQTitle) && $customFAQTitle ) ? false : true;
	$faqTitle = ( isset($customFAQTitle) && $customFAQTitle ) ? $customFAQTitle : "FAQ";
	$customClass = ( isset($customFAQClass) && $customFAQClass ) ? " ".$customFAQClass : "";

	if($faqs) { ?>
	<section id="section-faqs" data-section="<?php echo $faqTitle ?>" class="section-content <?php echo $faq_class.$has_faq_image.$customClass ?>">
		<div class="wrapper">
			<div class="flexwrap">

				<div class="col faqs">

					<?php if ( isset($useDefaultFAQIcon) && $useDefaultFAQIcon ) { ?>

						<?php if ( isset($customFAQTitle) && $customFAQTitle ) { ?>
						<div class="shead-icon text-center">
							<div class="icon"><span class="ci-help"></span></div>
							<h2 class="stitle"><?php echo $customFAQTitle ?></h2>
						</div>
						<?php } ?>
						
					<?php } else { ?>

						<?php if ($show_default_title) { ?>
							<div class="titlediv">
								<?php if ($faq_image) { ?>
								<h2 class="sectionTitle">FAQ</h2>
								<?php } else { ?>
								<h2 class="sectionTitle text-center">FAQ</h2>
								<?php } ?>
							</div>
						<?php } else { ?>

								<?php if ( isset($customFAQTitle) && $customFAQTitle ) { ?>
								<div class="shead-icon text-center">
									<div class="icon"><span class="ci-help"></span></div>
									<h2 class="stitle"><?php echo $customFAQTitle ?></h2>
								</div>
								<?php } ?>

						<?php } ?>

					<?php } ?>

					<?php 
						$faqLists = array();
						foreach ($faqs as $q) { 
							$faq_id = $q['ID'];
							$faq_items = $q['faqs'];
							if($faq_items) {
								foreach ($faq_items as $fi) { 
									$fi['parent_id'] = $faq_id;
									$faqLists[] = $fi;
								}
							}
						}
					?>


					<div class="faqsItems">
						<?php 
						$faq_pageId = 157;
						$max = 3;
						$totalFaqs = count($faqLists);
						$faq_ids = array();
						$n=1; foreach ($faqLists as $f) { 
							$faq_parent_id = $f['parent_id'];
							$question = $f['question'];
							$answer = $f['answer'];
							if($question && $answer) { 
								$isFirst = ($n==1) ? ' first':'';
								//$faqlimit = ($n>$max) ? ' hide-faq':'';
								if($n<=$max) { $faq_ids[] = $faq_parent_id; ?>
								<div data-faq-parent="<?php echo $faq_parent_id; ?>" class="faq-item collapsible<?php echo $isFirst ?>">
									<h3 class="option-name"><?php echo $question ?><span class="arrow"></span></h3>
									<div class="option-text"><?php echo $answer ?></div>
								</div>
								<?php } ?>
							<?php $n++; } ?>
						<?php } ?>

						<?php if ($totalFaqs>$max) { 
							$faqparent = ($faq_ids) ? array_unique($faq_ids) : ''; 
							$fpid = ( isset($faqparent[0]) && $faqparent[0] ) ? '?pid=' . $faqparent[0] : '';
						?>
						<div class="morefaqs">
							<!-- <a href="#" class="btn-sm btn-cta morefaqsBtn"><span>See More</span></a> -->
							<a href="<?php echo get_permalink($faq_pageId); ?><?php echo $fpid?>" class="btn-sm xs"><span>See More</span></a>
						</div>
						<?php } ?>
					</div>	
				</div>

				<?php if ($faq_image) { ?>
				<div class="col faq-image">
					<img src="<?php echo $faq_image['url'] ?>" alt="<?php echo $faq_image['title'] ?>" />
				</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<?php } ?>

<?php } ?>