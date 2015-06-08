import React from 'react/addons';
import Gallery from './Gallery';
import SearchForm from './SearchForm';
import { cloneDeep, includes } from 'lodash';

class CandidateIndex extends React.Component {

  constructor() {
    super();

    this.state = {
      query: '',
      selectedItem: null
    };

    this.selectItem = this.selectItem.bind(this);
    this.setQuery = this.setQuery.bind(this);
  }

  setQuery(query) {
    this.setState({ query: query });
  }

  selectItem(item) {
    // De-select if trying to select the same item again.
    if(this.state.selectedItem === item.props.candidate) {
      this.setState({selectedItem: null});
      return;
    }

    this.setState({selectedItem: item.props.candidate});
  }

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

  render() {
    var _this = this;
    var galleries = this.props.categories.map(function(category) {
      return (
        <div key={category.id} className='category'>
          <h2 className='gallery-heading'>{category.name}</h2>
          <Gallery items={_this.filteredCandidates(category.candidates, category.name)} selectItem={_this.selectItem} selectedItem={_this.state.selectedItem} />
        </div>
      );
    });

    return (
      <div>
        <SearchForm onChange={this.setQuery} />
        {galleries}
      </div>
    );
  }

}

export default CandidateIndex;
