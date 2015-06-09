import $ from 'jquery';

/**
 * Add confirmation dialog to links with `data-confirm` attribute.
 */
$(document).on('click', '[data-confirm]', function(event) {
  const response = confirm($(this).data('confirm'));

  if(!response) {
    event.stopImmediatePropagation();
    return false;
  }

  return response;
});
