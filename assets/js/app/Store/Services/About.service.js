import { responseHelper } from "../../Helpers";

export const aboutService = {
  getAboutList
};

function getAboutList() {
  const requestOptions = {
    method: "GET"
  };

  return fetch("/api/about", requestOptions).then(
    responseHelper.handleAuthenticatedResponse
  );
}