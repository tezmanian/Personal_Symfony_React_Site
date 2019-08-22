import {aboutConstants} from "../Constants";

const initialState = {
  content: null,
  loading: false
};

export function about(state = initialState, action) {
  switch (action.type) {
    case aboutConstants.GETLIST_REQUEST:
      return Object.assign({}, state, {
        loading: true
      });
    case aboutConstants.GETLIST_SUCCESS:
      return Object.assign({}, state, {
        content: action.about,
        loading: false
      });
    case aboutConstants.GETLIST_CLEAN:
      return initialState;
    case aboutConstants.GETLIST_FAILURE:
      return Object.assign({}, state, {
        content: action.about,
        loading: false,
        error: action.error
      });
    default:
      return state;
  }
}
