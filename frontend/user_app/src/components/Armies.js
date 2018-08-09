// React core
import React, { Component } from 'react'

// Common function
import { renderFlag } from '../helpers/common/render'

/*
**  Armies management viewport
*/

class Armies extends Component {

  /*
  **  Component main render
  */

  render() {
    return <div className="flex-col center-h">
      {this.props.appData.armies.map(this.renderArmy)}
    </div>
  }

  /*
  **  Render single army
  */

  renderArmy = (army, idx) => {
    return <div className="flex-col center-h" key={`army-${idx}`}>
      <h3>army.name</h3>
      {renderFlag(army.flag_url)}
    </div>
  }
}

export default Armies
