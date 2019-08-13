import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCog } from '@fortawesome/free-solid-svg-icons'

import "./Navbar.scss";

class Navbar extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      isHidden: true
    };
  }

  toggleHidden() {
    this.setState({
      isHidden: !this.state.isHidden
    });
    this.displayMenu();
  }

  displayMenu() {
    var items = document.getElementsByClassName("menu");
    var i;

    if (this.state.isHidden) {
      for (i = 1; i < items.length; i++) {
        items[i].classList.add("show");
      }
    } else {
      for (i = 1; i < items.length; i++) {
        items[i].classList.remove("show");
      }
    }
  }
  componentDidMount() {}

  render() {
    const { loggedIn } = this.props;
    return (
      <header id="Navbar">
        <nav className="flexmenu">
          <ul className="flex">
            <li className="menu">
              {this.props.menuEntry
                .filter(l => l.path === "/")
                .map(l => (
                  <Link className="person" key={l.label} to={l.path}>
                    {l.label}
                  </Link>
                ))}
            </li>

            {this.props.menuEntry
              .filter(l => l.path !== "/")
              .map(l =>
                (l.private && loggedIn) || l.private !== true ? (
                <li key={l.label} className={"menu " + l.className}>
                  <Link key={l.label} to={l.path}>
                    {l.label}
                  </Link>
                </li>
                ) : (
                  ""
                )
              )}
            <li className="mobile-menu">
              <span
                className="menu-icon open"
                onClick={this.toggleHidden.bind(this)}
                style={{ display: this.state.isHidden ? "block" : "none" }}
              >
                &#x2261;
              </span>
              <span
                className="menu-icon close"
                onClick={this.toggleHidden.bind(this)}
                style={{ display: !this.state.isHidden ? "block" : "none" }}
              >
                &#x2715;
              </span>
            </li>
          </ul>
        </nav>
      </header>
    );
  }

  //);
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

const connectedNavbar = connect(mapStateToProps)(Navbar);
export { connectedNavbar as Navbar };
