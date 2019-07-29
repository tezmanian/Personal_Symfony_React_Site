import React, { Component } from "react";

import "./ThatsMe.scss";
// import logo from "../../assets/ReneLogo.jpg";

class ThatsMe extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  render() {
    return (
      <div id="ThatsMe">
        <div />
        {/* <img src={logo} alt={this.props.profile.name} /> */}
        <header>
          {/* <h2>{this.props.profile.name}</h2> */}
          <h2>René Halberstadt</h2>
          <p className="email">
            <a
              className="mailto"
              // href={"mailto:" + this.props.profile.contact.email}
              href={"mailto:halberstadt.r@web.de"}
            >
              halberstadt.r@web.de
            </a>
          </p>
        </header>
      </div>
    );
  }
}

export default ThatsMe;
