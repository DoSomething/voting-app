var Layzr = require('layzr.js');

/**
 * Initialize lazy loading!
 * @type {Layzr}
 */
var lazyr = new Layzr({
  selector: '[data-src]',
  attr: 'data-src',
  threshold: 50,
  callback: function() {
    this.style.opacity = 1;
  }
});


module.exports = lazyr;
