import { combineReducers } from "redux";

import { authentication } from "./Authentication.reducer";
import { users } from "./Users.reducer";
import { alert } from "./Alert.reducer";
import { experiences } from "./Experience.reducer";
import { education } from "./Education.reducer";
import { about } from "./About.reducer";

const rootReducer = combineReducers({
  authentication,
  users,
  alert,
  experiences,
  education,
  about
});

export default rootReducer;
