import { educationsActions, experienceActions } from "../Store/Actions";
import {store} from "../Store";

export const authenticationHelper = {
  login,
  logout
};

function logout(reload) {

  store.dispatch(educationsActions.cleanList());
  store.dispatch(experienceActions.cleanList());
  // remove user from local storage to log user out
  localStorage.removeItem("user");
//  if (reload === true) {
//    location.reload(true);
//  }
}

function login(user) {
  // remove user from local storage to log user out
  localStorage.setItem("user", JSON.stringify(user));
}
