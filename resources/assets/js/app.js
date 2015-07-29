/**
 * This is the main entry point for the client-side experience on
 * the Voting App. It is loaded asynchronously in `scripts.blade.php`.
 *
 * We only run client-side enhancements on capable browsers, opting
 * to provide a simpler server-rendered experience for users on older
 * browsers (such as Internet Explorer 8).
 *
 * We "cut the mustard" using the following criteria:
 *
 *  - document.querySelector: This allows us make queries against the DOM
 *    without the weight of a big library like jQuery. It's well supported in
 *    all modern browsers, and supported in Internet Explorer 9+.
 *
 *  - window.addEventListener: This is part of DOM Level 2 events, and is
 *    supported by every modern browser (except IE 8). It is required by
 *    the DOM delegation library that we use on Voting App.
 *
 * See the original BBC post on 'Cutting The Mustard' for further rationale:
 * http://responsivenews.co.uk/post/18948466399/cutting-the-mustard
 *
 */

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
import WinnerIndex from './components/WinnerIndex';
import WinnerDetailView from './components/WinnerDetailView';

/**
 * Let's go!
 */
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
    'CategoryIndex': CategoryIndex,
    'WinnerIndex': WinnerIndex,
    'WinnerDetailView': WinnerDetailView,
  });
});
