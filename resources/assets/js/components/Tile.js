import React from 'react/addons';
import classNames from 'classnames';

class Tile extends React.Component {

  constructor() {
    super();

    this.onClick = this.onClick.bind(this);
  }

  onClick(event) {
    event.preventDefault();

    this.props.onClick(this);
  }

  render() {
    let candidate = this.props.candidate;
    let photo = `/images/thumbnails/thumb-${candidate.photo}`;

    const classes = classNames('tile', {
      'is-active': this.props.selected,
      '-alternate': this.props.alternate
    });

    return (
      <article className={classes}>
        <a className='wrapper' href={candidate.url} onClick={this.onClick}>
          <div className='tile__meta'>
            <h1>{candidate.name}</h1>
          </div>
          <img alt={candidate.name} src={photo} />

          { /* Hide 'vote' button if using alternate appearance */ }
          {this.props.alternate ? null : <span className='button -round tile__action'>Vote</span>}
        </a>
      </article>
    );
  }

}

export default Tile;
