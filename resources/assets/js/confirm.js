var $ = require('jquery');

$(document).ready(function() {

  // Add confirmation dialog to links with `data-confirm` attribute.
  $('[data-confirm]').on('click', function(event) {
    var response = confirm($(this).data('confirm'));

    if(!response) {
      event.stopImmediatePropagation();
      return false;
    }

    return response;
  });

});
