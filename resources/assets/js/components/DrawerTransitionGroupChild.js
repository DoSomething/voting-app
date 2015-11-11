import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { slideUp, slideDown } from '../utilities/dom';

class DrawerTransitionGroupChild extends Component {

  componentWillEnter(done) {
    const node = ReactDOM.findDOMNode(this);
    slideDown(node, done);
  }

  componentWillLeave(done) {
    const node = ReactDOM.findDOMNode(this);
    slideUp(node, done);
  }

  render() {
    return React.Children.only(this.props.children);
  }

}

DrawerTransitionGroupChild.propTypes = {
  children: React.PropTypes.node,
};

export default DrawerTransitionGroupChild;
