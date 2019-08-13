import React from "react";
import { connect } from "react-redux";
import { Tab, Tabs, TabList, TabPanel } from "react-tabs";
import "react-tabs/style/react-tabs.scss";
import { JobExperience, Education } from "./Experience";
import Helmet from "react-helmet";

import "./Resume.scss";

class Resume extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
    console.log(props)
  }

  render() {
    const { experiences, education } = this.props;

    return (
      <main>
        <Helmet title="Lebenslauf" />

        <article>
          <div id="Resume">           
              <Tabs>
                <TabList>
                  <Tab >
                    Berufserfahrung
                  </Tab>
                  <Tab > 
                    Ausbildung
                  </Tab>
                </TabList>
                <TabPanel>
                  <JobExperience />
                </TabPanel>
                <TabPanel>
                  <div>
                    <Education />
                    {/*   <Certifications
                  certifications={this.props.profile.resume.certifications}
                /> */}
                  </div>
                </TabPanel>
              </Tabs>
          </div>
        </article>
      </main>
    );
  }
}

function mapStateToProps(state, ownProps) {
  console.log(ownProps)
  const { experiences, education } = state;
  return {
    experiences,
    education,
    ownProps
  };
}

const connectedResume = connect(mapStateToProps)(Resume);
export { connectedResume as Resume };
