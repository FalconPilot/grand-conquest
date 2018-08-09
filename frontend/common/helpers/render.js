// React core
import React from 'react'

// Common functions
import { fullString } from './utility'

/*
**  Rendering functions
*/

export function renderFlag(url, alt = "flag") {
  const src = fullString(url) ? url : ""
  return <div className="flag-wrapper">
    <img src={src} alt={alt}/>
  </div>
}
