import React from 'react/addons';
const { CSSTransitionGroup } = React.addons;
import classNames from 'classnames';
import { chunk } from 'lodash';

import Tile from './Tile';
import Drawer from './Drawer';

const Gallery = React.createClass({

  getInitialState() {
    return {
      selected: null,
      itemsPerRow: this.tilesPerRow()
    }
  },

  tilesPerRow() {
    const width = window.innerWidth;

    if(width > 1100) {
      return 4;
    } else if(width > 660) {
      return 3;
    } else {
      return 1;
    }
  },

  componentDidMount() {
    var _this = this;

    // Update state whenever window width changes
    window.addEventListener('resize', function() {
      var itemsPerRow = _this.tilesPerRow();

      if(_this.state.itemsPerRow !== itemsPerRow) {
        _this.setState({ itemsPerRow: itemsPerRow });
      }
    });
  },

  selectItem(item) {
    this.setState({selectedItem: item.props.candidate});
  },


  render() {
    const _this = this;

    const chunkedItems = chunk(this.props.items, this.state.itemsPerRow);

    let rows = chunkedItems.map(function(row, index) {
      // Build each tile in the row
      let hasSelectedTile = false;
      var tiles = row.map(function(candidate) {
        const selected = candidate === _this.state.selectedItem;
        if(selected) {
          hasSelectedTile = selected;
        }

        return (
          <li key={candidate.id} className='gallery__item'>
            <Tile candidate={candidate} selected={selected} onClick={_this.selectItem} />
          </li>
        );
      });

      // Return the row
      return (
        <div>
          <div className='gallery__row' key={index}>
          {tiles}
          </div>
          <CSSTransitionGroup transitionName="drawer-animation" transitionAppear={true} transitionLeave={true}>
            {hasSelectedTile ? <Drawer candidate={_this.state.selectedItem}/> : null}
          </CSSTransitionGroup>
        </div>
      )
    });

    return (
      <div className='gallery'>{rows}</div>
    );
  }

});

export default Gallery;
