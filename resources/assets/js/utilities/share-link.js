import delegate from 'dom-delegate';

const width = 550;
const height = 420;
const winHeight = screen.height;
const winWidth = screen.width;

/**
 * Open Facebook and Twitter share dialogs.
 */
function initialize() {
  delegate(document.body).on('click', '.js-share-link', function() {
    event.preventDefault();

    const left = Math.round((winWidth / 2) - (width / 2));
    let top = 0;

    if (winHeight > height) {
      top = Math.round((winHeight / 2) - (height / 2));
    }

    window.open(this.href, 'intent', `scrollbars=yes,resizable=yes,toolbar=no,
      location=yes,width=${width},height=${height},left=${left},top=${top}`);
  });
}

export default { initialize };
