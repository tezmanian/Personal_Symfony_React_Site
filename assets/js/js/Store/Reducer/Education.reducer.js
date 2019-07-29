import { educationConstants } from "../Constants";

export function education(state = {}, action) {
  switch (action.type) {
    case educationConstants.GETLIST_REQUEST:
      return {
        loading: true
      };
    case educationConstants.GETLIST_SUCCESS:
      return {
        items: action.educations
      };
    case educationConstants.GETLIST_FAILURE:
      return {
        error: action.error
      };
    default:
      return state;
  }
}
