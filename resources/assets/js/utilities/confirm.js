/* eslint no-alert:0 */

import delegate from 'dom-delegate';

/**
 * Add confirmation dialog to links with `data-confirm` attribute.
 */
function initialize() {
  delegate(document.body).on('click', '*[data-confirm]', function(event) {
    const response = confirm(this.getAttribute('data-confirm'));

    if (!response) {
      event.stopImmediatePropagation();
      return false;
    }

    return response;
  });
}

export default { initialize };
