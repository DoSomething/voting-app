import React, { Component, PropTypes } from 'react';
import Gallery from './Gallery';
import WinnerDetailView from './WinnerDetailView';
import WinnerTile from './WinnerTile';

class WinnerIndex extends Component {

  constructor(props) {
    super(props);

    // Assign incremental key to candidates
    let i = 1;
    const winners = props.winners.map(function(candidate) {
      candidate.key = i++;
      return candidate;
    });

    this.state = {
      winners: winners,
      selectedItem: null,
    };

    this.onSelect = this.onSelect.bind(this);
  }

  /**
   * Set or unset the selected item to show details for.
   * @param {object} item - Selected item
   */
  onSelect(item) {
    // De-select if trying to select the same item again.
    if (this.state.selectedItem === item) {
      this.setState({selectedItem: null});
      return;
    }

    this.setState({selectedItem: item});
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <Gallery name={this.props.name} onSelect={this.onSelect} selectedItem={this.state.selectedItem} detailView={WinnerDetailView}>
        {this.state.winners.map((winner) => <WinnerTile key={winner.key} id={winner.key} item={winner} />)}
      </Gallery>
    );
  }

}

WinnerIndex.propTypes = {
  name: PropTypes.string,
  winners: PropTypes.array,
};

WinnerIndex.defaultProps = {
  name: 'Winners',
  winners: [],
};


export default WinnerIndex;

