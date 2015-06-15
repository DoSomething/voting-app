import React from 'react/addons';
import Gallery from './Gallery';
import SearchForm from './SearchForm';
import { cloneDeep, includes } from 'lodash';

class CandidateIndex extends React.Component {

  constructor(props) {
    super(props);

    this.state = {
      query: props.query || '',
      selectedItem: null
    };

    this.selectItem = this.selectItem.bind(this);
    this.setQuery = this.setQuery.bind(this);
  }

  /**
   * Set the query to filter galleries by.
   * @param query
   */
  setQuery(query) {
    this.setState({ query: query });
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
   * Filter candidates by the current search query.
   * @param candidates - Object containing candidates to be filtered
   * @param categoryName - Category name
   * @returns object - Filtered candidates
   */
  filteredCandidates(candidates, categoryName) {
    const query = this.state.query.toUpperCase();
    categoryName = categoryName.toUpperCase();

    if(query === '') return candidates;

    // Filter candidates by search query...
    return candidates.filter(function(candidate) {
      const name = candidate.name.toUpperCase();
      return (includes(name, query) || includes(categoryName, query) ? candidate : null);
    });
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    var _this = this;
    var galleries = this.props.categories.map(function(category) {
      var candidates = _this.filteredCandidates(category.candidates, category.name);
      if(candidates.length == 0) return;

      return (
        <Gallery key={category.id} name={category.name} items={candidates} selectItem={_this.selectItem} selectedItem={_this.state.selectedItem} />
      );
    });

    // Remove any null entries from the array
    galleries = galleries.filter(function(gallery) { return typeof gallery != 'undefined' });

    return (
      <div>
        <SearchForm onChange={this.setQuery} query={this.state.query} />
        {galleries.length ? galleries : <Gallery />}
      </div>
    );
  }

}

export default CandidateIndex;
