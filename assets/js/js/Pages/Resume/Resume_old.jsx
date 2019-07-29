import React from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";

import { userActions, experienceActions } from "../../Store/Actions";

class Resume extends React.Component {
  componentDidMount() {
    this.props.dispatch(userActions.getAll());
    this.props.dispatch(experienceActions.getJobExperienceList());
  }

  render() {
    const { user, users, experiences } = this.props;
    console.log(experiences);
    return (
      <div className="col-md-6 col-md-offset-3">
        <h1>Hi {users.username}!</h1>
        <p>You're logged in with React & JWT!!</p>
        <h3>Users from secure api end point:</h3>
        {users.loading && <em>Loading users...</em>}
        {console.log(users)}
        {users.error && (
          <span className="text-danger">ERROR: {users.error}</span>
        )}
        {console.log(users.items)}
        {users.items && (
          <ul>
            <li>{users.items.username + " " + users.items.email}</li>
          </ul>
        )}
        {/* {users.items && (
          <ul>
            {users.items.map((user, index) => (
              <li key={user.id}>{user.username + " " + user.email}</li>
            ))}
          </ul>
        )} */}
        <p>
          <Link to="/login">Logout</Link>
        </p>
      </div>
    );
  }
}

function mapStateToProps(state) {
  const { users, authentication, experiences } = state;
  const { user } = authentication;
  return {
    user,
    users,
    experiences
  };
}

const connectedResume = connect(mapStateToProps)(Resume);
export { connectedResume as Resume };
