// React core
import React, { Component } from 'react'

// Common function
import { exists }     from '../helpers/common/utility'
import { renderFlag } from '../helpers/common/render'

/*
**  Single army component
*/

class Army extends Component {

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
    this.state = {
      army: props.army
    }
  }

  /*
  **  Main render
  */

  render() {
    return <div className="flex-col">
      <form className="flex-col">
        <p>Editing {this.state.army.name}</p>
        {renderFlag(this.state.army.flag_url)}
        <input
          type="text"
          name="name"
          value={this.state.army.name}
          onChange={this.updateArmy}
        />
      </form>
      <div className="flex-row">
        {this.state.army.squads.map(this.renderSquad)}
        {exists(this.state.newSquad)
          ? this.squadForm()
          : <button className="add-plus" value={this.state.army.id} onClick={this.initSquad}/>
        }
      </div>
    </div>
  }

  /*
  **  Render single squad
  */

  renderSquad = (squad, idx) => {
    return <form key={`squad-${idx + 1}`}>
      <h5>{squad.codename}</h5>
      <h5>Equipment</h5>
      {squad.equipment.map(e => this.renderEquipment(e, "squad"))}
    </form>
  }

  /*
  **  Render equipment
  */

  renderEquipment = (equipment, prefix) => {
    return <div key={`${prefix}-eqp-${equipment.id}`}>
    </div>
  }

  /*
  **  Render new squad form
  */

  squadForm = () => {
    return <form className="flex-col">
      <h5>New Squad</h5>
    </form>
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

export default Army
