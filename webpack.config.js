var webpack = require('webpack');
var configurator = require('@dosomething/webpack-config');
var CopyWebpackPlugin = require('copy-webpack-plugin');

var config = configurator({
  entry: {
    'app': './resources/assets/js/app.js'
  },
});

config.plugins.push(
        new CopyWebpackPlugin([
            { from: 'resources/assets/fonts', to: 'fonts' },
            { from: 'resources/assets/images', to: 'images' },
            {
              from: 'node_modules/html5shiv/dist/html5shiv.min.js',
              to: 'vendor/html5shiv.min.js'
            },
            {
              from: 'node_modules/respond.js/dest/respond.min.js',
              to: 'vendor/respond.min.js'
            },
        ])
)

config.output.path = 'public/assets';

module.exports = config;
