import React from "react";
import Moment from "react-moment";
import "moment-timezone";
import "moment/locale/de";
import "./Education.scss";

import {connect} from "react-redux";
import {educationsActions} from "../../../Store/Actions";

class Education extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    this.props.dispatch(educationsActions.getEducationList());
  }

    render() {
      const { education } = this.props;
    return (
      <div id="Education" className="Education">
            <div
              className={classNames('fade-out', {
                'hidden': !(education.items.length < 1)
                })}
            >
              <em>Loading information...</em>
            </div>
            <div
              className={classNames('fade-in', {
                'visible': !(education.items.length < 1)
                })}
            >
        <div className="studies">
          {education.items.map(function(study, i) {
            const institute = "institute_" + i;
            const startDate = new Date(study.startDate);
            const endDate = study.endDate
              ? new Date(study.endDate)
              : new Date();
            const current = study.endDate ? false : true;

            return (
              <section id={institute} key={i} className="institution">
                <header className="institute">
                  <h3>
                    {study.url ? (
                      <a href={study.url}>{study.institute}</a>
                    ) : (
                      "{study.institute}"
                    )}
                  </h3>
                </header>
                <article className="education">
                  <header className="title">
                    <h4>{study.title}</h4>
                    <span className="studyPeriod">
                      {current ? (
                        "zur Zeit"
                      ) : (
                        <Moment format="MM.YYYY">{endDate}</Moment>
                      )}

                      <span className="studyDuration">
                        (
                        <Moment to={endDate} ago locale="de">
                          {startDate}
                        </Moment>
                        )
                      </span>
                    </span>
                  </header>
                  <p>{study.description}</p>
                </article>
              </section>
            );
          })}
        </div>
        </div>
      </div>
    );
  }
}

function mapStateToProps(state) {
  const { education } = state;
  return {
    education
  };
}

const connectedEducation = connect(mapStateToProps)(Education);
export { connectedEducation as Education };
