import { experienceConstants } from "../Constants";

export function experiences(state = {}, action) {
  switch (action.type) {
    case experienceConstants.GETLIST_REQUEST:
      return {
        loading: true
      };
    case experienceConstants.GETLIST_SUCCESS:
      return {
        items: action.experiences
      };
    case experienceConstants.GETLIST_FAILURE:
      return {
        error: action.error
      };
    default:
      return state;
  }
}
