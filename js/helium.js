(function($, window, undefined){
  $(document).foundation();
  var helium = {};

  helium.socialShare = function(){
  
    if( $('a.facebook-share').length > 0 || $('a.twitter-share').length > 0 || $('a.pinterest-share').length > 0) {
      $('a.facebook-share').each(function(){
        var $this = $(this);
        $.getJSON("http://graph.facebook.com/?id="+ $this.data('target') +'&callback=?', function(data) {
          if((data.shares != 0) && (data.shares != undefined) && (data.shares != null)) { 
            $this.find('a span.count, span.count').html( data.shares ); 
          }
          else {
            $this.find('a span.count, span.count').html( 0 ); 
          }
        });
      });
      
      $('.facebook-share').click(function(e){
        var $this = $(this);
        window.open( 'https://www.facebook.com/sharer/sharer.php?u='+ $this.data('target'), "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
        return false;
      });
      
      $('a.twitter-share').each(function(){
        var $this = $(this);
        $.getJSON('http://urls.api.twitter.com/1/urls/count.json?url='+$this.data('target')+'&callback=?', function(data) {
          if((data.count != 0) && (data.count != undefined) && (data.count != null)) { 
            $this.find('a span.count, span.count').html( data.count );
          }
          else {
            $this.find('a span.count, span.count').html( 0 );
          }
        });
      });
      
      $('.twitter-share').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var article = $this.closest('article');
        var $pageTitle = article.find('.post-title a').length ?
          encodeURIComponent($.trim(article.find('.post-title a').text())) :
          encodeURIComponent($.trim(article.find('.post-title').text())) ;
        window.open( 'http://twitter.com/intent/tweet?text='+ $.trim($pageTitle) +' '+$this.data('target'), "twitterWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
        return false;
      });
      
      $('.pinterest-share').each(function(){
        var $this = $(this);
        $.getJSON('http://api.pinterest.com/v1/urls/count.json?url='+$this.data('target')+'&callback=?', function(data) {
          if((data.count != 0) && (data.count != undefined) && (data.count != null)) { 
            $this.find('a span.count, span.count').html( data.count );
          }
          else {
            $this.find('a span.count, span.count').html( 0 );
          }
        });
      });
      
      $('.pinterest-share').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var article = $this.closest('article');
        var $sharingImg = article.find('.post-media img').length ? article.find('.post-media img').attr('src') : '';
        var $pageTitle = article.find('.post-title a').length ?
          encodeURIComponent($.trim(article.find('.post-title a').text())) :
          encodeURIComponent($.trim(article.find('.post-title').text())) ;
        window.open( 'http://pinterest.com/pin/create/button/?url='+$this.data('target')+'&media='+$sharingImg+'&description='+$.trim($pageTitle), "pinterestWindow", "height=640,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ); 
        return false;
      });
    }
  }

  $(document).ready(function() {

      $('.fullscreen').height($(window).height());
      $('.fullscreen').width($(window).width());
      if (typeof $.fn.videofit != 'undefined'){
         $('.videofit').videofit({
          container : '.dc-slider'
         });
      }

      if (typeof $.fn.dcslider != 'undefined'){
         var $activeSlider = $('.dc-slider .item.active');
         if($activeSlider.length){
            var currentColor = $activeSlider.hasClass('light') ? 'light-color' : 'dark-color';
            var $mainNav = $('.nav-container');
            if($mainNav.hasClass('light-color')) $mainNav.removeClass('light-color');
            if($mainNav.hasClass('dark-color')) $mainNav.removeClass('dark-color');
            $mainNav.addClass(  currentColor);
         }
         $('.dc-slider').dcslider({
                effect : 'crossfading',
                pauseOnHover : true,
                afterChange : function($active, $moveTo){
                  if($mainNav.hasClass('light-color')) $mainNav.removeClass('light-color');
                  if($mainNav.hasClass('dark-color')) $mainNav.removeClass('dark-color');
                  if ( $moveTo.hasClass('light') ){
                    var $slider = $moveTo.closest('.dc-slider');
                    if($slider.hasClass('dark-scheme')){
                      $slider.removeClass('dark-scheme');
                    }
                    $slider.addClass('light-scheme');
                    $mainNav.addClass('light-color');
                  }else{
                    var $slider = $moveTo.closest('.dc-slider');
                    if($slider.hasClass('light-scheme')){
                      $slider.removeClass('light-scheme');
                    }
                    $slider.addClass('dark-scheme');
                    $mainNav.addClass('dark-color');
                  }
                  var nextIndex = $moveTo.index() + 1;
                  var $slider = $moveTo.closest('.dc-slider');
                  $slider.find('.slide-index').each(function(){
                    $(this).html(nextIndex);
                  });
                }
            });
      }
    if(Modernizr.mq('(min-width: 40.063em)')){
        if($('.fixed-menu-position').length === 0) {
          /* UBER MENU */  
          var liHeight = 0
          $('li.mega-menu > ul.dropdown > li').each(function(idx, val){          
            if($(this).height() > liHeight){
             liHeight = $(this).height();
            }
          });

          $('li.mega-menu > ul.dropdown > li').each(function(idx, val){          
            $(this).height(liHeight);          
          });

            var navClone = $('.nav-container').clone(true)
            .addClass('sticky-nav');       
             
            /*$('.parent-wrapper-nav-sticky > .wrapper-nav-sticky > .top-bar').height(navHeight);
            $('.parent-wrapper-nav-sticky > .wrapper-nav-sticky > .top-bar').css('border', '1px solid red');*/
            $('body').append(navClone);
          
            $(window).scroll(function() {
              if ( $(window).scrollTop()  >= $(window).height()-10 )  {
                var $stickyNav = $('.sticky-nav');
                if( !$stickyNav.hasClass('animated') ){
                  $stickyNav.addClass('animated');
                }
              } else {
                var $stickyNav = $('.sticky-nav');
                if( !$stickyNav.hasClass('reverse') ){
                  $stickyNav.addClass('reverse');
                  setTimeout(function(){
                    $stickyNav.removeClass('animated reverse');
                  },100);
                }                      
              }
            });
            /* END OF SCROLL ANIMATION */ 
          }
          /*** Off sidebar control ***/
          $('.off-sidebar-control').click(function(e){
            e.preventDefault();
            var direction = $(this).hasClass('right-off-sidebar') ? 'left' : 'right';
            var classAnimation = 'off-move-' + direction;
            if($(this).hasClass('sidebar-moved')){
            setTimeout(function(){
                $('.off-sidebar,.main-container,.sticky-nav').removeClass(classAnimation);
              });
              $('.off-sidebar-control').removeClass('sidebar-moved'); 
            }else{
              setTimeout(function(){
                $('.off-sidebar,.main-container,.sticky-nav').addClass(classAnimation);
              });
              $('.off-sidebar-control').addClass('sidebar-moved');
            }
          });
    }

    var topHeaderHeight = $(window).height();
    var $topHeader = $('.top-header-bg');
    if($topHeader.length){
      var color = 'light-color';
      color = $topHeader.hasClass('dark') ? 'dark-color' : color;

      if($topHeader.hasClass('halfscreen')){
        topHeaderHeight = topHeaderHeight/2;
      }

      $topHeader.height(topHeaderHeight);
      $(window).resize(function(){
        $topHeader.height(topHeaderHeight);
      });
      var $mainNav = $('.nav-container:not(.sticky-nav)');
      if($mainNav.hasClass('dark-color')) $mainNav.removeClass('dark-color');
      if($mainNav.hasClass('light-color')) $mainNav.removeClass('light-color');
      $mainNav.addClass(color);
    }

    $('video, audio').each(function(){
      $(this).mediaelementplayer({
      });
    });

    var gallery = $('.dc-gallery');
    if(gallery.length == 0) return;
    // if(typeof manualInvoked == 'undefined' && $('video').length > 0) return;
    gallery.imagesLoaded(function(){
      gallery.flexslider({
        animation : "slide",
        controlNav: false,
      });
    });
    helium.socialShare();
  });
}(jQuery, window));
