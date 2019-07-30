import { authenticationConstants, userConstants } from "../Constants";
import { userService } from "../Services";
import { history } from "../../Helpers";
import { alertActions } from "./Alert.actions";
  
export const userActions = {
  login,
  logout,
  getAll,
  getUser
};

function login(username, password) {
  return dispatch => {
    dispatch(request({ username }));

    userService.login(username, password).then(
      user => {
        dispatch(success(user));
        history.push("/");
      },
      error => {
        dispatch(failure(error));
        dispatch(alertActions.error(error));
      }
    );
  };

  function request(user) {
    return { type: authenticationConstants.LOGIN_REQUEST, user };
  }
  function success(user) {
    return { type: authenticationConstants.LOGIN_SUCCESS, user };
  }
  function failure(error) {
    return { type: authenticationConstants.LOGIN_FAILURE, error };
  }
}

function logout() {
  userService.logout();
  return { type: authenticationConstants.LOGOUT };
}

function getAll() {
  return dispatch => {
    dispatch(request());

    userService
      .getAll()
      .then(
        users => dispatch(success(users)),
        error => dispatch(failure(error))
      );
  };

  function request() {
    return { type: authenticationConstants.GETALL_REQUEST };
  }
  function success(users) {
    return { type: authenticationConstants.GETALL_SUCCESS, users };
  }
  function failure(error) {
    return { type: authenticationConstants.GETALL_FAILURE, error };
  }
}

function getUser() {
  return dispatch => {
    dispatch(request());

    userService
      .getUser()
      .then(user => dispatch(success(user)), error => dispatch(failure(error)));
  };

  function request() {
    return { type: userConstants.GETUSER_REQUEST };
  }
  function success(user) {
    return { type: userConstants.GETUSER_SUCCESS, user };
  }
  function failure(error) {
    return { type: userConstants.GETUSER_FAILURE, error };
  }
}
