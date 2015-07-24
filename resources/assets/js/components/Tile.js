import React, { Component, PropTypes } from 'react/addons';
import classNames from 'classnames';
import shallowCompare from '../vendor/shallowCompare';

class Tile extends Component {

  static propTypes = {
    candidate: PropTypes.shape({
      name: PropTypes.string,
      url: PropTypes.string,
      thumbnail: PropTypes.string,
    }),
    selected: PropTypes.bool,
    onClick: PropTypes.fn,
  };

  constructor() {
    super();

    this.onClick = this.onClick.bind(this);
  }

  /**
   * Only re-render this component if props or state change.
   * @param {object} nextProps - Props that the component will receive
   * @param {object} nextState - State that the component will receive
   * @returns {boolean}
   */
  shouldComponentUpdate(nextProps, nextState) {
    return shallowCompare(this, nextProps, nextState);
  }

  /**
   * Send click event to parent component.
   * @param {MouseEvent} event - 'click'
   */
  onClick(event) {
    event.preventDefault();

    this.props.onClick(this);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    const classes = classNames('tile', {
      'is-active': this.props.selected,
    });

    return (
      <article className={classes}>
        <a className="wrapper" href={this.props.candidate.url} onClick={this.onClick}>
          <div className="tile__meta">
            <h1>{this.props.candidate.name}</h1>
          </div>
          <img alt={this.props.candidate.name} src={this.props.candidate.thumbnail} />
          <span className="button -round tile__action">Vote</span>
        </a>
      </article>
    );
  }

}

export default Tile;
