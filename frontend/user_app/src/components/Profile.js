// React core
import React, { Component } from 'react'

// Common function
import { renderFlag } from '../helpers/common/render'

/*
**  User profile class
*/

class Profile extends Component {

  /*
  **  Main render
  */

  render() {
    return <div className="flex-col center-h">
      <h3>{this.props.appData.user.email}</h3>
      {renderFlag(this.props.appData.user.flag_url)}
    </div>
  }

}

// Export class
export default Profile
