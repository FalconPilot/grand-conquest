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
      selected: null,
      armyName: null,
      squad: null,
      codename: null
    }
  }

  /*
  **  Component main render
  */

  render() {
    const armies = this.props.appData.armies.map(this.renderArmy)
    return <div className="flex-col center-h armies-card">
      <h3>Armies</h3>
      {!exists(this.state.selected) && <div className="flex-row center-v cards-carrousel">
        {armies.length > 0 ? armies : <p className="no-res">No army</p>}
      </div>}
      {exists(this.state.selected) && this.armyDetails(this.props.appData.armies[this.state.selected])}
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
  **  Render single squad
  */

  renderSquad = (squad, idx) => {
    return <div/>
  }

  /*
  **  Render army details
  */

  armyDetails = (army) => {
    return <form className="flex-col">
      <p>Editing {army.name}</p>
      {renderFlag(army.flag_url)}
      <input
        type="text"
        value={this.state.armyName}
      />
    </form>
  }

  /*
  **  Switch selected army
  */

  selectArmy = (event) => {
    const idx = event.currentTarget.dataset.index
    this.setState({
      selected: idx,
      armyName: this.props.appData.armies[idx].name
    })
  }

  /*
  **  Switch selected squad
  */

  selectSquad = (event) => {
    const idx = event.currentTarget.datset.index
    this.setState({
      selected: idx,
      codename: this.props.appData.armies[this.state.selected].squads[idx]
    })
  }

}

export default Armies
