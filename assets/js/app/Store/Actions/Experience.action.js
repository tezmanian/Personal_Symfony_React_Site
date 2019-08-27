import { experienceConstants } from "../Constants";
import { experienceService } from "../Services";
import { serviceActions, alertActions } from "./index";

export const experienceActions = {
  getJobExperienceList,
  cleanList
};

function getJobExperienceList() {
  return dispatch => {
    dispatch(serviceActions.serviceRequestLoading());
    dispatch(request());

    experienceService
      .getJobExperienceList()
      .then(
        experiences => {
          dispatch(success(experiences));
          dispatch(serviceActions.serviceRequestNotLoading());
        },
        error => {
          dispatch(failure(error));
          dispatch(serviceActions.serviceRequestNotLoading());
          dispatch(alertActions.error(error));
        }
                
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