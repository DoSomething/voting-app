import React, { Component, PropTypes } from 'react/addons';
import DrawerTransitionGroup from './DrawerTransitionGroup';
import CandidateDetailView from './CandidateDetailView';

class Drawer extends Component {

  static propTypes = {
    candidate: PropTypes.object,
    selectItem: PropTypes.fn,
    isOpen: PropTypes.bool,
  };

  static defaultProps = {
    isOpen: false,
  };

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
    this.props.selectItem(this);
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
          <CandidateDetailView candidate={this.props.candidate} />
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

export default Drawer;
