import React, { Component, PropTypes } from 'react/addons';
import classNames from 'classnames';
import debounce from 'lodash/function/debounce';
import includes from 'lodash/collection/includes';
import { getOffset } from '../utilities/dom';

import Gallery from './Gallery';
import SearchForm from './SearchForm';

class CandidateIndex extends Component {

  static propTypes = {
    categories: PropTypes.array,
    limit: PropTypes.number,
  };

  static defaultProps = {
    title: 'Voting App',
    limit: 16,
  };

  constructor(props) {
    super(props);

    this.state = this.getState(props);

    this.onSelectItem = this.onSelectItem.bind(this);
    this.onSetQuery = this.onSetQuery.bind(this);
    this.onSetQuery = debounce(this.onSetQuery, 20, { leading: true });
    this.onInfiniteScroll = this.onInfiniteScroll.bind(this);
    this.onInfiniteScroll = debounce(this.onInfiniteScroll, 100, { leading: true });

    if (typeof window !== 'undefined') {
      // Set HTML5 history event listener
      window.addEventListener('popstate', (event) => this.setState(event.state || this.getState()));

      // Set infinite scroll handler
      window.addEventListener('scroll', this.onInfiniteScroll);
      this.state.autoload = true;
    }
  }

  /**
   * Infinite scroll event handler.
   */
  onInfiniteScroll() {
    const paginator = document.getElementById('pagination');
    const offset = 500;

    if (paginator) {
      const endOfPage = getOffset(paginator) - offset;

      if ((window.scrollY + window.innerHeight) > endOfPage) {
        this.setState({ limit: this.state.limit + 25 });
      }
    }
  }

  /**
   * Set the query to filter galleries by.
   * @param {string} query - Search query
   * @param {boolean} save - Should query be persisted in browser history?
   */
  onSetQuery(query, save = false) {
    this.setState({
      query: query,
      selectedItem: null,
      limit: this.props.limit,
    });

    if (save) {
      const url = `${location.protocol}//${location.host}${location.pathname}?query=${encodeURIComponent(query)}`;
      history.pushState(this.state, document.title, url);
    }
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
   * Function which returns initial state of this component.
   * @param {object} props - Component props
   * @returns {object}
   */
  getState(props = this.props) {
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
      limit: props.limit,
      totalItemCount: count,
      selectedItem: null,
      categories: categories,
    };
  }


  /**
   * Filter candidates by the current search query.
   * @returns {object} - Filtered candidates
   */
  getFilteredCandidates() {
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
        candidates: filteredCandidates,
      };
    });

    // Finally, remove any any empty categories from the array
    categories = categories.filter((category) => category.candidates && category.candidates.length !== 0);

    return { count, categories };
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    const filtered = this.getFilteredCandidates();

    const galleries = filtered.categories.map((category) => {
      return <Gallery key={category.id} name={category.name} items={category.candidates} selectItem={this.onSelectItem} selectedItem={this.state.selectedItem} />;
    });

    const shouldShowPagination = this.state.limit < filtered.count;
    const paginatorClasses = classNames('pagination-link', { 'is-autoloading': this.state.autoload });
    const paginatorLink = `?limit=${this.state.limit + 25}#pagination`;

    return (
      <div>
        <SearchForm onChange={this.onSetQuery} query={this.state.query} />
        {galleries.length ? galleries : <Gallery />}
        {shouldShowPagination ? <a id="pagination" className={paginatorClasses} href={paginatorLink}><span>Show More</span></a> : null }
      </div>
    );
  }

}

export default CandidateIndex;
