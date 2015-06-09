import delegate from 'dom-delegate';

/**
 * Add confirmation dialog to links with `data-confirm` attribute.
 */
delegate(document.body).on('click', '*[data-confirm]', function(event) {
  const response = confirm(this.getAttribute('data-confirm'));

  if(!response) {
    event.stopImmediatePropagation();
    return false;
  }

  return response;
});
