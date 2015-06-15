import React from 'react/addons';

import Tile from './Tile';
import Drawer from './Drawer';

class GalleryRow extends React.Component {

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    const _this = this;

    // Build each tile in the row
    let hasSelectedTile = false;
    var tiles = this.props.row.map(function(candidate) {
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
      <div>
        {tiles}
        <Drawer isOpen={hasSelectedTile} candidate={_this.props.selectedItem} selectItem={_this.props.selectItem} />
      </div>
    )
  }

}

export default GalleryRow;
