import React from "react";
import { render } from "react-dom";
import { Provider } from "react-redux";

import { store } from "./Store";
import { App } from "./App";
import "./Layout.scss";

// setup fake backend
//import { configureFakeBackend } from "./Helpers";
//configureFakeBackend();

render(
  <Provider store={store}>
    <App />
  </Provider>,
  document.getElementById("root")
);
