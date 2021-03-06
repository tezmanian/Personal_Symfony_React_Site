import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import "./LoginPage.scss";
import Helmet from "react-helmet";

import { userActions } from "../../Store/Actions";

class LoginPage extends React.Component
{
  constructor(props)
  {
    super(props);
    this.props.dispatch(userActions.logout());

    this.state = {
      username: "",
      password: "",
      submitted: false
    };

    this.handleChange = this.handleChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  handleChange(e)
  {
    const {name, value} = e.target;
    this.setState({[name]: value});
    if (this.state.submitted) {
      this.setState({submitted: false});
    }
  }

  handleSubmit(e)
  {
    e.preventDefault();

    this.setState({submitted: true});
    const {username, password} = this.state;
    const {dispatch} = this.props;
    if (username && password)
    {
      dispatch(userActions.login(username, password));
    }
  }

  render()
  {
    const {loggingIn, alert} = this.props;
    const {username, password, submitted} = this.state;

    return (
            <div id="login_form">
              <Helmet title="Login" />
              <div>
                <h2>Login</h2>
                <form name="form" onSubmit={this.handleSubmit}>
                  <div
                    className={"group" + (submitted && !username ? " has-error" : "")}
                    >
                    <div className="label">
                      <label htmlFor="username">Username</label>
                    </div>
                    <div className="input">
                      <input
                        type="text"
                        className="form-control"
                        name="username"
                        value={username}
                        onChange={this.handleChange}
                        />
                      {submitted && !username && (
                          <div className="help-block">Username is required</div>
                                )}
                    </div>
                  </div>
                  <div className={"group" + (submitted && !password ? " has-error" : "")}>
                    <div className="label">
                      <label htmlFor="password">Password</label>
                    </div>
                    <div className="input">
                      <input
                        type="password"
                        className="form-control"
                        name="password"
                        value={password}
                        onChange={this.handleChange}
                        />
                      {submitted && !password && (
                          <div className="help-block">Password is required</div>
                                )}
                    </div>
                  </div>
                  <div className="group">
                    {submitted && username && password && (
                          <div className={"message " + alert.type}>{alert.message}</div>
                              )}
                    <button className="submit">Login</button>
                    {loggingIn && (
                          <img src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" />
                              )}
                  </div>
                </form>
              </div>
            </div>
            );
  }
}

function mapStateToProps(state)
{
  const {alert, authentication} = state;
  const {loggingIn} = authentication;
  return {
    alert,
    loggingIn
  };
}

const connectedLoginPage = connect(mapStateToProps)(LoginPage);
export { connectedLoginPage as LoginPage };
