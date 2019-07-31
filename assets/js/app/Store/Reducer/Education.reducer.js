import { educationConstants } from "../Constants";

const initialState = {
  items: [],
  loading: false
};

export function education(state = initialState, action) {
  switch (action.type) {
    case educationConstants.GETLIST_REQUEST:
      return Object.assign({}, state, {
        loading: true
      });
    case educationConstants.GETLIST_SUCCESS:
      return Object.assign({}, state, {
        items: action.educations,
        loading: false
      });
    case educationConstants.GETLIST_CLEAN:
      return initialState;
    case educationConstants.GETLIST_FAILURE:
      return {
        error: action.error
      };
    default:
      return state;
  }
}
