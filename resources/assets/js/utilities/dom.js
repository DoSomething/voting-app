/**
 * Get element's height including margin.
 * @param {HTMLElement} element - Element to be measured
 * @returns {number}
 */
export function outerHeight(element) {
  let height = element.offsetHeight;
  const style = getComputedStyle(element);

  height += parseInt(style.marginTop, 10) + parseInt(style.marginBottom, 10);
  return height;
}

/**
 * Get the pixel offset of a given DOM element on the page.
 * @param {HTMLElement} element - Element to be measured
 * @returns {number} - Pixel offset from top of page
 */
export function getOffset(element) {
  let el = element;
  let offsetTop = 0;

  do {
    if (!isNaN(el.offsetTop)) {
      offsetTop += el.offsetTop;
    }
  } while (el = el.offsetParent);

  return offsetTop;
}

/**
 * Perform an animate using `requestAnimationFrame`.
 * @param {function} callback - Callback to render each frame of the animation
 * @param {function} finalCallback - Optional callback used for final animation frame
 * @param {number} time - Time in seconds (defaults to 1)
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
      callback(progress, easing);
    } else {
      finalCallback();
    }

    callback(progress, easing);
  }

  // Initiate animation loop.
  tick();
}

/**
 * Animate scrolling the viewport to a given offset.
 * @param {number} scrollTargetY - Y pixel offset to scroll to
 * @param {number} speed - Speed of animation
 */
export function scrollToY(scrollTargetY = 0, speed = 2000) {
  const scrollY = window.scrollY;

  // min time .1, max time .8 seconds
  const time = Math.max(0.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, 0.8));

  // Animate the browser's `scrollTo` method
  animate(function(progress, easing) {
    window.scrollTo(0, scrollY + ((scrollTargetY - scrollY) * easing));
  }, function() {
    // Scrolling is done!
    window.scrollTo(0, scrollTargetY);
  }, time);
}

/**
 * jQuery-less version of jQuery's $.slideDown method.
 * @param {HTMLElement} element - Element to be animated
 * @param {function} callback - Callback to fire upon completion
 */
export function slideDown(element, callback = function() {}) {
  // Measure final height by creating an invisible clone
  // @TODO: This should be measured from within the container...
  const clone = element.cloneNode(true);
  clone.style.width = element.parentNode.offsetWidth;
  clone.style.height = 'auto';
  clone.style.display = 'block';
  clone.style.position = 'absolute';
  clone.style.left = '-9999px';
  document.body.appendChild(clone);

  const targetHeight = outerHeight(clone);

  document.body.removeChild(clone);

  element.style.opacity = 0;

  // ... and animate:
  animate(function(progress, easing) {
    element.style.height = `${targetHeight * easing}px`;
    element.style.opacity = easing;
  }, function() {
    element.style.height = null; /* auto */
    element.style.opacity = 1;
    callback();
  }, 0.25);
}

/**
 * jQuery-less version of jQuery's $.slideUp method.
 * @param {HTMLElement} element - Element to be animated
 * @param {function} callback - Callback to fire upon completion
 */
export function slideUp(element, callback = function() {}) {
  const startHeight = outerHeight(element);

  element.style.opacity = 1;

  animate(function(progress, easing) {
    element.style.height = `${startHeight - (startHeight * easing)}px`;
    element.style.opacity = 1 - (1 * easing);
  }, function() {
    element.style.height = `0px`;
    element.style.opacity = 0;
    callback();
  }, 0.25);
}

export default { scrollToY, slideUp, slideDown, outerHeight, getOffset };
