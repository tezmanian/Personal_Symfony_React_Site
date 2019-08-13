import React, { useState, useEffect } from 'react';
import { connect } from "react-redux";
import { Sidebar } from "../Sidebar";
import { HomePage, Resume, AboutMe, SettingsPage, LoginPage } from "../../Pages";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faCog } from '@fortawesome/free-solid-svg-icons';

export const Routes = ({loggedIn}) => {
 
  return [
    {
      path: "/",
      exact: true,
      sidebar: () => <Sidebar />,
      main: () => <HomePage />,
      className: 'home',
      label: "Rene Halberstadt"
    },
    {
      path: "/about",
      exact: true,
      sidebar: () => <Sidebar />,
      main: () => <AboutMe />,
      className: 'about',
      label: "Über mich"
    },
    {
      path: "/resume",
      exact: true,
      sidebar: () => <Sidebar />,
      //main: "Resume/index",
      main: () => <Resume />,
      private: true,
      className: 'resume',
      label: "Lebenslauf",
    },
    {
      path: "/login",
      className: 'login',
      label:
              (loggedIn) ? 'Logout' : 'Login',
    },
    {
      path: "/settings",
      exact: true,
      sidebar: () => <Sidebar />,
      main: () => <HomePage />,
      private: true,
      className: 'settings',
      label: <FontAwesomeIcon icon={faCog} />
    }
  ];
}

