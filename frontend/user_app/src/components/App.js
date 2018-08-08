// React core
import React, { Component } from 'react'

// Common components
import LoadingSpinner from './common/LoadingSpinner/code'

class App extends Component {

  // Class constructor
  constructor(props) {
    super(props)
    this.state = {
      loading: true
    }
  }

  // Main render
  render() {
    return <div>
      {this.state.loading === true
        ? <LoadingSpinner/>
        : null
      }
    </div>
  }
}

export default App
