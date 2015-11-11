import React, { Component, PropTypes } from 'react';
import chunk from 'lodash/array/chunk';

import GalleryRow from './GalleryRow';

class Gallery extends Component {

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
    if (!this.props.children) {
      return (
        <div className="gallery">
          <div className="empty">No matches!</div>
        </div>
      );
    }

    const chunkedChildren = chunk(this.props.children, this.state.itemsPerRow);

    const rows = chunkedChildren.map((row, index) => {
      return (
        <GalleryRow key={index} detailView={this.props.detailView} selectedItem={this.props.selectedItem} onSelect={this.props.onSelect}>
          {row}
        </GalleryRow>
      );
    });

    return (
      <div className="gallery">
        {this.props.name ? <h2 className="gallery__heading">{this.props.name}</h2> : null}
        {rows}
      </div>
    );
  }

}

Gallery.propTypes = {
  name: PropTypes.string,
  children: PropTypes.arrayOf(PropTypes.element),
  detailView: PropTypes.instanceOf(Component),
  selectedItem: PropTypes.object,
  onSelect: PropTypes.func,
};

Gallery.defaultProps = {
  items: [],
};

export default Gallery;
