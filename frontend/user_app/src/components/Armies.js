// React core
import React, { Component } from 'react'

// Local components
import Army from './Army'

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
    const squads = props.appData.armies.reduce((acc, army) => {
      return Object.assign(acc, army.squads.reduce((a, s) => Object.assign(a, {[s.id]: s}), {}))
    }, {})
    this.state = {
      selected: null,
      armyName: null,
      codename: null,
      newSquad: null,

      // Computed data
      squadForms: squads
    }
  }

  /*
  **  Component main render
  */

  render() {
    return <div className="flex-col center-h armies-card">
      <h3>Armies</h3>
      {!exists(this.state.selected) && <div className="flex-row center-v cards-carrousel">
        {this.props.appData.armies.length > 0
          ? this.props.appData.armies.map(this.renderArmy)
          : <p className="no-res">No army</p>
        }
      </div>}
      {exists(this.state.selected) && <Army army={this.state.selected}/>}
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
    const idx = event.currentTarget.dataset.index
    this.setState({
      selected: this.props.appData.armies[idx]
    })
  }

}

export default Armies
