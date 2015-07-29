/* eslint no-console:0 */

import React from 'react';
import express from 'express';
import bodyParser from 'body-parser';

/**
 * Set up Express.
 */
const app = express();
app.use(bodyParser.json({ limit: '10mb' }));

/**
 * Simple error handler.
 */
app.use(function(err, req, res, next) {
  console.error(err.stack);
  res.status(500).send('Something broke!');

  next();
});

/**
 * Request pre-rendered markup for a given component
 * with JSON props data.
 *
 * POST /:component
 */
app.use('/:component', function(request, response) {
  const component = require(`./components/${request.params.component}`);
  const props = request.body || null;

  response.status(200).send(
    React.renderToString(
      React.createElement(component, props)
    )
  );
});

export default app;

