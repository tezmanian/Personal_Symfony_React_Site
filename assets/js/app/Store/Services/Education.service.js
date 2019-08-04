import { authHeader } from "../../Helpers";
import { responseHelper } from "../../Helpers";

export const educationService = {
  getEducationList
};

function getEducationList() {
  const requestOptions = {
    method: "GET",
    headers: authHeader()
  };

  return fetch("/api/education", requestOptions).then(
    responseHelper.handleAuthenticatedResponse
  );
}
