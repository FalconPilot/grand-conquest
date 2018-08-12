// React core
import React from 'react'

// Common functions
import { fullString } from './utility'

/*
**  Rendering functions
*/

// Render flag
export function renderFlag(url, alt = "flag") {
  const src = fullString(url) ? url : "/static/img/gui/noflag.png"
  return <div className="flag-wrapper">
    <img src={src} alt={alt}/>
  </div>
}

// render player avatar
export function renderAvatar(url, alt = "avatar") {
  const src = fullString(url) ? url : "/static/img/gui/noavatar.png"
  return <div className="avatar-wrapper">
    <img src={src} alt={alt}/>
  </div>
}
