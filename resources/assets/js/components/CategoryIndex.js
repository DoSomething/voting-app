import React from 'react/addons';
import Gallery from './Gallery';

class CategoryIndex extends React.Component {

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
      candidates: candidates
    };

    this.selectItem = this.selectItem.bind(this);
  }

  /**
   * Set or unset the selected item to show details for.
   * @param item
   */
  selectItem(item) {
    // De-select if trying to select the same item again.
    if(this.state.selectedItem === item.props.candidate) {
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
      <Gallery name={this.props.name} items={this.props.candidates} selectItem={this.selectItem} selectedItem={this.state.selectedItem} />
    );
  }

}

export default CategoryIndex;
