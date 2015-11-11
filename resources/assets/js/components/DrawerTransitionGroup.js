import React, { Component } from 'react';
import TransitionGroup from 'react-addons-transition-group';
import DrawerTransitionGroupChild from './DrawerTransitionGroupChild';

class DrawerTransitionGroup extends Component {

  wrapChild(child) {
    return <DrawerTransitionGroupChild>{child}</DrawerTransitionGroupChild>;
  }

  render() {
    return <TransitionGroup {...this.props} childFactory={this.wrapChild} />;
  }

}

export default DrawerTransitionGroup;
