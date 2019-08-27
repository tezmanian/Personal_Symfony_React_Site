import {serviceConstants} from "../Constants";

const initialState = {
  serviceRequestLoading: false
};

export function service(state = initialState, action) {
  switch (action.type) {
    case serviceConstants.SERVICE_REQUEST_LOADING:
      return Object.assign({}, state, {
        serviceRequestLoading: true
      });
    case serviceConstants.SERVICE_REQUEST_NOT_LOADING:
      return Object.assign({}, state, {
        serviceRequestLoading: false
      });
    default:
      return state;
  }
}