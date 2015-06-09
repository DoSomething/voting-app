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

import $ from 'jquery';
import React from 'react/addons';

// RequestAnimationFrame polyfill
import 'requestanimationframe';

// Utilities
import './utilities/confirm';
import './utilities/form-loader';
import './utilities/lazy-load';
import './utilities/method-link';
import './utilities/share-link';

// Components
import CandidateIndex from './components/CandidateIndex';

// Bind jQuery to the window
window.jQuery = $;

$(document).ready(function() {
  // Render the gallery if we're on a gallery page
  const gallery = document.getElementById('gallery');
  if(gallery) {
    const categories= JSON.parse(document.getElementById('gallery-json').innerHTML);
    React.render(<CandidateIndex categories={categories} />, gallery);
  }
});

