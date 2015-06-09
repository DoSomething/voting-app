import delegate from 'dom-delegate';

/**
 * Add a 'loading' indicator and prevent double
 * form submission from over-eager clickers.
 */
delegate(document.body).on('submit', 'form', function() {
  var submits = this.querySelectorAll('input[type="submit"], button[type="submit"]')

  Array.prototype.forEach.call(submits, function(button) {
    button.setAttribute('disabled', 'disabled');
    button.addClass('is-loading');
  });
});
