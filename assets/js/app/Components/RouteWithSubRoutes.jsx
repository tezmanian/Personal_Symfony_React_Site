import { Route, Switch } from "react-router-dom";
import React, { Suspense } from "react";
import AsyncPage from "./AsyncPage";
import PrivateRoute from "./PrivateRoute";

function NoMatch({ location }) {
  return (
    <div>
      <h3>
        No match for <code>{location.pathname}</code>
      </h3>
    </div>
  );
}

function RouteWithSubRoutes({ routes, profile }) {
  return (
    <Suspense fallback={<div>Loading...</div>}>
      <Switch>
        {routes.map((route, i) =>
          route.private ? (
            <PrivateRoute
              exact={route.exact}
              path={route.path}
              component={
                <AsyncPage
                  page={route.main}
                  {...props}
                  profile={profile}
                  routes={route.routes}
                />
              }
            />
          ) : (
            <Route
              key={i}
              path={route.path}
              exact={route.exact}
              render={props => (
                <AsyncPage
                  page={route.main}
                  {...props}
                  profile={profile}
                  routes={route.routes}
                />
              )}
            />
          )
        )}
        <Route component={NoMatch} />
      </Switch>
    </Suspense>
  );
}

export default RouteWithSubRoutes;
