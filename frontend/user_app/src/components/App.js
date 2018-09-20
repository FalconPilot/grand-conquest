// React core
import React, { Component } from 'react'

// Local components
import Armies   from './Armies'
import Nation   from './Nation'
import Profile  from './Profile'

// Local data
import { envType }   from '../../package.json'
import { debugData } from '../data/local_dataset'

// Common components
import LoadingSpinner from './common/LoadingSpinner/code'

// Common functions
import { exists, setError } from '../helpers/common/utility'

// CSS Imports
import '../stylesheets/components/App.css'

// External requires
const PCO = require('promise-composer')

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
      appData:  null,
      availableManpower: 0
    }
  }

  /*
  **  Component mounting hook
  */

  componentWillMount() {

    // Start async verification of loading script
    Promise.resolve(document.getElementById('app-ephemeral'))

      // If script is found, try to obtain appData
      .then(PCO.isset)
      .then(eph => {
        eph.outerHTML = ''
        return {
          "local": debugData,
          "production": window.appData
        }[envType]
      })

      // If appData exists, finish loading
      .then(PCO.isset)
      .then(appData => {
        const amp = appData.nation.manpower - appData.armies.reduce((total, army) => {
          return total + army.squads.reduce((t, s) => t + s.manpower, 0)
        }, 0)
        this.setState({
          appData: appData,
          loading: false,
          availableManpower: amp
        })
      })

      // Handle errors
      .catch(_x => setError(this, "Impossible to fetch personal data :("))
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
