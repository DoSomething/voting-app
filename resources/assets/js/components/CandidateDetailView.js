import React from 'react/addons';
import AlternateTile from './AlternateTile';

class CandidateDetailView extends React.Component {

  /**
   * Return escaped server-rendered HTML to use for voting form.
   * @see resources/views/votes/form.blade.php
   * @returns {{__html: string}}
   */
  formMarkup() {
    // Nasty! We render the form markup on the server, and
    // then grab that pre-rendered markup here. This code
    // snippet is escaped server-side.
    let formMarkup = document.getElementById('form-template').innerHTML;

    // Replace token values for this particular candidate
    formMarkup = formMarkup.replace(/CANDIDATE_ID/g, this.props.candidate.id)
                           .replace(/CANDIDATE_NAME/g, this.props.candidate.name)
                           .replace(/CANDIDATE_LINK/g, this.props.candidate.url)
                           .replace(/TWITTER_NAME/g, this.props.candidate.share_name);

    return {
      __html: formMarkup
    }
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <div className='candidate'>
        <div className='wrapper'>
          <div className="candidate__info">
            <AlternateTile candidate={this.props.candidate} />
            <p className="candidate__description">{this.props.candidate.description}</p>
          </div>

          <div className="candidate__actions" dangerouslySetInnerHTML={this.formMarkup()} />
        </div>
      </div>
    );
  }

}

export default CandidateDetailView;
