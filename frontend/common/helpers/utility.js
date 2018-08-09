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
