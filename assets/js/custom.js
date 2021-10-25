"use strict";

function _typeof2(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof2 = function _typeof2(obj) { return typeof obj; }; } else { _typeof2 = function _typeof2(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof2(obj); }

function _typeof(obj) {
  "@babel/helpers - typeof";

  if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
    _typeof = function _typeof(obj) {
      return typeof obj;
    };
  } else {
    _typeof = function _typeof(obj) {
      return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
    };
  }

  return _typeof(obj);
}
/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Lisa DeBona
 */


jQuery(document).ready(function ($) {
  /*
     *
     *   Select Dropdowns
     *
     ------------------------------------*/
  // function vali() {
  //     // Iterate over each select element
  // 	$('select#diff').change(function(){
  // 	    // alert($(this).val());
  // 	    var diffResult = $(this).val();
  // 	    $('.hide-on-load').removeClass('hide');
  // 		$('.hide-on-load').addClass('show');
  // 	    $('ul.items').find( 'li.show' ).removeClass('show');
  // 	    $('ul.items').find( 'li' ).addClass('hide');
  // 	    if( diffResult == '.advanced' ) {
  // 	    	$('ul.items').find( diffResult ).removeClass('hide');
  // 	    	$('ul.items').find( diffResult ).addClass('show');
  // 	    }
  // 	    if( diffResult == '.intermediate' ) {
  // 	    	$('ul.items').find( diffResult ).removeClass('hide');
  // 	    	$('ul.items').find( diffResult ).addClass('show');
  // 	    }
  // 	    if( diffResult == '.beginner' ) {
  // 	    	$('ul.items').find( diffResult ).removeClass('hide');
  // 	    	$('ul.items').find( diffResult ).addClass('show');
  // 	    }
  // 	    if( diffResult == '.all' ) {
  // 	    	$('ul.items').find( 'li.hide' ).removeClass('hide');
  // 	    	$('ul.items').find( 'li' ).addClass('show');
  // 	    }
  // 	});
  // }
  // $("select#diff").on("change", vali);
  $("select#diff").change(function () {
    var diffResult = $(this).val();
    $('ul.items').find('li.show').removeClass('show');
    $('ul.items').find('li').addClass('hide');

    if (diffResult == '.advanced') {
      $('ul.items').find(diffResult).removeClass('hide');
      $('ul.items').find(diffResult).addClass('show');
    }

    if (diffResult == '.intermediate') {
      $('ul.items').find(diffResult).removeClass('hide');
      $('ul.items').find(diffResult).addClass('show');
    }

    if (diffResult == '.beginner') {
      $('ul.items').find(diffResult).removeClass('hide');
      $('ul.items').find(diffResult).addClass('show');
    }

    if (diffResult == '.all') {
      $('ul.items').find('li.hide').removeClass('hide');
      $('ul.items').find('li').addClass('show');
    }

    if ($(".hide-on-load").hasClass("hide")) {
      $('.hide-on-load').removeClass('hide');
      $('.hide-on-load').addClass('show');
    }
  });
  $("#selectByProgram").change(function () {
    if ($(".hide-on-load").hasClass("hide")) {
      $('.sch-prompt').addClass('hide');
      $('.hide-on-load').removeClass('hide');
      $('.hide-on-load').addClass('show');
      $(".diff-filter-wrap").removeClass('hide');
      $(".diff-filter-wrap").addClass('show');
      $("#fi").find('.select2-container--default').removeAttr("style");
      $("#fi").find('.select2-container--default').addClass("show");
    }
  });
  /*
  Reference: http://jsfiddle.net/BB3JK/47/
  */
  // $('#filters select').each(function(){
  //     var $this = $(this), numberOfOptions = $(this).children('option').length;
  //     $this.addClass('select-hidden'); 
  //     $this.wrap('<div class="select"></div>');
  //     $this.after('<div class="select-styled"></div>');
  //     var $styledSelect = $this.next('div.select-styled');
  //     $styledSelect.text($this.children('option').eq(0).text());
  //     var $list = $('<ul />', {
  //         'class': 'select-options'
  //     }).insertAfter($styledSelect);
  //     for (var i = 0; i < numberOfOptions; i++) {
  //         $('<li />', {
  //             text: $this.children('option').eq(i).text(),
  //             rel: $this.children('option').eq(i).val()
  //         }).appendTo($list);
  //     }
  //     var $listItems = $list.children('li');
  //     // $styledSelect.click(function(e) {
  //     //     alert($styledSelect);
  //     //     e.stopPropagation();
  //     //     $('div.select-styled.active').not(this).each(function(){
  //     //         $(this).removeClass('active').next('ul.select-options').hide();
  //     //     });
  //     //     $(this).toggleClass('active').next('ul.select-options').toggle();
  //     // });
  //     // console.log('$styledSelect');
  //     $styledSelect.click(function(e) {
  //         //alert($styledSelect);
  //         e.stopPropagation();
  //         $('div.select-styled.active').not(this).each(function(){
  //             $(this).removeClass('active').next('ul.select-options').hide();
  //         });
  //         $(this).toggleClass('active').next('ul.select-options').toggle();
  //     });
  //     $('.days .select .select-styled').click(function(e) {
  //         // alert($styledSelect);
  //         e.stopPropagation();
  //         $('div.select-styled.active').not(this).each(function(){
  //             $(this).removeClass('active').next('ul.select-options').hide();
  //         });
  //         $(this).toggleClass('active').next('ul.select-options').toggle();
  //     });
  //   	$('.types .select .select-options li').click(function(e) {
  //         e.stopPropagation();
  //         $styledSelect.text($(this).text()).removeClass('active');
  //         $this.val($(this).attr('rel'));
  //         $list.hide();
  //         //console.log($this.val());
  //         alert($this.val());
  //         $( ".sched-act" ).css( "display", "none" );
  //         var val = $(this).val();
  //         $($this.val()).css('display', 'block');
  //     });
  //     $('.days .select .select-options li').click(function(e) {
  //         e.stopPropagation();
  //         $('.select-styled .dayz').text($(this).text()).removeClass('active');
  //         // $this.val($(this).attr('rel'));
  //         $('.days .select-options').hide();
  //         //console.log($this.val());
  //         // alert($this.val());
  //         var rel = $(this).attr('rel');
  //         $( ".js-day" ).css( "display", "none" );
  //         // var val = $(this).val();
  //         //alert(rel);
  //         $(rel).css('display', 'block');
  //     });
  //     $(document).click(function() {
  //         $styledSelect.removeClass('active');
  //         $list.hide();
  //     });
  // });

  /* NAVIGATION */

  $(".menu-toggle").on("click", function (e) {
    e.preventDefault();
    $("body").addClass("nav-open");
    $("#site-navigation").addClass("open");
  });
  $("#closeNav,#overlay").on("click", function (e) {
    e.preventDefault();
    $("body").removeClass("nav-open");
    $("#site-navigation").removeClass("open");
    $("#site-navigation *").removeClass("open");
    $("#site-navigation li.parent-link").removeClass("active");
    $("#site-navigation").removeClass("child-open");
  });
  $("#closeNavChild").on("click", function (e) {
    e.preventDefault();
    $("#childrenNavs").removeClass("open");
    $(".children-group").removeClass("open");
    $("#site-navigation li.parent-link").removeClass("active");
    $("#site-navigation").removeClass("child-open");
  });
  $(document).on("click", ".navigation .has-children a.parentlink", function (e) {
    e.preventDefault();
    var link = $(this).attr("href");

    if (link == '#') {
      var child_menu = $(this).attr("data-parent");
      $("#site-navigation li.parent-link").removeClass("active");
      $(".children-group").removeClass("open");

      if ($(".children-group" + child_menu).length > 0) {
        $("#site-navigation").addClass("child-open");
        $("#childrenNavs").addClass("open");
        $(".children-group" + child_menu).addClass("open");
        $(this).addClass("active");
        $(this).parents("li").addClass('active');
      }
    }
  });
  $('[data-fancybox]').fancybox({
    touch: true,
    hash: false,
    youtube: {
      controls: 0,
      showinfo: 0,
      rel: 0
    },
    vimeo: {
      color: 'ffffff'
    }
  });
  $('.zoom-image').fancybox({
    buttons: ['fullScreen', 'close'],
    hash: false
  });
  var windowHeight = $(window).scrollTop();

  if (windowHeight > 200) {
    $("body").addClass('scrolled');
  }

  $(window).scroll(function () {
    var wHeight = $(window).scrollTop();

    if (wHeight > 200) {
      $("body").addClass('scrolled');
    } else {
      $("body").removeClass('scrolled'); //$('body').removeClass('subnav-clicked');
    }
  });

  if ($("#banner").length > 0 && $("#pageTabs").length > 0) {
    $(window).scroll(function () {
      var tabsHeight = $("#pageTabs").height();

      if ($(".main-description").length > 0) {
        var main = $(".main-description").height();
        tabsHeight = main;
      }

      var bannerHeight = $("#banner").height();
      var screenOffset = bannerHeight + tabsHeight;
      var wHeight = $(window).scrollTop();

      if (wHeight > screenOffset) {
        $("#pageTabs").addClass('fixed-top');
      } else {
        $("#pageTabs").removeClass('fixed-top');
      }
    });
  } // if( $(".subpage-sliders").length > 0 ) {
  // 	$('.subpage-sliders').flexslider({
  // 		animation: "fade",
  // 		smoothHeight: true
  // 	});
  // }
  // 


  if ($(".video__vimeo").length > 0) {
    $(".video__vimeo").each(function () {
      var target = $(this);
      var vimeoURL = $(this).attr("data-url");
      var apiURL = 'https://vimeo.com/api/oembed.json?url=' + vimeoURL;
      $.get(apiURL, function (data) {
        var thumbnail = data.thumbnail_url;
        target.css("background-image", "url('" + thumbnail + "')");
      });
    });
  }

  var is_video_playing = false;
  var $slides = $('.flexslider .slides li');

  if ($slides.length > 0) {
    $slides.eq(1).add($slides.eq(-1)).find('img.lazy').each(function () {
      var src = $(this).attr('data-src');
      $(this).removeClass('lazy');
      $(this).attr('src', src).removeAttr('data-src');
    });
  }

  var slideShow = $('.flexslider').flexslider({
    animation: "fade",
    smoothHeight: true,
    before: function before(slider) {
      var $slides = $(slider.slides),
          index = slider.animatingTo,
          current = index,
          nxt_slide = current + 1,
          prev_slide = current - 1;

      if ($slides.length > 0) {
        $slides.eq(current).add($slides.eq(nxt_slide)).add($slides.eq(prev_slide)).find('img.lazy').each(function () {
          var src = $(this).attr('data-src');
          $(this).removeClass('lazy');
          $(this).attr('src', src).removeAttr('data-src');
        });

        if ($slides.eq(current).find('.videoIframe').length > 0) {
          $(".videoIframeDiv").removeClass("playing");
          $(".videoIframe").hide();
          $("body").addClass("current-slide-is-video");
        } else {
          $("body").removeClass("current-slide-is-video");
        }
      }
    },
    start: function start(slider) {
      var $slides = $(slider.slides);

      if ($slides.length > 0) {
        play_flexslider_video(slider);
      }
    }
  });
  $(document).on("click", ".flex-next, .flex-prev", function (e) {
    e.preventDefault();

    if ($("iframe.videoIframe").length > 0) {
      $("iframe.videoIframe").each(function () {
        var type = $(this).attr("data-vid");

        if (type == 'youtube') {
          var parent = $(this).parents(".videoIframeDiv");
          var embedURL = parent.find(".playVidBtn").attr("data-embed");

          if (e.target.outerText == 'Next') {
            $(this).attr("src", embedURL);
          }
        } else if (type == 'vimeo') {
          var iframe = $(this)[0];
          var player = new Vimeo.Player(iframe);
          player.pause();
        }
      });
    }
  });

  function play_flexslider_video(slider) {
    $(document).on("click", ".playVidBtn", function (e) {
      e.preventDefault();
      var type = $(this).attr("data-type");
      var parent = $(this).parents(".videoIframeDiv");

      if (type == 'youtube') {
        var iframeSRC = $(this).attr("data-embed");
        parent.find("iframe.videoIframe")[0].src += "&autoplay=1"; //parent.find("iframe.videoIframe").attr("src",iframeSRC+"&autoplay=1");

        parent.addClass("playing");
        parent.find("iframe.videoIframe").fadeIn();
        is_video_playing = true;
        slider.stop();
      } else if (type == 'vimeo') {
        var iframe = parent.find("iframe.videoIframe")[0];
        var player = new Vimeo.Player(iframe);
        parent.addClass("playing");
        parent.find("iframe.videoIframe").fadeIn();
        player.play();
        slider.stop();
      }
    });
  }
  /* Today (Top) */
  // $(".topinfo .today a").on("click",function(e){
  // 	e.preventDefault();
  // 	$(".topinfo .today").toggleClass("open");
  // });
  // $(".topinfo .today a").hover(
  // 	function(){
  // 		$(".topinfo .today").addClass("open");
  // 	}, function(){
  // 		//$(".topinfo .today").removeClass("open");
  // 	}
  // );


  $(document).on('click', function (e) {
    var tag = $(this);
    var exceptions = ['todayToggle', 'todayLink', 'todayTxt', 'today-options'];
    var elementId = e.target.id;
    var is_open = false;

    if (elementId == 'today-options') {
      $(".topinfo .today").addClass("open");
    } else {
      if ($.inArray(elementId, exceptions) != -1) {
        if ($(".topinfo .today").hasClass("open")) {
          $(".topinfo .today").removeClass("open");
        } else {
          $(".topinfo .today").addClass("open");
        }
      } else {
        $(".topinfo .today").removeClass("open");
      }
    }
  });
  $('a[href*="#"]:not([href="#"])').click(function () {
    var headHeight = $("#masthead").height();
    var offset = headHeight + 80;

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - offset
        }, 1000);
        return false;
      }
    }
  });
  /* Load More */

  $(document).on("click", "#loadMoreBtn", function (event) {
    event.preventDefault();
    var loadButton = $(this);
    var pageURL = _typeof2($("a.page-numbers").eq(0)) != undefined ? $("a.page-numbers").attr("href") : '';
    var current_page = $(this).attr("data-current");
    var next_page = parseInt(current_page) + 1;
    var last_page = $(this).attr("data-end");

    if (pageURL) {
      var parts = pageURL.split("pg=");
      var num = parts[1];
      var url = pageURL.replace('pg=' + num, 'pg=' + next_page);
      loadButton.attr("data-current", next_page);
      $(".next-posts").load(url + " .posts-inner .flex-inner", function () {
        var htmlContent = $(".next-posts .flex-inner").html();
        $("#data-container .flex-inner").append(htmlContent);
        $(".next-posts").html("");

        if (next_page == last_page) {
          $(".loadmorediv").html('').hide();
        }
      });
    }
  });
  $('#playYoutube').on('click', function (ev) {
    $(this).hide();
    $(".videoIframeDiv").addClass('play_video');
    $(".videoIframe")[0].src += "&autoplay=1";
    $("#banner").addClass("video-playing");
    ev.preventDefault();
  });
  $('.select-single').select2();
  /*
  *
  *	Wow Animation
  *
  ------------------------------------*/

  new WOW().init();
  $('.js-blocks').matchHeight();
  $('.js-title').matchHeight();
  $(document).on("click", "#toggleMenu", function () {
    $(this).toggleClass('open');
    $('body').toggleClass('open-mobile-menu');
  });
  /* Search Form (Header) */

  $(document).on("click", "#topsearchBtn", function (e) {
    e.preventDefault();
    $("#topSearchBar form").submit();
  });
  $(document).on("click", "#searchHereBtn", function (e) {
    e.preventDefault();
    $(this).toggleClass('search-open');
    $('#topSearchBar').toggleClass('show');
    $('body').toggleClass('search-form-open');
    $("input.search-field").focus();
  });
  $(document).on("click", "#closeTopSearch", function (e) {
    e.preventDefault();
    $('#searchHereBtn').removeClass('search-open');
    $('#topSearchBar').removeClass('show');
    $('body').removeClass('search-form-open'); //$("input.search-field").val("");
  });
  /* Footer Subscribe Form */

  $('#footSubscribeForm input[type="email"]').on("focus", function () {
    $("#footSubscribeForm").addClass('input-focus');
  });
  $('#footSubscribeForm input[type="email"]').on("focusout blur", function () {
    $("#footSubscribeForm").removeClass('input-focus');
  });
  /* Ajax Load More */

  $(document).on("click", "#loadMoreBtn2", function (e) {
    e.preventDefault();
    var moreButton = $(this);
    var target = $(this);
    var perpage = target.attr("data-perpage");
    var posttype = target.attr("data-posttype");
    var paged = target.attr("data-page");
    var base_url = target.attr("data-baseurl");
    var next_page = parseInt(paged) + 1;
    var total_pages = target.attr("data-totalpages");
    var total = parseInt(total_pages);
    target.attr("data-page", next_page);
    var pageURL = currentURL + '?pg=' + paged;
    $("#tempContainer").load(pageURL + " #postLists", function () {
      if ($("#tempContainer #postLists").length > 0) {
        var entries = $("#tempContainer #postLists").html();
        $(".wait").show();
        setTimeout(function () {
          $(entries).appendTo(".archive-posts-wrap #postLists");
          $(".wait").hide();
        }, 600);

        if (next_page > total) {
          moreButton.hide();
        }
      } else {
        moreButton.hide();
      }
    }); // $.ajax({
    // 	url : frontajax.ajaxurl,
    // 	type : 'post',
    // 	dataType : "json",
    // 	data : {
    // 		action 	: 'posts_load_more',
    // 		perpage : perpage,
    // 		baseurl : base_url,
    // 		posttype : posttype,
    // 		paged: paged
    // 	},
    // 	beforeSend:function(){
    // 		$("#loadMoreBtn2").hide();
    // 		$(".wait").show();
    // 	},
    // 	success:function( obj ) {
    // 		if(obj.result) {
    // 			setTimeout(function(){
    // 				$("#loadMoreBtn2").show();
    // 				$(".wait").hide();
    // 				$("#postLists").append(obj.result);
    // 				if(next_page>total_pages) {
    // 					$(".morebuttondiv").remove();
    // 				}	 
    // 			},800);
    // 		} else {
    // 			$("#loadMoreBtn2").hide();
    // 			$(".wait").hide();
    // 		}
    // 	},
    // 	error:function() {
    // 		$("#loadMoreBtn2").hide();
    // 		$(".wait").show();
    // 	}
    // });
  });
  /* Ajax Load More */

  $(document).on("click", "#loadMoreBtn3", function (e) {
    e.preventDefault();
    var moreButton = $(this);
    var target = $(this);
    var perpage = target.attr("data-perpage");
    var posttype = target.attr("data-posttype");
    var paged = target.attr("data-page");
    var base_url = target.attr("data-baseurl");
    var next_page = parseInt(paged) + 1;
    var total_pages = target.attr("data-totalpages");
    var total = parseInt(total_pages);
    target.attr("data-page", next_page);
    var url = window.location.href;
    var countparams = url.split("=");
    var newURL = currentURL + '?pg=' + paged;
    var nextURL = currentURL + '?pg=' + next_page;

    if (countparams.length > 1) {
      var str = url.replace(currentURL, '');
      newURL += str.replace('?', '&');
      nextURL += str.replace('?', '&');
    }

    $("#tempContainer").load(newURL + " #postLists", function () {
      if ($("#tempContainer #postLists").length > 0) {
        var entries = $("#tempContainer #postLists").html();
        $(".wait").show();
        setTimeout(function () {
          $(entries).appendTo(".archive-posts-wrap #postLists");
          $(".wait").hide();
        }, 500);

        if (paged >= total) {
          moreButton.hide();
        }
      }
    });
    /* Hide More Button if end of records */

    $("#tempNext").load(nextURL + " #postLists", function () {
      if ($("#tempNext #postLists").length == 0) {
        moreButton.hide();
      }
    });
  });
  $(document).on("change", "select.facetwp-dropdown", function () {
    var opt = $(this).val();

    if ($(".morebuttondiv").length > 0) {
      $(".morebuttondiv").load(currentURL + " .moreBtnSpan", function () {});
    }
  });

  if ($("#filter-form").length > 0) {
    $(document).on("change", ".select-filter", function (e) {
      e.preventDefault();
      var opt = $(this).val();
      var name_sel_att = $(this).attr("name");
      var url = $("input#baseurl_input").val();
      var params = '';
      var n = 1;
      $(".select-filter").each(function () {
        var nameAtt = $(this).attr("name");
        var delimiter = n == 1 ? '?' : '&';
        var val = $(this).find("option:selected").val();
        params += delimiter + nameAtt + "=" + val;
        n++;
      });
      var base_url = url + params;
      $("#loaderDiv").addClass("show");
      $("#load-post-div").load(base_url + " #load-data-div", function () {
        $('.select-single').select2();
        setTimeout(function () {
          $("#loaderDiv").removeClass("show");
        }, 600);
      });
    });
  }
  /* Align Bottom Page Vertically Center */


  if ($(".explore-other-stuff").length > 0) {
    var totalEntries = $(".explore-other-stuff .entry").length;
    $(".explore-other-stuff .post-type-entries").addClass('column-list-' + totalEntries);
  }
  /* Ajax Load More */


  $('a[href*="#"]:not([href="#"])').click(function () {
    var headHeight = $("#masthead").height();
    var offset = headHeight + 80;

    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');

      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top - offset
        }, 1000);
        return false;
      }
    }
  });

  if (typeof params.pid != 'undefined' && params.pid != null) {
    if ($(".faqpid-" + params.pid).length > 0) {
      view_faqs_info(params.pid);
    }
  }

  $(document).on("click", ".faqGroup", function (e) {
    e.preventDefault();
    $(".faqGroup").removeClass('active');
    var postid = $(this).attr("data-id");
    $(this).addClass('active');
    view_faqs_info(postid);
  });

  function view_faqs_info(postid) {
    var headHeight = $("#masthead").height();
    var offset = headHeight + 80;
    var target = $("#faqItems");
    target.show();
    $('html, body').animate({
      scrollTop: target.offset().top - offset
    }, 1000);
    $.ajax({
      url: frontajax.ajaxurl,
      type: 'post',
      dataType: "json",
      data: {
        action: 'get_faq_group',
        post_id: postid
      },
      beforeSend: function beforeSend() {
        $("#loaderDiv").appendTo(".main-faq-items");
        $("#loaderDiv").show();
      },
      success: function success(obj) {
        if (obj.result) {
          $("#faqsContainer").html(obj.result);
          setTimeout(function () {
            $("#loaderDiv").hide();
          }, 500);
          var newURL = currentURL + '?pid=' + postid;
          history.replaceState('', document.title, newURL);
        }
      },
      error: function error() {
        $("#loaderDiv").hide();
      }
    });
  }
  /* More FAQs */


  $(document).on("click", ".morefaqsBtn", function (e) {
    e.preventDefault();
    var morefaqs = $(".morefaqs");
    morefaqs.hide();
    $(".faq-item").each(function () {
      if ($(this).hasClass('hide-faq')) {
        $(this).removeClass('hide-faq').addClass("animated fadeIn");
      }
    });
  });
  /* Load More Entries:
  	 - Race Series 
  */

  $(document).on("click", "#loadMoreEntries", function (e) {
    e.preventDefault();
    var d = new Date();
    var current = $(this).attr('data-current');
    var next = parseInt(current) + 1;
    var totalPages = $(this).attr('data-total-pages');
    $(this).attr('data-current', next);

    if ($("#pagination a.page-numbers").length > 0) {
      var baseURL = $("#pagination a.page-numbers").eq(0).attr("href");
      var parts = baseURL.split("pg=");
      var newURL = parts[0] + 'pg=' + next;
      var nxt = next + 1;
      $("#loaderDiv").show();
      $(".next-posts").load(newURL + " .result", function () {
        var content = $(".next-posts").html();
        $('.next-posts .postbox').addClass("animated fadeIn").appendTo("#data-container .result");
        setTimeout(function () {
          $("#loaderDiv").hide();
        }, 500);
      });

      if (next == totalPages) {
        $(".loadmorediv").hide();
      }
    }
  });
  $(".js-select2").select2({
    closeOnSelect: false,
    placeholder: "Select...",
    allowHtml: true,
    allowClear: true,
    tags: true
  }); // if( $("select.js-select").length>0 ) {
  // 	$("select.js-select").each(function(){
  // 		var selectID = $(this).attr("id");
  // 		$("select#"+selectID).select2({
  // 			closeOnSelect : false,
  // 			placeholder : "Select...",
  // 			allowHtml: true,
  // 			allowClear: true,
  // 			tags: true,
  // 			width: 'resolve'
  // 		});
  // 	});
  // }

  $(document).on("click", ".select2-selection--multiple", function (e) {
    var selectdiv = $(".customselectdiv").innerWidth();
    var w = selectdiv + 2;
    $(".select2-container--default").css("width", w + "px");
  });
  /* Smooth Scrolling */

  $('a[href*="#"]') // Remove links that don't actually link to anything
  .not('[href="#"]').not('[href="#0"]').click(function (event) {
    // On-page links
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); // Does a scroll target exist?

      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function () {
          // Callback after animation
          // Must change focus!
          var $target = $(target); //$target.focus();

          if ($target.is(":focus")) {
            // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
            //$target.focus(); // Set focus again
          }

          ;
        });
      }
    }
  });
}); // END #####################################    END