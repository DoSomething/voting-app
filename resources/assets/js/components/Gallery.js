import React from 'react/addons';
import classNames from 'classnames';
import chunk from 'lodash/array/chunk';

import GalleryRow from './GalleryRow';

class Gallery extends React.Component {

  constructor() {
    super();

    this.state = {
      itemsPerRow: this.tilesPerRow()
    };
  }

  /**
   * Calculate the number of tiles to put in a row, based
   * on the media queries we use in our stylesheet.
   * @returns {number}
   */
  tilesPerRow() {
    // Assume a desktop view for pre-rendering on the server
    if(typeof window === 'undefined') return 4;

    if(window.innerWidth > 1100) {
      return 4;
    } else if(window.innerWidth > 660) {
      return 3;
    } else {
      return 1;
    }
  }

  /**
   * Add an event listener to re-render the gallery when the
   * user resizes between breakpoints.
   */
  componentDidMount() {
    var _this = this;

    // Update state whenever window width changes
    if(window) {
      window.addEventListener('resize', function() {
        var itemsPerRow = _this.tilesPerRow();

        if(_this.state.itemsPerRow !== itemsPerRow) {
          _this.setState({ itemsPerRow: itemsPerRow });
        }
      });
    }
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    const _this = this;

    // Show "empty state" if no items
    if(this.props.items.length === 0) {
      return (
        <div className="gallery">
          <div className="empty">No matches!</div>
        </div>
      );
    }

    const chunkedItems = chunk(this.props.items, this.state.itemsPerRow);

    let rows = chunkedItems.map(function(row, index) {
      return <GalleryRow key={index} row={row} selectedItem={_this.props.selectedItem} selectItem={_this.props.selectItem} />;
    });

    let heading;
    if(this.props.name) {
      heading = <h2 className='gallery__heading'>{this.props.name}</h2>;
    }

    return (
      <div className='gallery'>
        {heading}
        {rows}
      </div>
    );
  }

}

Gallery.defaultProps = {
  items: []
};

export default Gallery;
