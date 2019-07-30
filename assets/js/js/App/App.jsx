import React, { Suspense } from "react";
import { Router, Route, Link, Switch } from "react-router-dom";
import { connect } from "react-redux";

import Helmet from "react-helmet";
import { history } from "../Helpers";
import { alertActions, userActions } from "../Store/Actions";
import { PrivateRoute, Navbar, Sidebar } from "../Components";
import { HomePage, LoginPage, Resume, AboutMe } from "../Pages";

import "./App.scss";

class App extends React.Component {
  constructor(props) {
    super(props);

    const { dispatch } = this.props;
    history.listen((location, action) => {
      // clear alert on location change
      dispatch(alertActions.clear());
    });

    if (this.props.loggedIn === true) {
      dispatch(userActions.getUser());
    }

    this.routes = [
      {
        path: "/",
        exact: true,
        sidebar: () => <Sidebar />,
        main: () => <HomePage />,
        label: "Rene Halberstadt"
      },
      {
        path: "/about",
        exact: true,
        sidebar: () => <Sidebar />,
        main: () => <AboutMe />,
        label: "Über mich"
      },
      {
        path: "/resume",
        exact: true,
        sidebar: () => <Sidebar />,
        //main: "Resume/index",
        main: () => <Resume />,
        private: true,
        label: "Lebenslauf"
      }
    ];
  }

  checkLoggedIn() {
    if (this.props.loggedIn) {
      //setInterval(function() {
      //dispatch(alertActions.clear());
      //alert("Hello");
      //}, 30000);
    }
  }

  componentDidMount() {
    this.checkLoggedIn();
  }

  render() {
    const { alert, loggedIn } = this.props;

    return (
      <div>
        <div id="App">
          <Helmet>
            <title>René Halberstadt</title>
            <meta name="description" content="Helmet application" />
          </Helmet>
          <Router history={history}>
            <Navbar menuEntry={this.routes} />

            <div id="flex-grid">
              {/** route for main div */}
              <div id="main">
                <div>
                  <Suspense fallback={<div>Loading...</div>}>
                    <Switch>
                      {/* <PrivateRoute exact path="/" component={HomePage} /> */}
                      <Route path="/login" component={LoginPage} />
                      {this.routes.map(route =>
                        route.private ? (
                          <PrivateRoute
                            key={route.path}
                            path={route.path}
                            exact={route.exact}
                            component={route.main}
                          />
                        ) : (
                          <Route
                            key={route.path}
                            path={route.path}
                            exact={route.exact}
                            component={route.main}
                          />
                        )
                      )}
                    </Switch>
                  </Suspense>
                </div>
              </div>
              {/** route for sidebar */}
              <aside id="sidebar">
                <Suspense fallback={<div>Loading...</div>}>
                  <Switch>
                    <Route path="/login" component={Sidebar} />
                    {this.routes.map(route => (
                      <Route
                        key={route.path}
                        path={route.path}
                        exact={route.exact}
                        component={route.sidebar}
                      />
                    ))}
                  </Switch>
                </Suspense>
              </aside>
            </div>
          </Router>
        </div>
      </div>
    );
  }
}

function mapStateToProps(state) {
  const { authentication } = state;
  const { loggedIn } = authentication;
  return {
    loggedIn
  };
}

const connectedApp = connect(mapStateToProps)(App);
export { connectedApp as App };
