import $ from 'jquery';

/**
 * Add a 'loading' indicator and prevent double
 * form submission from over-eager clickers.
 */
$(document).on('submit', 'form', function() {
  $(this).find(':submit')
    .attr('disabled', 'disabled')
    .addClass('-loading');
});
