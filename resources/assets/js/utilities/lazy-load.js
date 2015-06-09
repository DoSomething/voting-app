import Layzr from 'layzr.js';

/**
 * Initialize lazy loading!
 * @type {Layzr}
 */
export default new Layzr({
  selector: '[data-src]',
  attr: 'data-src',
  threshold: 50,
  callback: function() {
    this.style.opacity = 1;
  }
});
