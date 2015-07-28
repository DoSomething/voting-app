import React, { Component, PropTypes } from 'react/addons';
import Gallery from './Gallery';
import Tile from './Tile';

class CategoryIndex extends Component {

  static propTypes = {
    name: PropTypes.string,
    candidates: PropTypes.array,
  };

  constructor(props) {
    super(props);

    // Assign incremental key to candidates
    let i = 1;
    const candidates = props.candidates.map(function(candidate) {
      candidate.key = i++;
      return candidate;
    });

    this.state = {
      selectedItem: null,
      candidates: candidates,
    };

    this.onSelectItem = this.onSelectItem.bind(this);
  }

  /**
   * Set or unset the selected item to show details for.
   * @param {object} item - Selected item
   */
  onSelectItem(item) {
    // De-select if trying to select the same item again.
    if (this.state.selectedItem === item.props.candidate) {
      this.setState({selectedItem: null});
      return;
    }

    this.setState({selectedItem: item.props.candidate});
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <Gallery name={this.props.name} selectItem={this.onSelectItem} selectedItem={this.state.selectedItem}>
        {this.props.candidates.map((candidate) => <Tile candidate={candidate} />)}
      </Gallery>
    );
  }

}

export default CategoryIndex;
