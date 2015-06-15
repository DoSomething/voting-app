import React from 'react';
import express from 'express';
import bodyParser from 'body-parser';
import path from 'path';

/**
 * Set up Express.
 */
const app = express();
app.use(bodyParser.json());

/**
 * Simple error handler.
 */
app.use(function(err, req, res, next) {
  console.error(err.stack);
  res.status(500).send('Something broke!');
});

app.use('/:component', function(request, response) {
  const component = require(path.resolve('./resources/assets/js/components/' + request.params.component));
  const props = request.body || null;

  response.status(200).send(
    React.renderToString(
      React.createElement(component, props)
    )
  );
});

export default app;

