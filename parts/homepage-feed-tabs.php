<?php 
$info = get_sub_field('t_tabs');
// echo '<pre style="background-color:#fff;">';
//     	print_r($info);
//     	echo '</pre>';
// if ( $feeds !== '' ) { 
	$sTitle = get_sub_field('t_section_title');
	$sIcon = get_sub_field('t_section_icon');
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
            $tabTitle = ''; // reset
	          $feed_type = ''; // reset
	          $feed_source = ''; // reset
	          $tabTitle = $f['tab_title'];
	          // $feed_type = $f['feed_type'];
	          // $feed_source = $f['feed_source'];
            // $type = $feed_type;
            // $source = $feed_source;
            // $response = 'https://'.$source.'.whitewater.org/wp-json/wp/v2/'.$type.'?per_page=20';
            
            // $panel = get_sub_field('tab_info');
            if( $tabTitle ) { ?>
              <li class="tab<?php echo ($j==1) ? ' active':'';?>"><a href="#" data-rel="#info-panel-<?php echo $j?>" class="tablink"><span class="link"><span><?php echo $tabTitle ?><?php //echo $response; ?></span></span><span class="arrow"></span></a></li>
            <?php $j++; } ?>
           <?php  endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="tabs-content">
        <?php 
          $b=1; 
          foreach( $info as $g ):  
          $tabTitle = ''; // reset
          $feed_type = ''; // reset
          $feed_source = ''; // reset
          $tabTitle = $g['tab_title'];
          // $feed_type = $g['feed_type'];
          // $feed_source = $g['feed_source'];
      //     echo '<pre style="background-color:#fff;">';
      //     echo $feed_source;
	    	// print_r($g);
	    	// echo '</pre>';
          if( $tabTitle ) { ?>
            <div id="info-panel-<?php echo $b?>" class="info-panel<?php echo ($b==1) ? ' active last-open':'';?>">
              <?php 
                  // echo '<pre style="background-color:#fff;">';
                  // // echo $feed_source;
                  // print_r($g);
                  // echo '</pre>';
                   ?>
              <h3 class="info-title"><?php echo $tabTitle ?></h3>
              <div class="wrapper info-inner animated<?php echo ($b==1) ? ' fadeIn':'';?>"<?php echo ($b==1) ? ' style="display:block"':'';?>>
                <div class="flexwrap">
                  <div class="wrap">
                    <div class="info">fef
                    	<?php include(locate_template('parts/homepage-feed-tab-cards.php')); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php $b++; } ?>
        <?php  endforeach; ?>
      </div>
    </div>
  </section>
  <?php } ?>