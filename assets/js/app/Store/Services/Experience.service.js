import { authHeader, responseHelper } from "../../Helpers";
import { userService } from "./User.service";

export const experienceService = {
  getJobExperienceList
};

function getJobExperienceList() {
  const requestOptions = {
    method: "GET",
    headers: authHeader()
  };

  return fetch("/api/job/experience", requestOptions).then(
    responseHelper.handleStandardResponse
  );
}
