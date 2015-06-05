import React from 'react/addons';
import Gallery from './Gallery';

class CandidateIndex extends React.Component {

  render() {
    var galleries = this.props.categories.map(function(category) {
      return (
        <div key={category.id} className='category'>
          <h2 className='gallery-heading'>{category.name}</h2>
          <Gallery items={category.candidates} />
        </div>
      );
    });

    return <div>{galleries}</div>;
  }

};

export default CandidateIndex;
