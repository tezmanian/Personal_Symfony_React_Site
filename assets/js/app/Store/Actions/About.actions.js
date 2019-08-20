import { aboutConstants } from "../Constants";
import { aboutService } from "../Services";

export const aboutActions = {
  getAboutList,
  cleanList
};

function getAboutList() {
  return dispatch => {
    dispatch(request());

    aboutService
      .getAboutList()
      .then(
        about => dispatch(success(about)),
        error => dispatch(failure(error))
      );
  };

  function request() {
    return { type: aboutConstants.GETLIST_REQUEST };
  }
  function success(about) {
    return { type: aboutConstants.GETLIST_SUCCESS, about };
  }
  function failure(error) {
    return { type: aboutConstants.GETLIST_FAILURE, error };
  }
}

function cleanList() {
    return { type: aboutConstants.GETLIST_CLEAN };
}