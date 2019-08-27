import { educationConstants } from "../Constants";
import { educationService } from "../Services";
import { serviceActions, alertActions } from "./index";

export const educationsActions = {
  getEducationList,
  cleanList
};

function getEducationList() {
  return dispatch => {
    dispatch(serviceActions.serviceRequestLoading());
    dispatch(request());

    educationService
      .getEducationList()
      .then(
        educations => {
          dispatch(success(educations));
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
    return { type: educationConstants.GETLIST_REQUEST };
  }
  function success(educations) {
    return { type: educationConstants.GETLIST_SUCCESS, educations };
  }
  function failure(error) {
    return { type: educationConstants.GETLIST_FAILURE, error };
  }
}

function cleanList() {
    return { type: educationConstants.GETLIST_CLEAN };
}
