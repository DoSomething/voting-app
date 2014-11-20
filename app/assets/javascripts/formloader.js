/**
 * Add a 'loading' indicator and prevent double
 * form submission from over-eager clickers.
 */

var $ = require('jquery');

$('form').on('submit', function(e) {
  $(this).find(':submit')
    .attr('disabled', 'disabled')
    .addClass('-loading');
});

/**
 * On page load, re-enable forms. Fixes issue where
 * Firefox will preserve "disabled" state when user
 * hits back button.
 */
$(document).ready(function(e) {
  $('form').each(function(e) {
    $(this).find(':submit')
      .prop('disabled', false)
      .removeClass('-loading');
  })
})

