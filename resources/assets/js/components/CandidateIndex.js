import React from 'react/addons';
import Gallery from './Gallery';
import SearchForm from './SearchForm';

const CandidateIndex = React.createClass({

  getInitialState() {
    return {
      query: ''
    }
  },

  filterCandidates(query) {
    console.log(query);

    this.setState({ query: query });
  },

  render() {
    const query = this.state.query.toUpperCase();

    var galleries = this.props.categories.map(function(category) {
      // Filter candidates by search query...
      let candidates = category.candidates;
      if(query !== '') {
        candidates = candidates.filter(function(candidate) {
          const name = candidate.name.toUpperCase();
          return (name.includes(query) ? candidate : null);
        });
      }

      return (
        <div key={category.id} className='category'>
          <h2 className='gallery-heading'>{category.name}</h2>
          <Gallery items={candidates} />
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
