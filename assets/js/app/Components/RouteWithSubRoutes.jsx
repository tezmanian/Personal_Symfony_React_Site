import React, { Suspense } from "react";
import { Route, Redirect, Switch } from "react-router-dom";
import { connect } from "react-redux";

function NoMatch({ location }) {
  return (
    <div>
      <h3>
        No match for <code>{location.pathname}</code>
      </h3>
    </div>
  );
}

function RouteWithSubRoutes( { authentication, ...route } ) {
  console.log(route)
  return route.private ? (
    <Route
      path={route.path}
      exact={route.exact}
      render={props =>
        authentication.loggedIn ? (
          <route.main routes={route.routes} />
        ) : (
          <Redirect
            to={{ pathname: "/login", state: { from: props.location } }}
          />
        )
      }
    />
  ) : (
    <Route
      path={route.path}
      exact={route.exact}
      render={props => <route.main {...props} routes={route.routes} />}
    />
  );
}

function mapStateToProps(state) {
  const { authentication } = state;
  return {
    authentication
  };
}

const connectedRouteWithSubRoutes = connect(mapStateToProps)(
  RouteWithSubRoutes
);
export { connectedRouteWithSubRoutes as RouteWithSubRoutes };
