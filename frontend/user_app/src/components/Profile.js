// React core
import React, { Component } from 'react'

// Common functions
import { renderFlag } from '../helpers/common/render'

// CSS Imports
import '../stylesheets/components/Profile.css'

/*
**  User profile class
*/

class Profile extends Component {

  /*
  **  Main render
  */

  render() {
    return <div className="flex-col center-h">
      <h3>Profile</h3>
      {renderFlag(this.props.appData.user.flag_url)}
    </div>
  }

}

// Export class
export default Profile
