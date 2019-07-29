import { authenticationConstants, userConstants } from "../Constants";

export function users(state = {}, action) {
  switch (action.type) {
    case authenticationConstants.GETALL_REQUEST:
      return {
        loading: true
      };
    case authenticationConstants.GETALL_SUCCESS:
      return {
        items: action.users
      };
    case authenticationConstants.GETALL_FAILURE:
      return {
        error: action.error
      };

    case userConstants.GETUSER_REQUEST:
      return {
        loading: true
      };
    case userConstants.GETUSER_SUCCESS:
      return {
        activeUser: action.user
      };
    case userConstants.GETUSER_FAILURE:
      return {
        error: action.error
      };
    default:
      return state;
  }
}
