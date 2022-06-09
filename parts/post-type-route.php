<?php 
$blank_image = THEMEURI . "images/square.png";
$placeholder = THEMEURI . 'images/rectangle.png';
$rectangle_lg = THEMEURI . 'images/rectangle-lg.png';
$page_title = get_the_title();
while ( have_posts() ) : the_post(); ?>
  
  <section class="main-description">
    <div class="wrapper text-center">
      <h1 class="pagetitle"><span><?php echo get_the_title(); ?></span></h1>
      <?php if ( $short_description = get_field("short_description") ) { ?>
        <div class="main-text"><?php echo $short_description; ?></div>
      <?php } ?>
    </div>
  </section>
  
  <div id="pageTabs"></div>


  <?php if( have_rows('route') ) { ?>  
    <?php while ( have_rows('route') ) : the_row(); ?>

      <?php //Case: Details with icons ?>
      <?php if ( get_row_layout() == 'detail' ) { 
        
        $detail = get_sub_field('detail');
        if( have_rows('detail') ) { ?>
        <section class="route-details fw-left">
          <div class="wrapper">
            <div class="flexwrap">
            <?php while( have_rows('detail') ): the_row(); 
              $icon = get_sub_field('icon');
              $dTitle = get_sub_field('detail_title');
              $dDesc  = get_sub_field('detail');
              ?>
              <div class="flexcol">
                <?php if ($icon) { ?>
                <div class="icon">
                  <img src="<?php echo $icon['url'] ?>" alt="<?php echo $icon['title'] ?>" />
                </div> 
                <?php } ?>

                <?php if ($dTitle) { ?>
                <div class="title"><?php echo $dTitle ?></div> 
                <?php } ?>

                <?php if ($dDesc) { ?>
                <div class="desc"><?php echo $dDesc ?></div> 
                <?php } ?>
              </div>
              <?php endwhile; ?>
            </div>
          </div>
        </section>
        <?php } ?>
      <?php } 

      //Case: Display Map 
      elseif( get_row_layout() == 'map' ) { ?>
        <?php if( $map = get_sub_field('map_shortcode') ) { 
          if( do_shortcode( $map ) ) { 
            $gpx = get_sub_field('gpx_file');
            ?>
          <section id="route-map" class="route-map fw-left section-content" data-section="Map">
            <div class="shead-icon text-center fw-left">
              <div class="wrapper">
                <div class="icon"><span class="ci-map"></span></div>
                <h2 class="stitle">Map</h2>
              </div>
            </div>
            <div class="map-container fw-left">
              <div class="map-frame"><?php echo do_shortcode( $map ); ?></div>
            </div>
              <?php if( $gpx ){ ?>
                <div class="center-text">
                  <div class="gpx-download">
                    <a href="<?php echo $gpx; ?>">Download Route <i class="far fa-cloud-download-alt"></i></a>
                  </div>
                </div>
              <?php } ?>
          </section>
          <?php } ?>
        <?php } ?>
      <?php }  

      //Case: Display Gallery 
      elseif( get_row_layout() == 'gallery' ) { ?>
        <?php if( $imgs = get_sub_field('gallery') ) { ?>
        <section id="route-gallery" class="route-gallery fw-left" data-section="Gallery">
          <div class="carousel-wrapper-section full">
            <div id="carousel-images">
              <div class="loop owl-carousel owl-theme">
              <?php foreach( $imgs as $img ) { ?>
                <div class="item">
                  <div class="image">
                    <div class="bg" style="background-image:url('<?php echo $img['url']?>')"></div>
                    <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" />
                  </div>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
      <?php } 

      //Case: Download layout / information section
      elseif( get_row_layout() == 'information' ) { ?>
        <?php if ( $info = get_sub_field('information') ) { ?>
          <?php if( have_rows('information') ) { ?>
          <section id="route-information" class="route-information fw-left section-content" data-section="Information">
            <div class="shead-icon text-center fw-left">
              <div class="wrapper">
                <div class="icon"><span class="ci-info"></span></div>
                <h2 class="stitle">Information</h2>
              </div>
            </div>
            <div class="information-tabs-wrap">
              <div id="tabs-info" class="tabs-info">
                <div class="wrapper">
                  <ul id="tabs">
                  <?php $j=1; while( have_rows('information') ): the_row(); 
                    $tabTitle = get_sub_field('tab_title');
                    $panel = get_sub_field('tab_info');
                    if( $tabTitle && $panel ) { ?>
                      <li class="tab<?php echo ($j==1) ? ' active':'';?>"><a href="#" data-rel="#info-panel-<?php echo $j?>" class="tablink"><span class="link"><span><?php echo $tabTitle ?></span></span><span class="arrow"></span></a></li>
                    <?php $j++; } ?>
                   <?php  endwhile; ?>
                  </ul>
                </div>
              </div>
              <div class="tabs-content">
                <?php $i=1; while( have_rows('information') ): the_row(); 
                  $tabTitle = get_sub_field('tab_title');
                  $panel = get_sub_field('tab_info');
                  if( $tabTitle && $panel ) { ?>
                    <div id="info-panel-<?php echo $i?>" class="info-panel<?php echo ($i==1) ? ' active last-open':'';?>">
                      <h3 class="info-title"><?php echo $tabTitle ?></h3>
                      <div class="wrapper info-inner animated<?php echo ($i==1) ? ' fadeIn':'';?>"<?php echo ($i==1) ? ' style="display:block"':'';?>>
                        <div class="flexwrap">
                          <div class="wrap">
                            <div class="info"><?php echo $panel ?></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php $i++; } ?>
                <?php  endwhile; ?>
              </div>
            </div>
          </section>
          <?php } ?>
        <?php } ?>
      <?php } 

      //Case: Long Form Stroy
      elseif( get_row_layout() == 'long_form_story' ) { ?> 
        <?php if ( $story = get_sub_field('story') ) { ?>
        <section class="route-long-form fw-left">
          <div class="wrapper"><?php echo $story; ?></div>
        </section>
        <?php } ?>
      <?php } 

      //Case: Stories
      elseif( get_row_layout() == 'story_blocks' ) { 
        $stories_text = get_field("stories_text","option");
        $stories_edit_link = admin_url() . 'admin.php?page=acf-options-global-options&fsec=stories-text';
        $route_stories = get_sub_field('route_stories'); 
        $show_story_blocks = get_sub_field('show_story_blocks');
        //$show_story = ( isset($show_story_blocks[0]) && $show_story_blocks[0]=='yes' ) ? true : false;
        $show_story = true;
        if($show_story) { ?>
          <?php if( have_rows('route_stories') ) { 
            $rs_count = count($route_stories);
            $rs_class = ($rs_count>1) ? 'half':'full';
            ?>
            <section id="route-stories" class="route-stories fw-left section-content <?php echo $rs_class ?>" data-section="Stories">
              <div class="shead-icon text-center"><br><br>
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
              <div class="flexwrap">
                <?php 

                //
                while ( have_rows('route_stories') ) : the_row(); 
                  $p_id = get_sub_field('post');
                  if( $p_id ) { 
                    $p_desc = get_sub_field('excerpt');
                    $r_content = get_the_content($p_id );
                    $r_exceprt = ($r_content) ? shortenText( strip_tags($r_content), 250, " ", "...") : '';
                    $r_text = ( $p_desc ) ? $p_desc : $r_exceprt;
                    $r_thumb_id = get_post_thumbnail_id($p_id);
                    $r_img = wp_get_attachment_image_src($r_thumb_id,'full');
                    $r_image_bg = ($r_img) ? ' style="background-image:url('.$r_img[0].')"':'';
                    $r_img_class = ($r_img) ? 'has-image':'no-image';
                    ?>
                    <div class="block">
                      <div class="inside">
                        <div class="textwrap js-blocks">
                          <div class="inner-wrap">
                            <h3 class="sectionTitle"><span><?php echo get_the_title($p_id) ?></span></h3>
                            <?php if ($r_text) { ?>
                            <div class="text"><?php echo $r_text ?></div>
                            <?php } ?>
                            <div class="button">
                              <a href="<?php echo get_permalink($p_id) ?>" class="btn-sm xs"><span>Read More</span></a>
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
                <?php endwhile; ?>
              </div>
            </section>
          <?php } ?>
        <?php } ?>
      <?php } ?>


    <?php endwhile; ?>
  <?php } ?>


<?php endwhile; ?>

<?php  
/* Similar Events */ 
// get_template_part("parts/similar-posts"); 
?>


<script>
jQuery(document).ready(function($){

  /* Carousel */
  $('.loop').owlCarousel({
    center: true,
    items:2,
    nav: true,
    loop:true,
    margin:15,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    responsive:{
      600:{
        items:2
      },
      400:{
        items:1
      }
    }
  });

  /* page anchors */
  if( $('[data-section]').length > 0 ) {
    var tabs = '';
    $('[data-section]').each(function(){
      var name = $(this).attr('data-section');
      var id = $(this).attr("id");
      tabs += '<span class="mini-nav"><a href="#'+id+'">'+name+'</a></span>';
    });
    $("#pageTabs").html('<div class="wrapper"><div id="tabcontent">'+tabs+'</div></div>');
  }

  $("#tabs a").on("click",function(e){
    e.preventDefault();
    var panel = $(this).attr('data-rel');
    $("#tabs li").not(this).removeClass('active');
    $(this).parents("li").addClass('active');
    if( $(panel).length ) {
      $(".info-panel").not(panel).removeClass('active');
      $(".info-panel").not(panel).find('.info-inner').removeClass('fadeIn');
      $(panel).addClass('active');
      //$(panel).find('.info-inner').addClass('fadeIn').slideToggle();
      $(panel).find('.info-inner').toggleClass('fadeIn');
    }
  });

  $(".info-title").on("click",function(e){
    var parent = $(this).parents('.info-panel');
    var parent_id = parent.attr("id");
    $("#tabs li").removeClass('active');
    $('.info-panel').not(parent).find('.info-inner').hide();
    $('.info-panel').not(parent).removeClass('active');
    parent.find('.info-inner').toggleClass('fadeIn').slideToggle();
    if( parent.hasClass('active') ) {
      parent.removeClass('active');
      $('#tabs a[data-rel="#'+parent_id+'"]').parents('li').removeClass('active');
    } else {
      parent.addClass('active');
      $('#tabs a[data-rel="#'+parent_id+'"]').parents('li').addClass('active');
    }

  });

}); 
</script>