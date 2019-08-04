import { userActions } from "./../Store/Actions";
import { store } from "./../Store";

export const responseHelper = {
  handleStandardResponse,
  handleAuthenticatedResponse,
  handleLogResponse
};

/**
 * Handels response from requests
 * 
 * @param Object response
 * @returns Object
 */
function handleStandardResponse(response) {
  return response.text().then(text => {
    const data = text && JSON.parse(text);
    if (!response.ok) {
        
      // Handling need to implemented later
      if (response.status === 401) {

      }

      const error = (data && data.message) || response.statusText;
      return Promise.reject(error);
    }

    return data;
  });
}

/**
 * Handles response from authenticated requests
 * 
 * @param Object response
 * @returns Object
 */
function handleAuthenticatedResponse(response) {
  return response.text().then(text => {
    const data = text && JSON.parse(text);
    if (!response.ok) {
      if (response.status === 401) {
        store.dispatch(userActions.logout());
      }

      const error = (data && data.message) || response.statusText;
      return Promise.reject(error);
    }

    return data;
  });
}

/**
 * Debugresponse
 * @param Object response
 * @returns Object
 */
function handleLogResponse(response) {
  return response.text().then(text => {
    const data = text && JSON.parse(text);
    console.log(data);
    if (!response.ok) {
      if (response.status === 401) {
        dispatch(userActions.logout());
      }

      const error = (data && data.message) || response.statusText;
      return Promise.reject(error);
    }

    return data;
  });
}
