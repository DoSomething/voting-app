import React from 'react/addons';

import Tile from './Tile';
import Drawer from './Drawer';
import { getOffset, scrollToY } from '../utilities/scroll';

class GalleryRow extends React.Component {

  /**
   * Scroll viewport to the top of this row.
   * @param drawerWasAbove - Whether a drawer was open "above" this row
   */
  scrollTop(drawerWasAbove = false) {
    // Get vertical offset of the first tile in this row.
    // We check the tile, because row container is a span and
    // doesn't clear, so it's position might be misleading.
    const el = React.findDOMNode(this).firstChild;
    var elementTop = getOffset(el);

    // We find the height of the currently open drawer, if there is
    // one, and use it to offset the scroll position if necessary.
    let existingDrawer = document.getElementsByClassName('drawer')[0];
    let offset = existingDrawer ? existingDrawer.offsetHeight : 0;

    // Scroll to the top of row. If the previously open drawer
    // was above (determined by boolean parameter sent from
    // `componentWillReceiveProps`), then adjust offset accordingly
    if(drawerWasAbove) {
      scrollToY(elementTop - offset);
    } else {
      scrollToY(elementTop);
    }
  }

  /**
   * When component receives new props, determine whether we should
   * scroll viewport to the top of this row.
   * @param nextProps
   */
  componentWillReceiveProps(nextProps) {
    const hadSelectedTile = this.props.row.some((candidate) => candidate === this.props.selectedItem);
    const hasSelectedTile = nextProps.row.some((candidate) => candidate === nextProps.selectedItem);

    const prevKey = this.props.selectedItem ? this.props.selectedItem.key : 0;
    const nextKey = nextProps.selectedItem ? nextProps.selectedItem.key : -1;
    const previousTileWasAbove = prevKey < nextKey;

    if(!hadSelectedTile && hasSelectedTile) {
      this.scrollTop(previousTileWasAbove);
    } else if (hasSelectedTile) {
      this.scrollTop();
    }
  }

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
        <li key={candidate.key} className='gallery__item'>
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
