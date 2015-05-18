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
