import { aboutConstants } from "../Constants";
import { aboutService } from "../Services";
import { serviceActions, alertActions } from "./index";

export const aboutActions = {
  getAboutList,
  cleanList
};

function getAboutList() {
  return dispatch => {
    dispatch(serviceActions.serviceRequestLoading());
    dispatch(request());

    aboutService
      .getAboutList()
      .then(
        about => {
          dispatch(success(about));
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
