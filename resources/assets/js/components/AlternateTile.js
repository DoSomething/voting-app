import React, { Component, PropTypes } from 'react';
import shallowCompare from 'react-addons-shallow-compare';

class AlternateTile extends Component {

  /**
   * Only re-render this component if props or state change.
   * @param {object} nextProps - Props that the component will receive
   * @param {object} nextState - State that the component will receive
   * @returns {boolean} Whether or not component should update
   */
  shouldComponentUpdate(nextProps, nextState) {
    return shallowCompare(this, nextProps, nextState);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <article className="tile -alternate">
        <div className="wrapper">
          <div className="tile__meta">
            <h1>{this.props.candidate.name}</h1>
          </div>
          <img alt={this.props.candidate.name} src={this.props.candidate.thumbnail} />
        </div>
      </article>
    );
  }

}

AlternateTile.propTypes = {
  candidate: PropTypes.shape({
    name: PropTypes.string,
    thumbnail: PropTypes.string,
  }),
};

export default AlternateTile;
