import React, {Component} from "react";
import Helmet from "react-helmet";
import {MarkDown} from "../../Helpers";
import classNames from 'classnames';

import {connect} from "react-redux";
import {aboutActions} from "../../Store/Actions";

import "./Imprint.scss";

class Imprint extends Component
{
  constructor(props)
  {
    super(props);
    this.state = {};
  }

  componentDidMount()
  {
//    this.props.dispatch(aboutActions.getAboutList());
  }

  render()
  {

    return (
            <main id="Imprint">
              <Helmet title="Impressum" />
            
              <div>
            
                <article id="about">
                  <h1>Impressum</h1>
                  <MarkDown content="Impressum" />
            
                </article>
              </div>
            </main>


            );
  }
}

function mapStateToProps(state)
{
  const {about} = state;
  return {
    about
  };
}

const connectedImprint = connect(mapStateToProps)(Imprint);
export { connectedImprint as Imprint };
