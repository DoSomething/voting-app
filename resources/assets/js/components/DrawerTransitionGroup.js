import React, { Component } from 'react/addons';
import DrawerTransitionGroupChild from './DrawerTransitionGroupChild';
const { TransitionGroup } = React.addons;

class DrawerTransitionGroup extends Component {

  render() {
    return <TransitionGroup {...this.props} childFactory={this.wrapChild} />;
  }

  wrapChild(child) {
    return <DrawerTransitionGroupChild>{child}</DrawerTransitionGroupChild>;
  }

}

export default DrawerTransitionGroup;
