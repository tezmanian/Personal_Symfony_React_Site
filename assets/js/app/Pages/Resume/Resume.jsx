import React from "react";
import { connect } from "react-redux";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.scss";
import { JobExperience, Education } from "./Experience";
import Helmet from "react-helmet";

import "./Resume.scss";

import { experienceActions, educationsActions } from "../../Store/Actions";

class Resume extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    this.props.dispatch(experienceActions.getJobExperienceList());
    this.props.dispatch(educationsActions.getEducationList());
  }

  render() {
    const { experiences, education } = this.props;

    return (
      <main>
        <Helmet title="Lebenslauf" />

        <article>
          <div id="Resume">
            <div
              className={`fade-out ${ !(experiences.items.length < 1 &&
                education.items.length < 1) &&
                "hidden"}`}
            >
              <em>Loading information...</em>
            </div>
            <div
              className={`fade-in ${!(experiences.items.length < 1 &&
                education.items.length < 1) &&
                "visible"}`}
            >
              <Tabs>
                <TabList>
                  <Tab disabled={experiences.loading ? true : false}>
                    Berufserfahrung
                  </Tab>
                  <Tab disabled={education.loading ? true : false}>
                    Ausbildung
                  </Tab>
                </TabList>
                <TabPanel>
                  <JobExperience experiences={experiences} />
                </TabPanel>
                <TabPanel>
                  <div>
                    <Education studies={education} />
                    {/*   <Certifications
                  certifications={this.props.profile.resume.certifications}
                /> */}
                  </div>
                </TabPanel>
              </Tabs>
            </div>
          </div>
        </article>
      </main>
    );
  }
}

function mapStateToProps(state) {
  const { experiences, education } = state;
  return {
    experiences,
    education
  };
}

const connectedResume = connect(mapStateToProps)(Resume);
export { connectedResume as Resume };
