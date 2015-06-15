import React from 'react/addons';
import CandidateDetailView from './CandidateDetailView';
const { CSSTransitionGroup } = React.addons;

class Drawer extends React.Component {

  /**
   * Send 'close' event to parent component.
   * @param event
   */
  close(event) {
    event.preventDefault();

    // De-select this item.
    this.props.selectItem(this);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    let drawer;

    if(this.props.isOpen) {
      drawer = (
        <div className='drawer'>
          <CandidateDetailView candidate={this.props.candidate} />
          <a href="#" className="drawer__close" onClick={this.close.bind(this)}><span>Close</span></a>
        </div>
      );
    }

    return (
      <CSSTransitionGroup transitionName="drawer-animation">
        {drawer}
      </CSSTransitionGroup>
    )
  }

}

export default Drawer;
