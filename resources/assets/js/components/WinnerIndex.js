import React, { Component, PropTypes } from 'react';
import Gallery from './Gallery';
import WinnerDetailView from './WinnerDetailView';
import WinnerTile from './WinnerTile';

class WinnerIndex extends Component {
  constructor(props) {
    super(props);

    // Assign incremental key to candidates
    let count = 1;
    const winnerCategories = props.winnerCategories.map(function(category) {
      category.winners.map(function(winner) {
        winner.key = count++;
        return winner;
      });

      return category;
    });

    this.state = {
      winnerCategories: winnerCategories,
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
    const galleries = this.state.winnerCategories.map((category) => (
      <Gallery key={category.id} name={category.name} onSelect={this.onSelect} selectedItem={this.state.selectedItem} detailView={WinnerDetailView}>
        {category.winners.map((winner) => <WinnerTile key={winner.key} id={winner.key} item={winner} />)}
      </Gallery>
    ));

    return (
      <div>
        {galleries}
      </div>
    );
  }
}

WinnerIndex.propTypes = {
  winnerCategories: PropTypes.array,
};

WinnerIndex.defaultProps = {
  winnerCategories: [],
};


export default WinnerIndex;

