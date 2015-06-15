import React from 'react/addons';

class SearchForm extends React.Component {

  constructor(props) {
    super(props);

    this.state = {
      query: props.query || ''
    };

    this.onChange = this.onChange.bind(this);
  }

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
      <form method='GET' action='/candidates' className='search-form' onSubmit={this.onChange}>
        <input type='search' name='query' id='query' value={this.props.query} placeholder='Find a candidate...' onChange={this.onChange} />
      </form>
    );
  }

}

export default SearchForm;
