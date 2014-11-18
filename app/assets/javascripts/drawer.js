/**
 * Drawar modal
 */

var $ = require('jquery');
var template = require('./templates/candidate.hbs')

var $currentDrawer;

/**
 * Show drawer when clicking a tile.
 */
$('.js-drawer-link').on('click', function(e) {
  e.preventDefault();

  var originalWindowOffset = $(window).scrollTop();

  var $window = $(window);
  var $tile = $(this).parent('.tile');
  var offset = $tile.offset().top;
  $tile.addClass('is-active');

  if($currentDrawer) {
    var $parent = $currentDrawer.parent('.tile');

    if($parent.is($tile)) {
      $parent.removeClass('is-active');
      $parent.addClass("is-animated");
      $parent.css('padding-bottom', '');

      setTimeout(function() {
        $parent.removeClass("is-animated");
      }, 1000);

      $currentDrawer.remove();
      $currentDrawer = null;
      return;
    }

    // If they're on separate rows...
    var parentOffset = $parent.offset().top;
    var tileOffset = $tile.offset().top;
    if(parentOffset !== tileOffset) {
      $parent.addClass("is-animated");
      $tile.addClass("is-animated");

      if(parentOffset < tileOffset) {
        // Moving down the page, so adjust the scroll offset to account for closing drawer.
        offset = offset - $currentDrawer.height();
      }

      setTimeout(function() {
        $parent.removeClass("is-animated");
        $tile.removeClass("is-animated");
      }, 1000);
    }

    $parent.removeClass('is-active');
    $parent.css('padding-bottom', '');

    $currentDrawer.remove();
    $currentDrawer = null;
  }

  var details = template({
    name: $tile.find('h1').text(),
    description: $tile.data('description'),
    image: $tile.find('img').attr('src'),
    form: $("#form-template").html()
  });

  var $details = $('<div class="tile__details"><div class="tile__details__inner">' + details + '</div></div>');

  // Add ID to hidden form input!
  $details.find('input[name="candidate_id"]').val( $tile.data('id') );

  $tile.append($details);
  $tile.css('padding-bottom', $details.height());
  $details.css('opacity', '1');

  $currentDrawer = $details;

  if($(window).scrollTop() < originalWindowOffset) {
    $(window).scrollTop(originalWindowOffset);
  }


  $("html, body").animate({ scrollTop: offset + 150 }, 500);
});


/**
 * Update the drawer height on resize event.
 */
$(window).on('resize', function(e) {
  if($currentDrawer) {
    var $tile = $currentDrawer.parent('.tile');
    $tile.css('padding-bottom', $currentDrawer.height());
  }
});

/**
 * Stop animation on scroll.
 */
$(window).on('scroll touchstart mousedown DOMMouseScroll mousewheel keyup', function(e) {
  if ( e.which > 0 || e.type === 'mousedown' || e.type === 'mousewheel' || e.type === 'touchstart'){
    $('html, body').stop();
  }
});
