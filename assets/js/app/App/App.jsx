import React, { Suspense } from "react";
import { Router, Route, Link, Switch } from "react-router-dom";
import { connect } from "react-redux";

import Helmet from "react-helmet";
import { history } from "../Helpers";
import { alertActions, userActions } from "../Store/Actions";
import { PrivateRoute, Navbar, Sidebar, Alert } from "../Components";
import { HomePage, LoginPage, Resume, AboutMe } from "../Pages";
import { Routes } from '../Components/Routing/Routes';

import "./App.scss";

class App extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      routes: [],
      updateRoutes: false
    };
    const { dispatch } = this.props;
    history.listen((location, action) => {
      // clear alert on location change
      dispatch(alertActions.clear());
    });

//    if (this.props.loggedIn === true) {
//      dispatch(userActions.getUser());
//    }
    
    this.routes = [];
    

  }



  componentDidMount() {
    
    this.timerID = setInterval(
      () => this.tick(),
      1000
    );
  }

  componentWillUnmount() {
    clearInterval(this.timerID);
  }

  componentDidUpdate(prevProps) {
  
    const {loggedIn} = this.props;
    
  }

  tick() {
//    this.setState({
//      //date: new Date()
//    });
  }

  checkLoggedIn() {
    const {loggedIn} = this.props;
  
  
    if (loggedIn) {
      //setInterval(function() {
      //dispatch(alertActions.clear());
      //alert("Hello");
      //}, 30000);
    }
  }


  render() {
    const { alert, loggedIn } = this.props;
    const routes = Routes({loggedIn})
    return (
      <div>
        <div id="App">
          <Helmet>
            <title>René Halberstadt</title>
            <meta name="description" content="Helmet application" />
          </Helmet>
          { alert &&
          <Alert />
          }
          <Router history={history}>
            <Navbar menuEntry={routes} />

            <div id="flex-grid">
              {/** route for main div */}
              <div id="main">
                <div>
                  <Suspense fallback={<div>Loading...</div>}>
                    <Switch>
                      <Route path="/login" component={LoginPage} />
                      {routes.map(route =>
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
                    {routes.map(route => (
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
  const { authentication, alert } = state;
  const { loggedIn } = authentication;
  return {
    loggedIn,
    alert
  };
}

const connectedApp = connect(mapStateToProps)(App);
export { connectedApp as App };
