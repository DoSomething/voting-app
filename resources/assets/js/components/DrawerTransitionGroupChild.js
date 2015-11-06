import React, { Component } from 'react/addons';
import { slideUp, slideDown } from '../utilities/dom';

class DrawerTransitionGroupChild extends Component {

  static propTypes = {
    children: React.PropTypes.node,
  };

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

export default DrawerTransitionGroupChild;
