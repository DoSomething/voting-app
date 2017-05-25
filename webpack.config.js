const webpack = require('webpack');
const configure = require('@dosomething/webpack-config');
const path = require('path');

// Load any environment variables from `.env`.
require('dotenv').config();

// Configure Webpack using `@dosomething/webpack-config`.
module.exports = configure({
  entry: {
    app: './resources/assets/js/app.js',
  },
  output: {
    // Override output path for Laravel's "public" directory.
    path: path.join(__dirname, '/public/assets'),
  },

  module: {
    loaders: [
      { enforce: 'pre', test: /\.js$/, use: 'eslint-loader', exclude: /node_modules/ }
    ],
  },
});
