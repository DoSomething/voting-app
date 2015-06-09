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

  tilesPerRow() {
    const width = window.innerWidth;

    if(width > 1100) {
      return 4;
    } else if(width > 660) {
      return 3;
    } else {
      return 1;
    }
  }

  componentDidMount() {
    var _this = this;

    // Update state whenever window width changes
    window.addEventListener('resize', function() {
      var itemsPerRow = _this.tilesPerRow();

      if(_this.state.itemsPerRow !== itemsPerRow) {
        _this.setState({ itemsPerRow: itemsPerRow });
      }
    });
  }

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
