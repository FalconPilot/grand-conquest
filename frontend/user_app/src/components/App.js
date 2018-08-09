// React core
import React, { Component } from 'react'

// Common components
import Army, { armProps } from './common/Army/code'
import LoadingSpinner     from './common/LoadingSpinner/code'

class App extends Component {

  /*
  **  Constant card list to render
  */

  cards = {
    "Army": {
      component:  Army,
      properties: armProps
    }
  }

  /*
  **  Class constructor
  */

  constructor(props) {
    super(props)
    this.state = {
      loading:  true,
      viewport: null
    }
  }

  /*
  **  Main component render
  */

  render() {
    return this.state.loading === true
      ? <LoadingSpinner/>
      : (exists(this.state.viewport)
        ? this.state.viewport
        : this.defaultViewport())
  }

  /*
  **  Render default viewport if none is selected
  */

  defaultViewport() {
    return <div className="flex-col center-h">
      {Object.entries(this.cards).map(([k, v]) => {
        return <div key={`card-${k}`}>
        </div>
      })}
    </div>
  }

  /*
  **  Render card
  */

  renderCard = (name) => {
    return <div className="flex-col flex-middle">
      <h3>{name}</h3>
    </div>
  }

  // Switch viewport
}

export default App
