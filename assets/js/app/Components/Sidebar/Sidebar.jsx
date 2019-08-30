import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import { data } from "../../../data/Contact";
import markdown from "../../../data/Sidebar.md";
import { MarkDown } from "../../Helpers";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import "./Sidebar.scss";

import ThatsMe from "./ThatsMe";

class Sidebar extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  render() {
    const { user, users } = this.props;

    return (
      <div id="sidebar-container">
        <section id="sidebar-header" className="responsive">
          <ThatsMe />
        </section>
        <section id="sidebar-content-1" className="responsive">
          <article>
            <MarkDown content={markdown} />
            <div className="aboutMe">
              <div>
                <Link className="flex-row" to="/about">
                  Über mich
                </Link>
              </div>
            </div>
          </article>
        </section>
        <section id="sidebar-footer" className="responsive">
          <ul className="icons">
            {data.map(s => (
              <li key={s.label}>
                <a href={s.link}>
                  <FontAwesomeIcon icon={s.icon} />
                </a>
              </li>
            ))}
          </ul>
        </section>
        <section id="sidebar-impressum" className="responsive">
          <Link className="flex-row" to="/imprint">
          Impressum
          </Link>
        </section>
      </div>
    );
  }
}

function mapStateToProps(state) {
  const { users, authentication } = state;
  const { user, loggedIn } = authentication;
  return {
    loggedIn,
    user,
    users,
    authentication
  };
}

const connectedSidebar = connect(mapStateToProps)(Sidebar);
export { connectedSidebar as Sidebar };
