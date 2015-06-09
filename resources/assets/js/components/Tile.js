import React from 'react/addons';
import classNames from 'classnames';

class Tile extends React.Component {

  constructor() {
    super();

    this.onClick = this.onClick.bind(this);
  }

  /**
   * Send click event to parent component.
   */
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

    let content = (
      <div>
        <div className='tile__meta'>
          <h1>{candidate.name}</h1>
        </div>
        <img alt={candidate.name} src={photo} />
      </div>
    );

    if(this.props.alternate) {
      return (
        <article className={classes}>
          <div className='wrapper'>
            {content}
          </div>
        </article>
      );
    }

    return (
      <article className={classes}>
        <a className='wrapper' href={candidate.url} onClick={this.onClick}>
          {content}
          <span className='button -round tile__action'>Vote</span>
        </a>
      </article>
    );
  }

}

export default Tile;
