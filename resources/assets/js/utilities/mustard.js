/**
 * We only run client-side enhancements on capable browsers, opting
 * to provide a simpler server-rendered experience for users on older
 * browsers (such as Internet Explorer 8).
 *
 *  - document.querySelector: This allows us make queries against the DOM
 *    without the weight of a big library like jQuery. It's well supported in
 *    all modern browsers, and supported in Internet Explorer 9+.
 *
 *  - window.addEventListener: This is part of DOM Level 2 events, and is
 *    supported by every modern browser (except IE 8). It is required by
 *    the DOM delegation library that we use on Voting App.
 *
 * See the original BBC post on 'Cutting The Mustard' for further rationale:
 * http://responsivenews.co.uk/post/18948466399/cutting-the-mustard
 *
 */
const mustard = ('querySelector' in document && 'addEventListener' in window);

/**
 * Determine whether the user's browser cuts the mustard, and run either a
 * success or (optional) failure handler.
 * @param success - Success handler
 * @param failure - Failure handler
 */
function cutTheMustard(success, failure = function() {}) {
  if(mustard) {
    success();
  } else {
    failure();
  }
}

export default cutTheMustard;
