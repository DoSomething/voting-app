//
//  $$\    $$\  $$$$$$\ $$$$$$$$\ $$$$$$\ $$\   $$\  $$$$$$\
//  $$ |   $$ |$$  __$$\\__$$  __|\_$$  _|$$$\  $$ |$$  __$$\
//  $$ |   $$ |$$ /  $$ |  $$ |     $$ |  $$$$\ $$ |$$ /  \__|    $$$$$$\   $$$$$$\   $$$$$$\
//  \$$\  $$  |$$ |  $$ |  $$ |     $$ |  $$ $$\$$ |$$ |$$$$\     \____$$\ $$  __$$\ $$  __$$\
//   \$$\$$  / $$ |  $$ |  $$ |     $$ |  $$ \$$$$ |$$ |\_$$ |    $$$$$$$ |$$ /  $$ |$$ /  $$ |
//    \$$$  /  $$ |  $$ |  $$ |     $$ |  $$ |\$$$ |$$ |  $$ |   $$  __$$ |$$ |  $$ |$$ |  $$ |
//     \$  /    $$$$$$  |  $$ |   $$$$$$\ $$ | \$$ |\$$$$$$  |$$\\$$$$$$$ |$$$$$$$  |$$$$$$$  |
//      \_/     \______/   \__|   \______|\__|  \__| \______/ \__|\_______|$$  ____/ $$  ____/
//                                                                        $$ |      $$ |
//                                                                        $$ |      $$ |
//                                                                        \__|      \__|
//

import React from 'react/addons';

// RequestAnimationFrame polyfill
import 'requestanimationframe';

// Utilities
import './utilities/confirm';
import ready from './utilities/dom-ready';
import './utilities/form-loader';
import './utilities/lazy-load';
import './utilities/method-link';
import './utilities/share-link';

// Components
import CandidateIndex from './components/CandidateIndex';

ready(function() {
  // Render the gallery if we're on a gallery page
  const gallery = document.getElementById('gallery');
  if(gallery) {
    const categories= JSON.parse(document.getElementById('gallery-json').innerHTML);
    React.render(<CandidateIndex categories={categories} />, gallery);
  }
});

