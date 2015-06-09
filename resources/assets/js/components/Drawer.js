import React from 'react/addons';
const { CSSTransitionGroup } = React.addons;
import Tile from './Tile';

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
          <div className='candidate'>
            <div className='wrapper'>
              <div className="candidate__info">
                <Tile candidate={this.props.candidate} alternate={true} />
                <p className="candidate__description">{this.props.candidate.description}</p>
              </div>

              <div className="candidate__actions">
                Whatcha gonna do about it.
              </div>
            </div>
          </div>
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
