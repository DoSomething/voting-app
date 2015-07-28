import React, { Component, PropTypes } from 'react/addons';
import AlternateTile from './AlternateTile';

class CandidateDetailView extends Component {

  static propTypes = {
    item: PropTypes.shape({
      id: PropTypes.number,
      name: PropTypes.string,
      description: PropTypes.string,
      url: PropTypes.string,
      share_name: PropTypes.string,
    }),
  };

  /**
   * Return escaped server-rendered HTML to use for voting form.
   * @see resources/views/votes/form.blade.php
   * @returns {{__html: string}}
   */
  getFormMarkup() {
    // Nasty! We render the form markup on the server, and
    // then grab that pre-rendered markup here. This code
    // snippet is escaped server-side.
    let formMarkup = document.getElementById('form-template').innerHTML;

    // Replace token values for this particular candidate
    formMarkup = formMarkup.replace(/CANDIDATE_ID/g, this.props.item.id)
                           .replace(/CANDIDATE_NAME/g, this.props.item.name)
                           .replace(/CANDIDATE_LINK/g, this.props.item.url)
                           .replace(/TWITTER_NAME/g, this.props.item.share_name);

    return {
      __html: formMarkup,
    };
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <div className="candidate">
        <div className="wrapper">
          <div className="candidate__info">
            <AlternateTile candidate={this.props.item} />
            <p className="candidate__description">{this.props.item.description}</p>
          </div>

          <div className="candidate__actions" dangerouslySetInnerHTML={this.getFormMarkup()} />
        </div>
      </div>
    );
  }

}

export default CandidateDetailView;
