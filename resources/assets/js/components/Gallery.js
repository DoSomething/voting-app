import React from 'react/addons';
import classNames from 'classnames';
import { chunk } from 'lodash';

import Tile from './Tile';
import Drawer from './Drawer';

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
        <div className="gallery -empty">
          <div className="gallery__empty">No matches!</div>
        </div>
      )
    }

    const chunkedItems = chunk(this.props.items, this.state.itemsPerRow);

    let rows = chunkedItems.map(function(row, index) {
      // Build each tile in the row
      let hasSelectedTile = false;
      var tiles = row.map(function(candidate) {
        const selected = candidate === _this.props.selectedItem;
        if(selected) {
          hasSelectedTile = selected;
        }

        return (
          <li key={candidate.id} className='gallery__item'>
            <Tile candidate={candidate} selected={selected} onClick={_this.props.selectItem} />
          </li>
        );
      });

      // Return the row
      return (
        <div key={index}>
          <div className='gallery__row'>
          {tiles}
          </div>
          <Drawer isOpen={hasSelectedTile} candidate={_this.props.selectedItem} selectItem={_this.props.selectItem} />
        </div>
      )
    });

    return (
      <div className='gallery'>{rows}</div>
    );
  }

}

export default Gallery;
