import React, { Fragment } from "react";
//import profile from "../../../data/profile";
import Moment from "react-moment";
import "moment-timezone";
import "moment/locale/de";
import "./JobExperience.scss";

Moment.globalLocale = "de";
class JobExperience extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  render() {
    return (
      <div id="JobExperiences" className="jobExperiences">
        {this.props.experiences.items &&
          this.props.experiences.items.map(function(experience, i) {
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
    );
  }
}

export { JobExperience };
