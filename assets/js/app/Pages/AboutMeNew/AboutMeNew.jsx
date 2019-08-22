import React, {Component} from "react";
import Helmet from "react-helmet";
import {MarkDown} from "../../Helpers";
import classNames from 'classnames';

import {connect} from "react-redux";
import {aboutActions} from "../../Store/Actions";

import "./AboutMe.scss";

import {Zeitstrahl, ZeitstrahlElement} from "./../../Components/VerticalZeitstrahl";

class AboutMeNew extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    this.props.dispatch(aboutActions.getAboutList());
  }

  render() {

    const { about } = this.props;
      console.log(about);
      return (
      <main id="AboutMe">
          {(about.content != null) &&
        <Helmet title={about.content.heading} />
        }

          <div
              className={classNames('fade-out', {
                  'hidden': about.content != null
              })}
          >
              <em>Loading information...</em>
          </div>
          <div
              className={classNames('fade-in', {
                  'visible': about.content != null
              })}
          >

              {(about.content != null) &&
        <article id="about">
          <h1>{about.content.heading}</h1>
          <MarkDown content={about.content.description} />
            {(about.content.items) &&
          <Zeitstrahl header="Die Vergangenheit..." >
          {(about.content.items) && about.content.items.map(function(item, i) {
            const date = new Date(item.year);
            const header = item.header;
            const content = item.content;

            return (
              <ZeitstrahlElement
                key={i}
                className="vertical-timeline-element--work"
                date={date.getFullYear()}
              >
                {(header) &&
                <h3 className="vertical-timeline-element-title">{header}</h3>
                }
                <MarkDown content={content} />
              </ZeitstrahlElement>
            )
          })}
          </Zeitstrahl>}
        </article>
        }
          </div>
      </main>


      );
  }
}

function mapStateToProps(state) {
  const { about } = state;
  return {
    about
  };
}

const connectedAboutMeNew = connect(mapStateToProps)(AboutMeNew);
export { connectedAboutMeNew as AboutMeNew };
