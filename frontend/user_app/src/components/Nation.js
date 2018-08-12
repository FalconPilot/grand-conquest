// React core
import React, { Component } from 'react'

/*
**  Nation card
*/

class Nation extends Component {

  /*
  **  Main render
  */

  render() {
    return <div className="flex-col center-h" style={{width: this.props.width}}>
      <h3>Nation</h3>
    </div>
  }

}

export default Nation
