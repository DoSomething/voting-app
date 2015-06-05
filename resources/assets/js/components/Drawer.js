import React from 'react/addons';
import Tile from './Tile';

class Drawer extends React.Component {

  render() {
    return (
        <div className='drawer'>
          <div className='candidate'>
            <div className='wrapper'>
              <div className="candidate__info">
                <Tile candidate={this.props.candidate} alternate={true} />
                <p>{this.props.candidate.description}</p>
              </div>

              <div className="candidate__actions">
                Whatcha gonna do about it.
              </div>
            </div>
          </div>
        </div>
    )
  }

}

export default Drawer;
