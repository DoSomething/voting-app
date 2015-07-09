import React from 'react/addons';
import classNames from 'classnames';
import shallowCompare from '../vendor/shallowCompare';

class Tile extends React.Component {

  constructor() {
    super();

    this.onClick = this.onClick.bind(this);
  }

  /**
   * Send click event to parent component.
   */
  onClick(event) {
    event.preventDefault();

    this.props.onClick(this);
  }


  /**
   * Only re-render this component if props or state change.
   * @param nextProps
   * @param nextState
   * @returns {boolean}
   */
  shouldComponentUpdate(nextProps, nextState) {
    return shallowCompare(this, nextProps, nextState);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    const classes = classNames('tile', {
      'is-active': this.props.selected
    });

    return (
      <article className={classes}>
        <a className='wrapper' href={this.props.candidate.url} onClick={this.onClick}>
          <div className='tile__meta'>
            <h1>{this.props.candidate.name}</h1>
          </div>
          <img alt={this.props.candidate.name} src={this.props.candidate.thumbnail} />
          <span className='button -round tile__action'>Vote</span>
        </a>
      </article>
    );
  }

}

export default Tile;
