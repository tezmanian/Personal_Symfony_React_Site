import React from "react";
import { educationsActions, experienceActions } from "../Store/Actions";
import {store} from "../Store";
import { Redirect } from "react-router-dom";

export const authenticationHelper = {
  login,
  logout
};

/**
 * 
 * @returns void
 */
function logout() {

  store.dispatch(educationsActions.cleanList());
  store.dispatch(experienceActions.cleanList());

  localStorage.removeItem("user");
}

/**
 * 
 * @param Object user
 * @returns void
 */
function login(user) {
  // remove user from local storage to log user out
  localStorage.setItem("user", JSON.stringify(user));
}
