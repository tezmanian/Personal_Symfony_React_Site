import React from "react";
import { Route, Redirect } from "react-router-dom";
import { connect } from "react-redux";

const PrivateRoute = ({ authentication, component: Component, ...rest }) => (
  <div>
    <Route
      {...rest}
      render={props =>
        authentication.loggedIn ? (
          <Component {...props} />
        ) : (
          <Redirect
            to={{ pathname: "/login", state: { from: props.location } }}
          />
        )
      }
    />
  </div>
);

function mapStateToProps(state) {
  const { authentication } = state;
  return {
    authentication
  };
}

const connectedPrivateRoute = connect(mapStateToProps)(PrivateRoute);
export { connectedPrivateRoute as PrivateRoute };
