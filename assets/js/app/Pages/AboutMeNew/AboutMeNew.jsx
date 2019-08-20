import React, { Component } from "react";
import markdown from "../../../data/AboutMe.md";
import Helmet from "react-helmet";
import { MarkDown } from "../../Helpers";

import { connect } from "react-redux";
import { aboutActions } from "../../Store/Actions";

import "./AboutMe.scss";

import { Zeitstrahl, ZeitstrahlElement } from "./../../Components/VerticalZeitstrahl";

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
    return (     
      <main id="AboutMe">
        {(about.loading == false) &&
        <Helmet title={about.content.heading} />
        }
        {(about.loading == false) &&
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
