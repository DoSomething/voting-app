import React from 'react/addons';
import shallowCompare from '../vendor/shallowCompare';

class AlternateTile extends React.Component {

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
    return (
      <article className='tile -alternate'>
        <div className='wrapper'>
          <div className='tile__meta'>
            <h1>{this.props.candidate.name}</h1>
          </div>
          <img alt={this.props.candidate.name} src={this.props.candidate.thumbnail} />
        </div>
      </article>
    );
  }

}

export default AlternateTile;
