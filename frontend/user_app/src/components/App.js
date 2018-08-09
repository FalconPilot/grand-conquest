// React core
import React, { Component } from 'react'

// Local components
import Armies  from './Armies'
import Profile from './Profile'

// Common components
import LoadingSpinner from './common/LoadingSpinner/code'

// Common functions
import { exists } from '../helpers/common/utility'

/*
**  Main App component
*/

class App extends Component {

  /*
  **  Constant card list to render
  */

  cards = [ Profile, Armies ]

  /*
  **  Class constructor
  */

  constructor(props) {
    super(props)
    this.state = {
      loading:  true,
      error:    null,
      viewport: null,
      appData:  null
    }
  }

  /*
  **  Component mounting hook
  */

  componentWillMount() {
    document.getElementById('app-ephemeral').outerHTML = ''

    // If data exist, finish loading
    if (exists(window.appData)) {
      this.setState({
        appData: window.appData,
        loading: false
      })

    // If data doesn't exist, throw error
    } else {
      this.setState({
        error: "Impossible to fetch personal data :(",
        loading: false
      })
    }
  }

  /*
  **  Main component render
  */

  render() {
    return exists(this.state.error)
      ? <div className="app-error">{this.state.error}</div>
      : (this.state.loading === true
        ? <LoadingSpinner/>
        : (exists(this.state.viewport)
          ? this.state.viewport
          : this.defaultViewport()
        )
      )
  }

  /*
  **  Render default viewport if none is selected
  */

  defaultViewport() {
    return <div className="flex-col center-h">
      {this.cards.map((CardComponent, idx) =>
        <div className="flex-col center-h card-wrapper" key={`card-${idx}`}>
          <CardComponent {...this.state}/>
        </div>
      )}
    </div>
  }

  /*
  **  Switch current viewport
  */

  switchViewport = (event) => {

  }
}

export default App
