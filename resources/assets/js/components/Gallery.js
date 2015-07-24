import React, { Component, PropTypes } from 'react/addons';
import chunk from 'lodash/array/chunk';

import GalleryRow from './GalleryRow';

class Gallery extends Component {

  static propTypes = {
    name: PropTypes.string,
    items: PropTypes.array,
    selectedItem: PropTypes.object,
    selectItem: PropTypes.fn,
  };

  static defaultProps = {
    items: [],
  };

  constructor() {
    super();

    this.state = {
      itemsPerRow: this.getTilesPerRow(),
    };
  }

  /**
   * Add an event listener to re-render the gallery when the
   * user resizes between breakpoints.
   */
  componentDidMount() {
    // Update state whenever window width changes
    if (window) {
      window.addEventListener('resize', () => {
        const itemsPerRow = this.getTilesPerRow();

        if (this.state.itemsPerRow !== itemsPerRow) {
          this.setState({ itemsPerRow: itemsPerRow });
        }
      });
    }
  }

  /**
   * Calculate the number of tiles to put in a row, based
   * on the media queries we use in our stylesheet.
   * @returns {number}
   */
  getTilesPerRow() {
    // Assume a desktop view for pre-rendering on the server
    if (typeof window === 'undefined') return 4;

    if (window.innerWidth > 1100) {
      return 4;
    } else if (window.innerWidth > 660) {
      return 3;
    }

    return 1;
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    // Show "empty state" if no items
    if (this.props.items.length === 0) {
      return (
        <div className="gallery">
          <div className="empty">No matches!</div>
        </div>
      );
    }

    const chunkedItems = chunk(this.props.items, this.state.itemsPerRow);

    const rows = chunkedItems.map((row, index) => {
      return <GalleryRow key={index} row={row} selectedItem={this.props.selectedItem} selectItem={this.props.selectItem} />;
    });

    return (
      <div className="gallery">
        {this.props.name ? <h2 className="gallery__heading">{this.props.name}</h2> : null}
        {rows}
      </div>
    );
  }

}

export default Gallery;
