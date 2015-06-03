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

// RequestAnimationFrame polyfill
import 'requestanimationframe';

// Utilities
import './utilities/confirm';
import './utilities/form-loader';
import './utilities/lazy-load';
import './utilities/method-link';
import './utilities/share-link';

// Components
import './components/drawer';

// Bind jQuery to the window
window.jQuery = $;
