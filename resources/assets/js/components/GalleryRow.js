import React, { Component, PropTypes } from 'react';
import shallowCompare from 'react-addons-shallow-compare';
import { getOffset, scrollToY } from '../utilities/dom';

import Drawer from './Drawer';
// import CandidateDetailView from './CandidateDetailView';


class GalleryRow extends Component {

  /**
   * When component receives new props, determine whether we should
   * scroll viewport to the top of this row.
   * @param {object} nextProps - Props that the component will receive
   */
  componentWillReceiveProps(nextProps) {
    if (!nextProps.selectedItem) return;
    if (this.props.selectedItem === nextProps.selectedItem) return;

    const hadSelectedTile = this.props.children.some((child) => child.props.item === this.props.selectedItem);
    const hasSelectedTile = nextProps.children.some((child) => child.props.item === nextProps.selectedItem);

    const prevKey = this.props.selectedItem ? this.props.selectedItem.id : 0;
    const nextKey = nextProps.selectedItem ? nextProps.selectedItem.id : -1;
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
      const selected = child.props.item === this.props.selectedItem;
      if (selected) {
        hasSelectedTile = selected;
      }

      return (
        <li key={child.key} className="gallery__item">
          {React.cloneElement(child, {selected: selected, onClick: this.props.onSelect})}
        </li>
      );
    });

    // Return the row
    return (
      <div>
        {tiles}
        <Drawer isOpen={hasSelectedTile} onSelect={this.props.onSelect}>
          <this.props.detailView item={this.props.selectedItem} />
        </Drawer>
      </div>
    );
  }

}

GalleryRow.propTypes = {
  children: PropTypes.arrayOf(PropTypes.element),
  detailView: PropTypes.instanceOf(Component),
  selectedItem: PropTypes.object,
  onSelect: PropTypes.func,
};

export default GalleryRow;
