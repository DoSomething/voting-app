import React from 'react/addons';

// Utilities
import ready from './utilities/dom-ready';
import confirm from './utilities/confirm';
import formLoader from './utilities/form-loader';
import methodLink from './utilities/method-link';
import cutTheMustard from './utilities/mustard';
import shareLink from './utilities/share-link';

// Components
import CandidateIndex from './components/CandidateIndex';

/**
 * Cut the mustard, wait for DOM load, & start the application.
 *
 * We do not initialize the client-side application if the user is running
 * an older browser (such as IE8), instead defaulting to the classic
 * server-rendered view.
 */
cutTheMustard(function() {
  ready(function() {

    // Initialize popups for social sharing links.
    shareLink.initialize();

    // Initialize `data-confirm` link handler.
    confirm.initialize();

    // Prevent form double submission.
    formLoader.initialize();

    // Initialize `data-method` link handler.
    methodLink.initialize();

    // Render the gallery if we're on a gallery page
    const gallery = document.getElementById('gallery');
    if(gallery) {
      const categories= JSON.parse(document.getElementById('gallery-json').innerHTML);
      React.render(<CandidateIndex categories={categories} />, gallery);
    }

  });
});
