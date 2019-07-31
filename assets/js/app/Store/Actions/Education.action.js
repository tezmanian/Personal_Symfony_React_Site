import { educationConstants } from "../Constants";
import { educationService } from "../Services";

export const educationsActions = {
  getEducationList,
  cleanList
};

function getEducationList() {
  return dispatch => {
    dispatch(request());

    educationService
      .getEducationList()
      .then(
        educations => dispatch(success(educations)),
        error => dispatch(failure(error))
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
