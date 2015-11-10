import React, { Component, PropTypes } from 'react/addons';
import DrawerTransitionGroup from './DrawerTransitionGroup';

class Drawer extends Component {

  constructor() {
    super();

    this.onClose = this.onClose.bind(this);
  }

  /**
   * Send 'close' event to parent component.
   * @param {MouseEvent} event - 'click'
   */
  onClose(event) {
    event.preventDefault();

    // De-select this item.
    this.props.onSelect(this);
  }

  /**
   * Render component.
   * @returns {XML}
   */
  render() {
    let contents = null;

    if (this.props.isOpen) {
      contents = (
        <div className="drawer">
          {this.props.children}
          <a href="#" className="drawer__close" onClick={this.onClose}><span>Close</span></a>
        </div>
      );
    }

    return (
      <DrawerTransitionGroup>
        {contents}
      </DrawerTransitionGroup>
    );
  }
}

Drawer.propTypes = {
  candidate: PropTypes.object,
  onSelect: PropTypes.func,
  isOpen: PropTypes.bool,
  children: PropTypes.element.isRequired,
};

Drawer.defaultProps = {
  isOpen: false,
};

export default Drawer;
