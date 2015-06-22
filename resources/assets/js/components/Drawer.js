import React from 'react/addons';
import CandidateDetailView from './CandidateDetailView';
const { CSSTransitionGroup } = React.addons;

class DrawerContents extends React.Component {

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    return (
      <div className='drawer'>
        <CandidateDetailView candidate={this.props.candidate} />
        <a href="#" className="drawer__close" onClick={this.props.close}><span>Close</span></a>
      </div>
    );
  }

}

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
    return (
      <CSSTransitionGroup transitionName="drawer-animation">
        {this.props.isOpen ? <DrawerContents candidate={this.props.candidate} close={this.close.bind(this)} /> : null}
      </CSSTransitionGroup>
    )
  }

}

export default Drawer;
