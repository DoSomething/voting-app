var $ = require('jquery');

$(document).ready(function() {
  var $body = $('body');

  // Allow links to specify a HTTP method using `data-method`
  $('[data-method]').on('click', function(event) {
    event.preventDefault();

    var url = $(this).attr('href');
    var method = $(this).data('method');

    var csrfToken = $('meta[name=csrf-token]').attr('content');

    var $form = $('<form method="post" action="' + url + '"></form>');
    var metadataInput = '<input name="_method" value="' + method + '" type="hidden" />';

    if (csrfToken !== undefined) {
      metadataInput += '<input name="_token" value="' + csrfToken + '" type="hidden" />';
    }

    $form.hide().append(metadataInput);
    $body.append($form);

    $form.submit();
  });
});
