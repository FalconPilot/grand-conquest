// React core
import React, { Component } from 'react'

// Local components
import Armies   from './Armies'
import Nation   from './Nation'
import Profile  from './Profile'

// Common components
import LoadingSpinner from './common/LoadingSpinner/code'

// Common functions
import { exists } from '../helpers/common/utility'

// CSS Imports
import '../stylesheets/components/App.css'

/*
**  Main App component
*/

class App extends Component {

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
    return <div className="flex-row center-h cards-list">
      <Profile width="50%" {...this.state}/>
      <Nation width="50%" {...this.state}/>
      <hr/>
      <Armies width="100%" {...this.state}/>
    </div>
  }

  /*
  **  Switch current viewport
  */

  switchViewport = (event) => {

  }
}

export default App
