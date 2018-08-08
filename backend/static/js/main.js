/*
**  Main javascript file
*/

const url = new URL(window.location.href)
const flash = url.searchParams.get("flash")
const type = url.searchParams.get("type")

if (flash && type) {

  fetch("/js/data/flash.json")
    .then(response => response.json())
    .then(json => {

      // Create text element
      var txt = document.createElement('p')
      txt.innerHTML = json[flash]

      // Close button
      var button = document.createElement('button')
      button.className = "close-cross"

      button.addEventListener('click', function() {
        this.parentNode.style.display = null
      })

      // Update wrapper
      var wrapper = document.getElementById('flash-wrapper')
      wrapper.classList.add(type)
      wrapper.appendChild(txt)
      wrapper.appendChild(button)
      wrapper.style.display = 'flex'

      // Replace URL and History
      window.history.replaceState(null, null, url.pathname)
    })


}
