import React, { Component } from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';

import "./ZeitstrahlElement.scss";

class ZeitstrahlElement extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    const {
      id,
      children,
      iconStyle,
      date
    } = this.props;

    return (
      <div id={id} className="zeitstrahl-element">
          <div>
            <span style={iconStyle} className="zeitstrahl-element-icon">
            <div>{date}</div>
            </span>
            <div className="zeitstrahl-element-content">
              {children}
            </div>
          </div>
      </div>
    );
  }
}

ZeitstrahlElement.propTypes = {
  id: PropTypes.string,
  children: PropTypes.oneOfType([
    PropTypes.arrayOf(PropTypes.node),
    PropTypes.node
  ]),
  iconStyle: PropTypes.shape({}),
  date: PropTypes.node
};

export { ZeitstrahlElement as ZeitstrahlElement };