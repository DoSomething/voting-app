import React, { Component } from 'react/addons';
import DrawerTransitionGroupChild from './DrawerTransitionGroupChild';
const { TransitionGroup } = React.addons;

class DrawerTransitionGroup extends Component {

  wrapChild(child) {
    return <DrawerTransitionGroupChild>{child}</DrawerTransitionGroupChild>;
  }

  render() {
    return <TransitionGroup {...this.props} childFactory={this.wrapChild} />;
  }

}

export default DrawerTransitionGroup;
