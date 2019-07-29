export const authenticationHelper = {
  login,
  logout
};

function logout(reload) {
  // remove user from local storage to log user out
  localStorage.removeItem("user");
  if (reload === true) {
    location.reload(true);
  }
}

function login(user) {
  // remove user from local storage to log user out
  localStorage.setItem("user", JSON.stringify(user));
}
