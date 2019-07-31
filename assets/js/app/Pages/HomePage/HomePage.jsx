import React, { Component } from "react";
import { Link } from "react-router-dom";
import Helmet from "react-helmet";
import markdown from "../../../data/AboutThisSide.md";
import { MarkDown } from "../../Helpers";

import "./HomePage.scss";

class HomePage extends Component {
  constructor(props) {
    super(props);
    this.state = {};
    this.profile = {
      home: {
        title: "Software Developer / Maker / FPV-Pilot",
        image: "",
        content:
          "Ich beschäftige mich leidenschaftlich mit der Entwicklung von Computersoftware, Fotografie, 3D Druck und Modellbau im Bereich Multikopter. <br> Problemstellungen werden immer kreativ und mit den passenden Technik gelöst"
      }
    };
  }

  createMarkup() {
    return { __html: this.profile.home.content };
  }

  render() {
    return (
      <main>
        <Helmet title="Über die Webseite" />
        <article id="about">
          <MarkDown content={markdown} />
        </article>
      </main>
    );
  }
}
export { HomePage };
