require('jquery-unveil');
var $ = require('jquery');

/**
 * Lazy load candidate thumbnail images.
 */
$(document).ready(function() {
  $(".tile img").unveil(700, function() {
    $(this).load(function() {
      this.style.opacity = 1;
    })
  });
});
