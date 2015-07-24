import delegate from 'dom-delegate';

/**
 * Add a 'loading' indicator and prevent double
 * form submission from over-eager clickers.
 */
function initialize() {
  delegate(document.body).on('submit', 'form', function() {
    const submits = this.querySelectorAll('input[type="submit"], button[type="submit"]');

    Array.prototype.forEach.call(submits, function(button) {
      button.setAttribute('disabled', 'disabled');
      button.addClass('is-loading');
    });
  });
}

export default { initialize };
