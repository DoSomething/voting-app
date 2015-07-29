'use strict';

/**
 * Register the Babel require hook. This will transpile
 * ES6 files to ES5 on-the-fly.
 *
 * @see https://babeljs.io/docs/usage/require/
 */
require('babel/register')({
  optional: ["es7.classProperties"]
});

/**
 * Bootstrap our server process. This is responsible for
 * pre-rendering React views for our templates.
 */
var app = require('../resources/assets/js/server');
app.listen(3000, function() {
  console.log('React renderer started on port 3000');
});
