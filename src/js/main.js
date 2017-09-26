/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr, Swiper */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    _this.$sliderHolder = $('.slider-holder');

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {

      Site.Menu.init();

      if ($('.slick-container').length) {
        Site.Gallery.init();
      }

      if ($('.js-hover-item').length) {
        Site.HoverImages.init();
      }

      if ($('#mc_embed_signup').length) {
        Site.Mailchimp.init();
      }

    });

  },

  onResize: function() {
    var _this = this;

    if ($('.slick-container').length) {
      Site.Gallery.toggleSlick();
    }

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

Site.Menu = {
  init: function() {
    var _this = this;

    _this.$header = $('#header');

    $(document).scroll( function() {
      if( $(this).scrollTop() > 0 ) {
        _this.$header.addClass('stuck');
      } else {
        _this.$header.removeClass('stuck');
      }
    });
  },
};

Site.HoverImages = {
  init: function() {
    var _this = this;

    _this.hoverItems = $('.js-hover-item');

    _this.bind();
  },

  bind: function() {
    var _this = this;

    _this.hoverItems.on({
      'mouseover.hover': function() {
        // handleIn

        var $image = $(this).find('.hover-image');

        $image.addClass('show');

        $(window).on('mousemove.hover', function(event) {
          $image.css({
            'top': (event.pageY - this.pageYOffset) - $image.height() / 2,
            'left': event.pageX -  ($image.width() / 2),
          });
        });

      },
      'mouseleave': function() {
        // handleOut
        var $image = $(this).find('.hover-image');

        $image.removeClass('show');

        $(window).off('mouseover.hover');
      }
    });

  },
};

Site.Gallery = {
  init: function() {
    var _this = this;

    _this.toggleSlick();

    _this.bindSwitch();
  },

  toggleSlick: function(windowWidth) {
    var _this = this;

    var windowWidth = $(window).width();

    console.log(windowWidth);

    if (windowWidth > 720) {
      if ($('#slider-holder-install').length) {
        _this.initSlick('install');
      }
      if ($('#slider-holder-works').length) {
        _this.initSlick('works');
      }
    } else {
      if ($('#slider-holder-install').length) {
        _this.unSlick('install');
      }
      if ($('#slider-holder-works').length) {
        _this.unSlick('works');
      }
    }
  },

  initSlick: function(type) {
    var _this = this;

    if (!$('#slick-' + type).hasClass('slick-initialized')) {
      $('#slick-' + type).on({
        init: function(event, slick, currentSlide) {
          _this.updateCaption(0);
          _this.captionHeight();
        },
        beforeChange: function(event, slick, currentSlide) {
          _this.clearCaption();
        },
        afterChange: function(event, slick, currentSlide) {
          _this.updateCaption(currentSlide);
        }
      }).slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        focusOnSelect: true,
        nextArrow: '.slider-next-' + type,
        prevArrow: '.slider-prev-' + type,
      });
    }

  },

  unSlick: function(type) {
    if ($('#slick-' + type).hasClass('slick-initialized')) {
      $('#slick-' + type).slick('unslick');
    }
  },

  updateCaption: function(activeIndex) {
    var _this = this;

    // Update caption in slider control row
    // with 'data-id' attr in active slide
    if (activeIndex) {
      var imageId = $('.slider-holder.active .slick-slide[data-slick-index="' + activeIndex + '"]').attr('data-id');
    } else {
      var imageId = $('.slider-holder.active .slick-active').attr('data-id');
    }

    _this.clearCaption();

    var $caption = $('[data-id="' + imageId + '"]');

    if ($caption.length) {
      $caption.addClass('show');
    }
  },

  clearCaption: function() {
    $('.slider-controls-caption').removeClass('show');
  },

  captionHeight: function() {
    var topHeight = 0;

    if ($(window).height() > 720) {
      $('.slider-controls-caption').each(function() {
        var thisHeight = $(this).outerHeight();

        if (thisHeight > topHeight) {
          topHeight = thisHeight;
        }
      });

      $('#slider-controls-caption-holder').height(topHeight);
    }
  },

  bindSwitch: function() {
    var _this = this;

    // Bind 'Installation View' / 'Works' slider toggle
    $('.slider-switch').on('click', function() {
      if (!$(this).hasClass('.active')) {
        var type = $(this).attr('data-target');

        $('.slider-switch, .slider-holder, .slider-buttons, .slider-controls-caption-wrapper').removeClass('active');
        $(this).addClass('active');
        $('#slider-holder-' + type + ', #slider-buttons-' + type).addClass('active');
        $('#slider-controls-caption-' + type).addClass('active');

        _this.updateCaption();
      } else {
        return;
      }
    });
  }
};

Site.init();
