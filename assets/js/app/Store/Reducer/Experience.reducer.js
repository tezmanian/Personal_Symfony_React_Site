import { experienceConstants } from "../Constants";

const initialState = {
  items: [],
  loading: false
};

export function experiences(state = initialState, action) {
  switch (action.type) {
    case experienceConstants.GETLIST_REQUEST:
      return Object.assign({}, state, {
        loading: true
      });
    case experienceConstants.GETLIST_SUCCESS:
      return Object.assign({}, state, {
        items: action.experiences,
        loading: false
      });

    case experienceConstants.GETLIST_CLEAN:
      return initialState;
    case experienceConstants.GETLIST_FAILURE:
      return {
        error: action.error
      };
    default:
      return state;
  }
}
