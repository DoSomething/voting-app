import React, { Component, PropTypes } from 'react/addons';
const { cloneWithProps } = React.addons;

import Drawer from './Drawer';
import { getOffset, scrollToY } from '../utilities/dom';
import shallowCompare from '../vendor/shallowCompare';

class GalleryRow extends Component {

  static propTypes = {
    children: PropTypes.arrayOf(PropTypes.element),
    selectedItem: PropTypes.object,
    selectItem: PropTypes.func,
  };

  /**
   * When component receives new props, determine whether we should
   * scroll viewport to the top of this row.
   * @param {object} nextProps - Props that the component will receive
   */
  componentWillReceiveProps(nextProps) {
    if (this.props.selectedItem === nextProps.selectedItem) return;

    const hadSelectedTile = this.props.children.some((child) => child.props.candidate === this.props.selectedItem);
    const hasSelectedTile = nextProps.children.some((child) => child.props.candidate === nextProps.selectedItem);

    const prevKey = this.props.selectedItem ? this.props.selectedItem.key : 0;
    const nextKey = nextProps.selectedItem ? nextProps.selectedItem.key : -1;
    const previousTileWasAbove = prevKey < nextKey;

    if (!hadSelectedTile && hasSelectedTile) {
      this.onChangedSelection(previousTileWasAbove);
    } else if (hasSelectedTile) {
      this.onChangedSelection();
    }
  }

  /**
   * Only re-render this component if props or state change.
   * @param {object} nextProps - Props that the component will receive
   * @param {object} nextState - State that the component will receive
   * @returns {boolean}
   */
  shouldComponentUpdate(nextProps, nextState) {
    return shallowCompare(this, nextProps, nextState);
  }

  /**
   * Scroll viewport to the top of this row when selection changes.
   * @param {boolean} drawerWasAbove - Whether a drawer was open "above" this row
   */
  onChangedSelection(drawerWasAbove = false) {
    // Get vertical offset of the first tile in this row.
    // We check the tile, because row container is a span and
    // doesn't clear, so it's position might be misleading.
    const el = React.findDOMNode(this).firstChild;
    const elementTop = getOffset(el);

    // We find the height of the currently open drawer, if there is
    // one, and use it to offset the scroll position if necessary.
    const existingDrawer = document.getElementsByClassName('drawer')[0];
    const offset = existingDrawer ? existingDrawer.offsetHeight : 0;

    // Scroll to the top of row. If the previously open drawer
    // was above (determined by boolean parameter sent from
    // `componentWillReceiveProps`), then adjust offset accordingly
    if (drawerWasAbove) {
      scrollToY(elementTop - offset);
    } else {
      scrollToY(elementTop);
    }
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    let hasSelectedTile = false;

    // Build each tile in the row
    const tiles = this.props.children.map((child) => {
      const selected = child.props.candidate === this.props.selectedItem;
      if (selected) {
        hasSelectedTile = selected;
      }

      return (
        <li key={child.props.candidate.key} className="gallery__item">
          {cloneWithProps(child, {selected: selected, onClick: this.props.selectItem})}
        </li>
      );
    });

    // Return the row
    return (
      <div>
        {tiles}
        <Drawer isOpen={hasSelectedTile} candidate={this.props.selectedItem} selectItem={this.props.selectItem} />
      </div>
    );
  }

}

export default GalleryRow;
