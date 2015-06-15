import React from 'react/addons';

/**
 * Re-hydrate any rendered React components
 */
function rehydrate(components) {

  // Get all React pre-rendered elements by data-attribute
  const reactElements = document.querySelectorAll('*[data-rendered-component]');

  // Rehydrate each component
  Array.prototype.forEach.call(reactElements, function(el) {
    const id = el.getAttribute('id');
    const props = JSON.parse(document.getElementById(`${id}-props`).innerHTML);

    const component = el.getAttribute('data-rendered-component');
    if(components[component]) {
      React.render(React.createElement(components[component], props), el);
    }
  });
}

export default rehydrate;
