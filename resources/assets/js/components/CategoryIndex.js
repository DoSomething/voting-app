import React from 'react/addons';
import Gallery from './Gallery';

class CategoryIndex extends React.Component {

  constructor(props) {
    super(props);

    this.state = {
      selectedItem: null
    };

    this.selectItem = this.selectItem.bind(this);
  }

  /**
   * Set or unset the selected item to show details for.
   * @param query
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
      <div className='category'>
        <h2 className='gallery-heading'>{this.props.name}</h2>
        <Gallery items={this.props.candidates} selectItem={this.selectItem} selectedItem={this.state.selectedItem} />
      </div>
    );
  }

}

export default CategoryIndex;
