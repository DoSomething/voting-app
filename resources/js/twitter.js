/**
 * Open Facebook and Twitter share dialogs.
 */

var $ = require('jquery');

var windowOptions = 'scrollbars=yes,resizable=yes,toolbar=no,location=yes',
  width = 550,
  height = 420,
  winHeight = screen.height,
  winWidth = screen.width;

function handleIntent(e) {
  var left = Math.round((winWidth / 2) - (width / 2));
  var top = 0;

  if (winHeight > height) {
    top = Math.round((winHeight / 2) - (height / 2));
  }

  window.open(this.href, 'intent', windowOptions + ',width=' + width +
  ',height=' + height + ',left=' + left + ',top=' + top);

  e.preventDefault();
}

$('body').on('click', 'a.js-share-link', handleIntent);
