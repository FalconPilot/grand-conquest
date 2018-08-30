// React core
import React, { Component } from 'react'

// Common functions
import { renderFlag } from '../helpers/common/render'

/*
**  Nation card
*/

class Nation extends Component {

  /*
  **  Main render
  */

  render() {
    return <div className="flex-col center-h" style={{width: this.props.width}}>
      <h3>{this.props.appData.nation.name}</h3>
      {renderFlag(this.props.appData.nation.flag_url)}
      <div className="flex-row flex-out">
        <label>Total manpower</label>
        <p>{this.props.appData.nation.manpower}</p>
      </div>
      <div className="flex-row flex-out">
        <label>Available manpower</label>
        <p>{this.props.availableManpower}</p>
      </div>
    </div>
  }

}

export default Nation
