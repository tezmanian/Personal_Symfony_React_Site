import React from "react";
//import profile from "../../../data/profile";
import Moment from "react-moment";
import "moment-timezone";
import "./Certifications.scss";

class Certifications extends React.Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <div id="Certifications">
        {this.props.certifications ? (
          <div>
            <div>
              <h3>Zertifikate</h3>
            </div>
            <div className="certification">
              {this.props.certifications.map(function(certification, i) {
                const institute = "institute_" + i;

                return (
                  <div id={institute} key={i} className="institute">
                    <div>
                      <h1>{certification.title}</h1>
                      {certification.url ? (
                        <a href={certification.url}>{certification.issuer}</a>
                      ) : (
                        certification.issuer
                      )}
                    </div>
                    <div>
                      <Moment format="MM.YYYY">
                        {certification.issueDate}
                      </Moment>
                      {certification.expiryDate ? (
                        <Moment format="- MM.YYYY">
                          {certification.expiryDate}
                        </Moment>
                      ) : (
                        ""
                      )}
                    </div>
                  </div>
                );
              })}
            </div>
          </div>
        ) : (
          ""
        )}
      </div>
    );
  }
}

export default Certifications;
