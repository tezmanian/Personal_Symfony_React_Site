import { authenticationConstants } from "../Constants";

let user = JSON.parse(localStorage.getItem("user"));
const initialState = user ? { loggedIn: true, user } : {};

export function authentication(state = initialState, action) {
  switch (action.type) {
    case authenticationConstants.LOGIN_REQUEST:
      return {
        loggingIn: true,
        user: action.user
      };
    case authenticationConstants.LOGIN_SUCCESS:
      return {
        loggedIn: true,
        user: action.user
      };
    case authenticationConstants.LOGIN_FAILURE:
      return {};
    case authenticationConstants.LOGOUT:
      return {};
    default:
      return state;
  }
}
