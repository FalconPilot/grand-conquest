// React core
import React, { Component } from 'react'

// Common functions
import { renderAvatar } from '../helpers/common/render'

// CSS Imports
import '../stylesheets/components/Profile.css'

// External requires
const PCO = require('promise-composer')

/*
**  User profile class
*/

class Profile extends Component {

  /*
  **  Class constructor
  */

  constructor(props) {
    super(props)
    this.state = {
      inputs: {
        avatar_url: this.props.appData.user.avatar_url || ""
      }
    }
  }

  /*
  **  Main render
  */

  render() {
    return <form
      className="flex-col center-h"
      style={{width: this.props.width}}
      onSubmit={this.submitProfile}
    >
      <h3>{this.props.appData.user.username}</h3>
      {renderAvatar(this.props.appData.user.avatar_url)}
      <input
        type="text"
        onChange={this.updateInput}
        name="avatar_url"
        placeholder="Avatar URL"
        value={this.state.inputs.avatar_url}
      />
    </form>
  }

  /*
  **  Update input
  */

  updateInput = (event) => {
    const key = event.currentTarget.name
    const value = event.currentTarget.value
    Promise.resolve([key, value])
      .then(x => PCO.traverse(x, PCO.exists))
      .then(x => this.setState({ inputs: Object.assign(this.state.inputs, {[key]: value}) }))
      .catch(x => warn("Trying to update input without a key OR a value"))
  }

  /*
  **  Submit profile infos
  */

  submitProfile = (event) => {
    event.preventDefault()
  }

}

// Export class
export default Profile
