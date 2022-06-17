<?php if ( $info = get_sub_field('feeds') ) { 
		$sTitle = get_sub_field('section_label');
		$sIcon = get_sub_field('section_icon');
	?>
  <?php if( $sTitle || $sIcon ) { ?>
  <section id="route-information" class="route-information fw-left section-content" data-section="Information">
    <div class="shead-icon text-center fw-left">
      <div class="wrapper">
      	<?php if($sIcon) { ?>
	        <div class="icon">
	        	<!-- <span class="ci-info"></span> -->
	        	<img src="<?php echo $sIcon['url']; ?>" alt="<?php echo $sIcon['alt']; ?>">
	        </div>
	    <?php } ?>
	    <?php if($sTitle){ ?>
	        <h2 class="stitle"><?php echo $sTitle; ?></h2>
	    <?php } ?>
      </div>
    </div>
    <div class="information-tabs-wrap">
      <div id="tabs-info" class="tabs-info">
        <div class="wrapper">
          <ul id="tabs">
          <?php 
          $j=1; 
          foreach( $info as $f ): 
            $tabTitle = $f['tab_title'];
            
            // $panel = get_sub_field('tab_info');
            if( $tabTitle ) { ?>
              <li class="tab<?php echo ($j==1) ? ' active':'';?>"><a href="#" data-rel="#info-panel-<?php echo $j?>" class="tablink"><span class="link"><span><?php echo $tabTitle ?></span></span><span class="arrow"></span></a></li>
            <?php $j++; } ?>
           <?php  endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="tabs-content">
        <?php $i=1; foreach( $info as $f ):  
          $tabTitle = get_sub_field('tab_title');
          $feed_type = $f['feed_type'];
          $feed_source = $f['feed_source'];
      //     echo '<pre style="background-color:#fff;">';
	    	// print_r($f);
	    	// echo '</pre>';
          if( $feed_source ) { ?>
            <div id="info-panel-<?php echo $i?>" class="info-panel<?php echo ($i==1) ? ' active last-open':'';?>">
              <h3 class="info-title"><?php echo $tabTitle ?></h3>
              <div class="wrapper info-inner animated<?php echo ($i==1) ? ' fadeIn':'';?>"<?php echo ($i==1) ? ' style="display:block"':'';?>>
                <div class="flexwrap">
                  <div class="wrap">
                    <div class="info">
                    	<?php include(locate_template('parts/homepage-feed-rest.php')); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php $i++; } ?>
        <?php  endforeach; ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php } ?>