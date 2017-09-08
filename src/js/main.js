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

    if (_this.$sliderHolder.length) {
      Site.Gallery.updateCaption();
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

    if ($('#slider-holder-install').length) {
      _this.initSlick('install');
    }
    if ($('#slider-holder-works').length) {
      _this.initSlick('works');
    }

    _this.bindSwitch();
  },

  initSlick: function(type) {
    var _this = this;

    $('#slick-' + type).on({
      init: function(event, slick, currentSlide) {
        _this.updateCaption(0);
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

  },

  updateCaption: function(activeIndex) {
    // Update caption in slider control row
    // from '.slide-caption' elem in active slide
    if (activeIndex) {
      var caption = $('.slider-holder.active .slick-slide[data-slick-index="' + activeIndex + '"] .slide-caption').html();
    } else {
      var caption = $('.slider-holder.active .slick-active .slide-caption').html();
    }

    if (!caption) {
      caption = '';
    }

    $('.slider-controls-caption').html(caption);
  },

  clearCaption: function() {
    $('.slider-controls-caption').html('');
  },

  bindSwitch: function() {
    var _this = this;

    // Bind 'Installation View' / 'Works' slider toggle
    $('.slider-switch').on('click', function() {
      if (!$(this).hasClass('.active')) {
        var type = $(this).attr('data-target');

        $('.slider-switch, .slider-holder, .slider-buttons').removeClass('active');
        $(this).addClass('active');
        $('#slider-holder-' + type + ', #slider-buttons-' + type).addClass('active');

        _this.updateCaption();
      } else {
        return;
      }
    });
  }
};

Site.Mailchimp = {
  init: function() {
    var _this = this;

    _this.insertPlaceholders();
    _this.rebuildMarkup();
  },

  insertPlaceholders: function() {
    $('.mc-field-group').each(function() {
      var label = $(this).find('label').text();

      // remove asterisks and ending whitespace
      var placeholder = label.replace(/\*/g, '').replace(/\s*$/,'');

      // use new placeholder text for inputs
      $(this).find('input').attr('placeholder', placeholder);
    });
  },

  rebuildMarkup: function() {
    var $parent = $('#mc_embed_signup_scroll');

    // wrap mailchimp elements in grid-item
    $parent.children().not('.clear').wrapAll('<div id="mc-inputs" class="grid-item" />');
    $parent.children('.clear').removeClass('clear').addClass('grid-item');
  },
};

Site.init();
