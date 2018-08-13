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
    </div>
  }

}

export default Nation
