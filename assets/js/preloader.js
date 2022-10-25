
(function ($) {
  "use strict";

  /*================================
  Preloader
  ==================================*/

  var preloader = $('#preloader');
  $(window).on('load', function () {
    setTimeout(function () {
      preloader.fadeOut('slow', function () { $(this).remove(); });
    }, 300)
  });

}) (jQuery);