import {
  authHeader,
  responseHelper,
  authenticationHelper
} from "../../Helpers";

export const userService = {
  login,
  logout,
  getAll,
  getUser
};

function login(username, password) {
  const requestOptions = {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ username, password })
  };

  return fetch("/api/login", requestOptions)
    .then(responseHelper.handleStandardResponse)
    .then(user => {
      authenticationHelper.login(user);
      return user;
    });
}

function logout() {
  //Backwards compatibility
  authenticationHelper.logout();
}

function getAll() {
  const requestOptions = {
    method: "GET",
    headers: authHeader()
  };

  return fetch("/api/user/get", requestOptions).then(
    responseHelper.handleStandardResponse
  );
}

function getUser() {
  const requestOptions = {
    method: "GET",
    headers: authHeader()
  };

  return fetch("/api/user/get", requestOptions).then(
    responseHelper.handleStandardResponse
  );
}
