import { serviceConstants } from "../Constants";

export const serviceActions = {
  serviceRequestLoading,
  serviceRequestNotLoading
};

function serviceRequestLoading() {
  return { type: serviceConstants.SERVICE_REQUEST_LOADING };
}

function serviceRequestNotLoading() {
  return { type: serviceConstants.SERVICE_REQUEST_NOT_LOADING };
}