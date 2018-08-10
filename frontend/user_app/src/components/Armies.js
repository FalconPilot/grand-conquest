// React core
import React, { Component } from 'react'

// Common function
import { exists }     from '../helpers/common/utility'
import { renderFlag } from '../helpers/common/render'

// CSS imports
import '../stylesheets/components/Armies.css'

/*
**  Armies management viewport
*/

class Armies extends Component {

  /*
  **  Class constructor
  */

  constructor(props) {
    super(props)
    this.state = {
      index: null
    }
  }

  /*
  **  Component main render
  */

  render() {
    const armies = this.props.appData.armies.map(this.renderArmy)
    const width = exists(this.state.index) ? "30%" : 0
    return <div className="flex-col center-h armies-card">
      <h3>Armies</h3>
      <div className="flex-row">
        <div className="flex-row center-v cards-carrousel">
          {armies.length > 0 ? armies : <p className="no-res">No army</p>}
        </div>
        <div style={{width: width}} className="flex-col">
        </div>
      </div>
    </div>
  }

  /*
  **  Render single army
  */

  renderArmy = (army, idx) => {
    const txt = this.state.index === idx ? "Close" : "Open"
    return <div className="flex-col center-h" key={`army-${idx}`}>
      <h4>{army.name}</h4>
      {renderFlag(army.flag_url)}
      <button
        type="button"
        onClick={this.selectArmy}
        data-index={idx}
      >{txt}</button>
    </div>
  }

  /*
  **  Switch selected army
  */

  selectArmy = (event) => {
    const idx = event.currentTarget.dataset.idx
    this.setState({ index: idx === this.state.index ? null : idx })
  }
}

export default Armies
