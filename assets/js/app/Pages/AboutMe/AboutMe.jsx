import React, { Component } from "react";
import markdown from "../../../data/AboutMe.md";
import ReactMarkdown from "react-markdown";
import { Link } from "react-router-dom";
import Helmet from "react-helmet";
import emoji from "emoji-dictionary";
import { MarkDown } from "../../Helpers";

import "./AboutMe.scss";

const LinkRenderer = ({ ...children }) => <Link {...children} />;

const emojiSupport = text =>
  text.value.replace(/:\w+:/gi, name => emoji.getUnicode(name));

class AboutMe extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <main id="AboutMe">
        <Helmet title="Über mich" />
        <article id="about">
          <MarkDown content={markdown} />
        </article>
      </main>
    );
  }
}
export { AboutMe };
