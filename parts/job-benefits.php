<?php wp_reset_query(); ?>
<?php //if ( $info = get_field('additional_info_job') ) { ?>
  <?php if( have_rows('additional_info_job') ) { ?>
  <section id="route-information" class="route-information fw-left section-content" data-section="Information">
    <div class="shead-icon text-center fw-left">
      <div class="wrapper">
        <div class="icon"><span class="ci-info"></span></div>
        <h2 class="stitle">Benefits</h2>
      </div>
    </div>
    <div class="information-tabs-wrap">
      <div id="tabs-info" class="tabs-info">
        <div class="wrapper">
          <ul id="tabs">
          <?php $j=1; while( have_rows('additional_info_job') ): the_row(); 
            $tabTitle = get_sub_field('tab_title');
            $tabIcon = get_sub_field('tab_icon');
            $contIcons = get_sub_field('content_icons');
            $panel = get_sub_field('tab_info');
            if( $tabTitle && $panel || $tabTitle && $contIcons ) { ?>
              <li class="tab<?php echo ($j==1) ? ' active':'';?>">
                <a href="#" data-rel="#info-panel-<?php echo $j?>" class="tablink">
                <span class="link"><span><?php echo $tabTitle ?></span></span><span class="arrow"></span>
                <?php if( $tabIcon ) { ?>
                  <div class="detail-icon"><img src="<?php echo $tabIcon['url']; ?>"></div>
                <?php } ?>
              </a>
              </li>
            <?php $j++; } ?>
           <?php  endwhile; ?>
          </ul>
        </div>
      </div>
      <div class="tabs-content">
        <?php $i=1; while( have_rows('additional_info_job') ): the_row(); 
          $tabTitle = get_sub_field('tab_title');
          $contIcons = get_sub_field('content_icons');
          $panel = get_sub_field('tab_info');
          if( $tabTitle && $panel || $tabTitle && $contIcons  ) { ?>
            <div id="info-panel-<?php echo $i?>" class="info-panel<?php echo ($i==1) ? ' active last-open':'';?>">
              <h3 class="info-title"><?php echo $tabTitle ?></h3>
              <div class="wrapper info-inner animated<?php echo ($i==1) ? ' fadeIn':'';?>"<?php echo ($i==1) ? ' style="display:block"':'';?>>
                <?php if( $contIcons ) { ?>
                  <div class="cont-icon-wrap">
                    <?php foreach( $contIcons as $ci ) { 
                      // echo '<pre style="background: #fff;">';
                      // print_r($ci);
                      // echo '</pre>';
                      ?>
                      <div class="cicon">
                        <?php if( $ci['link'] ) { echo '<a href="'.$ci['link'].'">'; } ?>
                          <img src="<?php echo $ci['url'] ?>">
                          <?php if( $ci['title'] ) { echo '<h3>'.$ci['title'].'</h3>';} ?>
                        <?php if( $ci['link'] ) { echo '</a>'; } ?>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
                <?php if( $panel ) { ?>
                  <div class="flexwrap">
                    <div class="wrap">
                      <div class="info"><?php echo $panel ?></div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php $i++; } ?>
        <?php  endwhile; ?>
      </div>
    </div>
  </section>
  <?php } ?>
<?php //} ?>