import $ from 'jquery';

const width = 550;
const height = 420;
const winHeight = screen.height;
const winWidth = screen.width;

/**
 * Open Facebook and Twitter share dialogs.
 */
function handleIntent(event) {
  const left = Math.round((winWidth / 2) - (width / 2));
  let top = 0;

  if (winHeight > height) {
    top = Math.round((winHeight / 2) - (height / 2));
  }

  window.open(this.href, 'intent', `scrollbars=yes,resizable=yes,toolbar=no,
  location=yes,width=${width},height=${height},left=${left},top=${top}`);

  event.preventDefault();
}

$(document).on('click', '.js-share-link', handleIntent);
