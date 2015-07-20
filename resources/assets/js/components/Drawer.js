import React, { Component } from 'react/addons';
import CandidateDetailView from './CandidateDetailView';
import { slideUp, slideDown } from '../utilities/dom';
const { TransitionGroup } = React.addons;

class DrawerTransitionGroupChild extends Component {

  componentWillEnter(done) {
    const node = React.findDOMNode(this);
    slideDown(node, done);
  }

  componentWillLeave(done) {
    const node = React.findDOMNode(this);
    slideUp(node, done);
  }

  render() {
    return React.Children.only(this.props.children);
  }

}

class DrawerTransitionGroup extends Component {
  _wrapChild(child) {
    return <DrawerTransitionGroupChild>{child}</DrawerTransitionGroupChild>;
  }

  render() {
    return <TransitionGroup {...this.props} childFactory={this._wrapChild} />;
  }
}

class DrawerContents extends Component {

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

class Drawer extends Component {

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
      <DrawerTransitionGroup>
        {this.props.isOpen ? <DrawerContents candidate={this.props.candidate} close={this.close.bind(this)} /> : null}
      </DrawerTransitionGroup>
    )
  }

}

Drawer.defaultProps = {
  isOpen: false
};

export default Drawer;
