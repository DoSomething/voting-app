import React, { Component, PropTypes } from 'react/addons';
import Gallery from './Gallery';
import CandidateDetailView from './CandidateDetailView';
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
      candidates: candidates,
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
      <Gallery name={this.props.name} onSelect={this.onSelect} selectedItem={this.state.selectedItem} detailView={CandidateDetailView}>
        {this.props.candidates.map((candidate) => <Tile key={candidate.key} id={candidate.key} item={candidate} />)}
      </Gallery>
    );
  }

}

export default CategoryIndex;
