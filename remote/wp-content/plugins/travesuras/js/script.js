( function( $ ) {
  /**
  * Disables all links and changes cursor for the website, used in ajax calls.
  */
  var webStateWaiting = function(waiting){
    if(waiting) {
      $('body').css('cursor', 'progress');
    }
    else {
      $('body').css('cursor', 'default');
    }
    
    $('a').each(function() {
      if(!$(this).hasClass('disabled') && waiting && !$(this).hasClass('language-option') && !$(this).hasClass('menu-end-post-denominacion-a')) {
        $(this).addClass('disabled');	
      }
      else if ($(this).hasClass('disabled') && !waiting && !$(this).hasClass('language-option') && !$(this).hasClass('menu-end-post-denominacion-a')) {
        $(this).removeClass('disabled');
      }
    });
  }

  /*************** Document Ready ********************/
  $(document).ready(function () {
    
    // if($('.page-evaluacion-escenarios').length > 0) {
    //   siscovid_handle_simulacion_fadeIn();
    // }

  });

  /*************** Document Scroll ********************/
  $(window).scroll(function () {});
} (jQuery) );