import { experienceConstants } from "../Constants";
import { experienceService } from "../Services";
import { history } from "../../Helpers";

export const experienceActions = {
  getJobExperienceList,
  cleanList
};

function getJobExperienceList() {
  return dispatch => {
    dispatch(request());

    experienceService
      .getJobExperienceList()
      .then(
        experiences => dispatch(success(experiences)),
        error => dispatch(failure(error))
      );
  };

  function request() {
    return { type: experienceConstants.GETLIST_REQUEST };
  }
  function success(experiences) {
    return { type: experienceConstants.GETLIST_SUCCESS, experiences };
  }
  function failure(error) {
    return { type: experienceConstants.GETLIST_FAILURE, error };
  }
}

function cleanList() {
    return { type: experienceConstants.GETLIST_CLEAN };
}