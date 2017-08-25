/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr, Swiper */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      if ($('.swiper-container').length) {
        Site.Gallery.init();
      }

    });

  },

  onResize: function() {
    var _this = this;

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Gallery = {
  init: function() {
    var _this = this;

    if ($('#slider-holder-install').length) {
      _this.initSwiper('install');
    }
    if ($('#slider-holder-works').length) {
      _this.initSwiper('works');
    }

    _this.bindSwitch();
  },

  initSwiper: function(type) {
    new Swiper ('.swiper-' + type, {
      loop: true,
      slidesPerView: 'auto',
      loopedSlides: 5,
      spaceBetween: 0,
      centeredSlides: true,
      slideToClickedSlide: true,
      nextButton: '.slider-next-' + type,
      prevButton: '.slider-prev-' + type,
    });
  },

  bindSwitch: function() {
    $('.slider-switch').on('click', function() {
      if (!$(this).hasClass('.active')) {
        var type = $(this).attr('data-target');

        $('.slider-switch, .slider-holder, .slider-buttons').removeClass('active');
        $(this).addClass('active');
        $('#slider-holder-' + type + ', #slider-buttons-' + type).addClass('active');
      } else {
        return;
      }
    });
  }
};

Site.init();
