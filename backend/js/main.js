/*
**  Main javascript file
*/

var url = new URL(window.location.href);
var flash = url.searchParams.get("search");
if (flash) {
  window.history.replaceState(null, null, url.pathname);
}
