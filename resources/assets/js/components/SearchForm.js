import React, { Component, PropTypes } from 'react';

class SearchForm extends Component {

  constructor(props) {
    super(props);

    this.state = {
      query: props.query || '',
    };

    this.onChange = this.onChange.bind(this);
    this.onKeyDown = this.onKeyDown.bind(this);
    this.onBlur = this.onBlur.bind(this);
  }

  /**
   * Send search query to parent component on text input.
   * @param {Event} event - 'change'
   */
  onChange(event) {
    event.preventDefault();
    this.props.onChange(event.target.value);
  }

  /**
   * If enter key is pressed, blur the field to close
   * keyboard on touch devices.
   * @param {KeyboardEvent} event - 'keydown'
   */
  onKeyDown(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
      document.activeElement.blur();
    }
  }

  /**
   * Persist the search query when user blurs the text field.
   * @param {FocusEvent} event - 'blur'
   */
  onBlur(event) {
    this.props.onChange(event.target.value, true);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <form method="GET" action="/candidates" className="search-form" onSubmit={this.onChange}>
        <input type="search" name="query" id="query" value={this.props.query} placeholder="Find a candidate..."
          onChange={this.onChange} onKeyDown={this.onKeyDown} onBlur={this.onBlur} />
      </form>
    );
  }

}

SearchForm.propTypes = {
  query: PropTypes.string,
  onChange: PropTypes.func,
};


export default SearchForm;
