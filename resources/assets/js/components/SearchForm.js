import React from 'react/addons';

class SearchForm extends React.Component {

  /**
   * Send search query to parent component on text input.
   * @param event
   */
  onChange(event) {
    event.preventDefault();

    this.props.onChange(event.target.value);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <div className='search-form'>
        <input type="search" placeholder='Find a candidate...' onChange={this.onChange.bind(this)} />
      </div>
    );
  }

}

export default SearchForm;
