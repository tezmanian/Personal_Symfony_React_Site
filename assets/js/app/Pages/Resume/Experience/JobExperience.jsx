import React, { Fragment } from "react";
//import profile from "../../../data/profile";
import Moment from "react-moment";
import "moment-timezone";
import "moment/locale/de";
import "./JobExperience.scss";
import classNames from 'classnames';

import { connect } from "react-redux";
import { experienceActions } from "../../../Store/Actions";

Moment.globalLocale = "de";
class JobExperience extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  
  componentDidMount() {
    this.props.dispatch(experienceActions.getJobExperienceList());
  }
  
  render() {
      const { experiences } = this.props;
      
    return (
      <div id="JobExperiences" className="jobExperiences">
        <div
            className={classNames('fade-in', {
              'visible': !(experiences.items.length < 1)
              })}
          >
        {experiences.items &&
          experiences.items.map(function(experience, i) {
            return (
              <section key={i} className="company">
                <header className="companyName">
                  {experience.url ? (
                    <h3>
                      <a href={experience.url}>{experience.company}</a>
                    </h3>
                  ) : (
                    <h3>{experience.company}</h3>
                  )}
                </header>
                <article className="jobRoles">
                  {experience.roles.map(function(role, i) {
                    const startDate = new Date(role.startDate);
                    const endDate = role.endDate
                      ? new Date(role.endDate)
                      : new Date();
                    const currentJob = role.endDate ? false : true;

                    return (
                      <section key={i} className="jobRole">
                        <header className="title">
                          <h4>{role.title}</h4>
                          <span className="jobPeriod">
                            <Moment format="MM.YYYY">{startDate}</Moment> -{" "}
                            {currentJob ? (
                              "zur Zeit"
                            ) : (
                              <Moment format="MM.YYYY">{endDate}</Moment>
                            )}
                            <span className="jobDuration">
                              (
                              <Moment to={endDate} ago locale="de">
                                {startDate}
                              </Moment>
                              )
                            </span>
                          </span>
                        </header>
                        <article>
                          <p className="jobDescription">
			   {role.description.split("\n").map((item, key) => {
                              return (
                                <Fragment key={key}>
                                  {item}
                                  <br />
                                </Fragment>
                              );
                            })}
                          </p>
                          <div className="jobLocation">{role.location}</div>
                        </article>
                      </section>
                    );
                  })}
                </article>
              </section>
            );
          })}
      </div>
              </div>
    );
  }
}

function mapStateToProps(state) {
  const { experiences } = state;
  return {
    experiences
  };
}

const connectedJobExperience = connect(mapStateToProps)(JobExperience);
export { connectedJobExperience as JobExperience };
