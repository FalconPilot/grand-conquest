// React core
import React, { Component } from 'react'

// CSS Imports
import './style.css'

/*
**  Loading Spinner rendering
*/

class LoadingSpinner extends Component {

  // Main render
  render() {
    return <div className="spinner-wrapper">
      <div className="loading-spinner"/>
    </div>
  }
}

export default LoadingSpinner
