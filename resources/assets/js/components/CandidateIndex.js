import React from 'react/addons';
import classNames from 'classnames';
import debounce from 'lodash/function/debounce';
import includes from 'lodash/collection/includes';
import { getOffset } from '../utilities/scroll';

import Gallery from './Gallery';
import SearchForm from './SearchForm';

class CandidateIndex extends React.Component {

  constructor(props) {
    super(props);

    this.state = this.initialState(props);

    this.selectItem = this.selectItem.bind(this);
    this.showMore = this.showMore.bind(this);
    this.setQuery = this.setQuery.bind(this);
    this.setQuery = debounce(this.setQuery, 20, { leading: true });
    this.handleInfiniteScroll = this.handleInfiniteScroll.bind(this);
    this.handleInfiniteScroll = debounce(this.handleInfiniteScroll, 100, { leading: true });

    if(typeof window !== 'undefined') {
      // Set HTML5 history event listener
      window.addEventListener('popstate', (event) => this.setState(event.state || this.initialState()));

      // Set infinite scroll handler
      window.addEventListener('scroll', this.handleInfiniteScroll);
      this.state.autoload = true;
    }
  }

  /**
   * Function which returns initial state of this component.
   * @param props
   * @returns object
   */
  initialState(props = this.props) {
    // Assign incremental key to candidates
    let count = 1;
    const categories = props.categories.map(function(category) {
      category.candidates.map(function(candidate) {
        candidate.key = count++;
        return candidate;
      });

      return category;
    });

    return {
      query: props.query || '',
      limit: parseInt(props.limit),
      totalItemCount: count,
      selectedItem: null,
      categories: categories
    }
  }

  handleInfiniteScroll() {
    const paginator = document.getElementById('pagination');

    if(paginator) {
      const scrollY = window.scrollY;
      const endOfPage = getOffset(paginator);

      if ((scrollY + window.innerHeight) > endOfPage) {
        this.setState({ limit: this.state.limit + 25 });
      }
    }
  }

  /**
   * Increase number of tiles shown as user scrolls.
   */
  showMore(event) {
    event.preventDefault();

    this.setState({ limit: this.state.limit + 25 });
  }

  /**
   * Set the query to filter galleries by.
   * @param query - Search query
   * @param save - Should query be persisted in browser history?
   */
  setQuery(query, save = false) {
    this.setState({
      query: query,
      selectedItem: null,
      limit: this.props.limit
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
   * @returns {object} - Filtered candidates
   */
  filteredCandidates() {
    let count = 0;
    let categories = this.props.categories.map((category) => {
      const query = this.state.query.toUpperCase();
      const categoryName = category.name.toUpperCase();

      const filteredCandidates = category.candidates.filter((candidate) => {
        const name = candidate.name.toUpperCase();

        // Only include candidates up until the given limit
        if (count > this.state.limit) return null;

        if (includes(name, query) || includes(categoryName, query) || query === '') {
          count++;
          return candidate;
        }
      });


      // Filter candidates by search query...
      return {
        id: category.id,
        name: category.name,
        candidates: filteredCandidates
      }
    });

    // Finally, remove any any empty categories from the array
    categories = categories.filter(function(category) { return category.candidates && category.candidates.length !== 0 });

    return { count, categories };
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    const filtered = this.filteredCandidates();

    let galleries = filtered.categories.map((category) => {
      return <Gallery key={category.id} name={category.name} items={category.candidates} selectItem={this.selectItem} selectedItem={this.state.selectedItem} />;
    });

    const shouldShowPagination = this.state.limit < filtered.count;
    const paginatorClasses = classNames('pagination-link', { 'is-autoloading': this.state.autoload });

    return (
      <div>
        <SearchForm onChange={this.setQuery} query={this.state.query} />
        {galleries.length ? galleries : <Gallery />}
        {shouldShowPagination ? <a id='pagination' className={paginatorClasses} href={`?limit=${this.state.limit + 25}#pagination`} onClick={this.showMore}><span>Show More</span></a> : null }
      </div>
    );
  }

}

CandidateIndex.defaultProps = {
  title: 'Voting App',
  limit: 16
};

export default CandidateIndex;
