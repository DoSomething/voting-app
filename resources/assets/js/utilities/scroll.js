/**
 * Animate scrolling the viewport to a given offset.
 * @see http://stackoverflow.com/a/26798337
 * @param scrollTargetY - Y offset to scroll to
 * @param speed - Speed of animation
 */
export function scrollToY(scrollTargetY = 0, speed = 2000) {
  const scrollY = window.scrollY;
  let currentTime = 0;

  // min time .1, max time .8 seconds
  const time = Math.max(.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, .8));

  // Animation loop method.
  function tick() {
    currentTime += 1 / 60;

    const p = currentTime / time;
    const t = Math.sin(p * (Math.PI / 2));

    if (p < 1) {
      window.requestAnimationFrame(tick);
      window.scrollTo(0, scrollY + ((scrollTargetY - scrollY) * t));
    } else {
      // Scrolling is done!
      window.scrollTo(0, scrollTargetY);
    }
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
