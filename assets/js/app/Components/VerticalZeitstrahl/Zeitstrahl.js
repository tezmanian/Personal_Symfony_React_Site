import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';

import "./Zeitstrahl.scss";

const Zeitstrahl = ({ children, header, className }) => (
  <div>
    {header && <h3>{header}</h3>}
  <div
    className={classNames(className, 'zeitstrahl')}
  >
    {children}
    <div className="zeitstrahl-element end"><span></span></div>
  </div>
  </div>
);

Zeitstrahl.propTypes = {
  children: PropTypes.oneOfType([
    PropTypes.arrayOf(PropTypes.node),
    PropTypes.node,
  ]).isRequired,
  header: PropTypes.string,
  className: PropTypes.string
};


export { Zeitstrahl as Zeitstrahl };