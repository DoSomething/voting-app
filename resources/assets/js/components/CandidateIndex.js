import React from 'react/addons';
import Gallery from './Gallery';
import SearchForm from './SearchForm';
import includes from 'lodash/collection/includes';
import debounce from 'lodash/function/debounce';

class CandidateIndex extends React.Component {

  constructor(props) {
    super(props);

    this.state = this.initialState(props);

    this.selectItem = this.selectItem.bind(this);
    this.setQuery = this.setQuery.bind(this);
    this.setQuery = debounce(this.setQuery, 20, { leading: true });

    // Set HTML5 history event listener
    if(typeof window !== 'undefined') {
      window.addEventListener('popstate', (event) => this.setState(event.state || this.initialState()));
    }
  }

  /**
   * Function which returns initial state of this component.
   * @param props
   * @returns object
   */
  initialState(props = this.props) {
    // Assign incremental key to candidates
    let i = 1;
    const categories = props.categories.map(function(category) {
      category.candidates.map(function(candidate) {
        candidate.key = i++;
        return candidate;
      });

      return category;
    });

    return {
      query: props.query || '',
      selectedItem: null,
      categories: categories
    }
  }

  /**
   * Set the query to filter galleries by.
   * @param query - Search query
   * @param save - Should query be persisted in browser history?
   */
  setQuery(query, save = false) {
    this.setState({
      query: query,
      selectedItem: null
    });

    if(save) {
      const url = `${location.protocol}//${location.host}${location.pathname}?query=${encodeURIComponent(query)}`;
      history.pushState(this.state, document.title, url);
    }
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
    var galleries = this.state.categories.map(function(category) {
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

CandidateIndex.defaultProps = {
  title: 'Voting App'
};

export default CandidateIndex;
