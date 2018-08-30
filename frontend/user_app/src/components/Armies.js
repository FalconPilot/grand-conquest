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

  // Blank squad object
  blankSquad = {
    codename: "",
    template: null,
    manpower: 0
  }

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
    console.log(squads)
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
    return <form key={`squad-${idx + 1}`}>
      <h5>{squad.codename}</h5>
      <input
        type="text"
        name="codename"
        value={this.state.squadForms[squad.id].codename}
      />
    </form>
  }

  /*
  **  Render army details
  */

  armyDetails = (army) => {
    return <div className="flex-col">
      <form className="flex-col">
        <p>Editing {army.name}</p>
        {renderFlag(army.flag_url)}
        <input
          type="text"
          value={this.state.armyName}
        />
      </form>
      <div className="flex-row">
        {army.squads.map(this.renderSquad)}
        {exists(this.state.newSquad)
          ? <form className="flex-col">
              <h5>New Squad</h5>
            </form>
          : <button className="add-plus" value={army.id} onClick={this.initSquad}/>
        }
      </div>
    </div>
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

  /*
  **  Initialize new squad
  */

  initSquad = (event) => {
    this.setState({
      newSquad: Object.assign(this.blankSquad, { id_army: event.currentTarget.value })
    })
  }

}

export default Armies
