/*
**  Utility functions
*/

// Check if element is defined
export function exists(x) {
  return x !== null
    && x !== undefined
}

// Check if element is string
export function fullString(x) {
  return exists(x)
    && typeof x === "string"
    && x.trim() !== ""
}

// Set error for state
export function setError(component, msg) {
  component.setState({
    error: msg,
    loading: false
  })
}
