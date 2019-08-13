import React, { Suspense } from "react";
import { Route, Redirect, Switch } from "react-router-dom";
import { connect } from "react-redux";


const RouteWithSubRoutes = ( { ...route } ) => {
  
  console.log(route)
  return (
    <Route
      path={route.path}
      exact={route.exact}
      render={props => <route.component {...props} routes={route.routes} />}
    />
    )
}
