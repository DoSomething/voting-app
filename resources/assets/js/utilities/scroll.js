/**
 * Animate scrolling the viewport to a given offset.
 * @param scrollTargetY - Y offset to scroll to
 * @param speed - Speed of animation
 */
export function scrollToY(scrollTargetY = 0, speed = 2000) {
  const scrollY = window.scrollY;

  // min time .1, max time .8 seconds
  const time = Math.max(.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, .8));

  // Animate the browser's `scrollTo` method
  animate(function(progress, easing) {
    window.scrollTo(0, scrollY + ((scrollTargetY - scrollY) * easing));
  }, function() {
    // Scrolling is done!
    window.scrollTo(0, scrollTargetY);
  }, time);
}

/**
 * Perform an animate using `requestAnimationFrame`.
 * @param callback - Callback to render each frame of the animation
 * @param finalCallback - Optional callback used for final animation frame
 * @param time - Time in seconds (defaults to 1)
 */
export function animate(callback, finalCallback = callback, time = 1) {
  let currentTime = 0;

  // Animation loop method.
  function tick() {
    currentTime += 1 / 60;

    /**
     * Progress for this frame of the animation (between 0 and 1).
     * @type {number}
     */
    const progress = currentTime / time;

    /**
     * Progress, adjusted to gently ease-out.
     * @type {number}
     */
    const easing = Math.sin(progress * (Math.PI / 2));

    if (progress < 1) {
      window.requestAnimationFrame(tick);
      callback(progress, easing)
    } else {
      finalCallback();
    }

    callback(progress, easing);
  }

  // Initiate animation loop.
  tick();
}

/**
 * Get the pixel offset of a given DOM element on the page.
 * @param {object} element
 * @returns {number} - Pixel offset from top of page
 */
export function getOffset(element) {
  let offsetTop = 0;

  do {
    if(!isNaN(element.offsetTop)) {
      offsetTop += element.offsetTop;
    }
  } while(element = element.offsetParent);

  return offsetTop;
}

export default { scrollToY, getOffset };
