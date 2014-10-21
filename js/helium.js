(function($, window, undefined){
  $(document).foundation();
  
  $(document).ready(function(){
      $('.fullscreen').height($(window).height());
      $('.fullscreen').width($(window).width());
      if (typeof $.fn.videofit != 'undefined'){
         $('.videofit').videofit({
          container : '.dc-slider'
         });
      }
      if (typeof $.fn.dcslider != 'undefined'){
         $('.dc-slider').dcslider({
                effect : 'crossfading',
                pauseOnHover : true,
                afterChange : function($active, $moveTo){
                  if ( $moveTo.hasClass('light') ){
                    var $slider = $moveTo.closest('.dc-slider');
                    if($slider.hasClass('dark-scheme')){
                      $slider.removeClass('dark-scheme');
                    }
                    $slider.addClass('light-scheme');
                  }else{
                    var $slider = $moveTo.closest('.dc-slider');
                    if($slider.hasClass('light-scheme')){
                      $slider.removeClass('light-scheme');
                    }
                    $slider.addClass('dark-scheme');
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
  });
}(jQuery, window));
