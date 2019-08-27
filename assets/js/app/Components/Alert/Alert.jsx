import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faWindowClose } from '@fortawesome/free-solid-svg-icons';

import { alertActions } from "../../Store/Actions";

import "./Alert.scss";


class Alert extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
    this.clearAlert = this.clearAlert.bind(this);
  }
  
  clearAlert() {
    this.props.dispatch(alertActions.clear());
  }
  
  render() {
    const { alert } = this.props;
    return (
      <div id="alert-container" className={alert.type}>
        <div className="close">
          <FontAwesomeIcon icon={faWindowClose} onClick={this.clearAlert}/> 
        </div>
        { (alert.message && alert.message.message) && 
          <div className={"message " + alert.type}>{alert.message.message}</div>
        }
        { (alert.message && !alert.message.message) &&
        <div className={"message " + alert.type}>{alert.message}</div>
        }
      </div>

    );
  }
}

function mapStateToProps(state) {
  const { alert } = state;
  return {
    alert
  };
}

const connectedAlert = connect(mapStateToProps)(Alert);
export { connectedAlert as Alert };

