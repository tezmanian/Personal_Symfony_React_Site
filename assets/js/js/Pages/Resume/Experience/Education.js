import React from "react";
import Moment from "react-moment";
import "moment-timezone";
import "moment/locale/de";
import "./Education.scss";

class Education extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  render() {
    console.log(this.props.studies.items);
    return (
      <div id="Education" className="Education">
        {/*         <div>
          <h3>Ausbildung</h3>
        </div> */}
        <div className="studies">
          {this.props.studies.items.map(function(study, i) {
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
    );
  }
}

export { Education };
