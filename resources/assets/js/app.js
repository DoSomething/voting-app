import React from 'react/addons';

// Utilities
import ready from './utilities/dom-ready';
import confirm from './utilities/confirm';
import formLoader from './utilities/form-loader';
import methodLink from './utilities/method-link';
import rehydrate from './utilities/rehydrate';
import shareLink from './utilities/share-link';

// Components
import CandidateIndex from './components/CandidateIndex';
import CategoryIndex from './components/CategoryIndex';

ready(function() {

  // Initialize popups for social sharing links.
  shareLink.initialize();

  // Initialize `data-confirm` link handler.
  confirm.initialize();

  // Prevent form double submission.
  formLoader.initialize();

  // Initialize `data-method` link handler.
  methodLink.initialize();

  // Rehydrate any pre-rendered React components on the page
  rehydrate({
    'CandidateIndex': CandidateIndex,
    'CategoryIndex': CategoryIndex
  });

});
