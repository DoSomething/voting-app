import React from 'react/addons';

class SearchForm extends React.Component {

  onChange(event) {
    event.preventDefault();

    this.props.onChange(event.target.value);
  }

  render() {
    return (
      <div className='search-form'>
        <input type="search" placeholder='Find a candidate...' onChange={this.onChange.bind(this)} />
      </div>
    );
  }

}

export default SearchForm;
