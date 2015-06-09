import React from 'react/addons';
const { CSSTransitionGroup } = React.addons;
import CandidateDetailView from './CandidateDetailView';

class Drawer extends React.Component {

  close(event) {
    event.preventDefault();

    // De-select this item.
    this.props.selectItem(this);
  }

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
      <CSSTransitionGroup transitionName="drawer-animation" transitionAppear={true} transitionLeave={true}>
        {drawer}
      </CSSTransitionGroup>
    )
  }

}

export default Drawer;
