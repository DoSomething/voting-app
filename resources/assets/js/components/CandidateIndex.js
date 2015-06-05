import React from 'react/addons';
import Gallery from './Gallery';
import SearchForm from './SearchForm';
import { cloneDeep } from 'lodash';

const CandidateIndex = React.createClass({

  getInitialState() {
    return {
      categories: this.props.categories
    }
  },

  filterCandidates(query) {
    query = query.toUpperCase();

    // Filter candidates by search query...
    let categories = this.props.categories.map(function(cat) {
      let category = cloneDeep(cat);
      const categoryName = category.name.toUpperCase();

      if(query !== '') {
        category.candidates = category.candidates.filter(function(candidate) {
          const name = candidate.name.toUpperCase();
          return (name.includes(query) || categoryName.includes(query) ? candidate : null);
        });
      }

      return category;
    });

    this.setState({ categories: categories });
  },

  render() {
    var galleries = this.state.categories.map(function(category) {
      return (
        <div key={category.id} className='category'>
          <h2 className='gallery-heading'>{category.name}</h2>
          <Gallery items={category.candidates} />
        </div>
      );
    });

    return (
      <div>
        <SearchForm onChange={this.filterCandidates} />
        {galleries}
      </div>
    );
  }

});

export default CandidateIndex;
