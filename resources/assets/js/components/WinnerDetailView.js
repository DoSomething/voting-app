import React, { Component, PropTypes } from 'react';
import AlternateTile from './AlternateTile';
import ordinalize from '../utilities/ordinalize';

class WinnerDetailView extends Component {

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <div className="candidate">
        <div className="wrapper">
          <div className="candidate__info">
            <AlternateTile candidate={this.props.item.candidate} />
            <p className="candidate__description">{this.props.item.candidate.description}</p>
          </div>

          <div className="candidate__actions">
            <h2 className="heading -hero">{this.props.item.candidate.name} came in {ordinalize(this.props.item.rank)} place.</h2>
            {this.props.item.description}
          </div>
        </div>
      </div>
    );
  }

}

WinnerDetailView.propTypes = {
  item: PropTypes.shape({
    rank: PropTypes.number,
    description: PropTypes.string,
    candidate: PropTypes.shape({
      name: PropTypes.string,
      description: PropTypes.string,
      url: PropTypes.string,
      thumbnail: PropTypes.string,
    }),
  }),
};


export default WinnerDetailView;
