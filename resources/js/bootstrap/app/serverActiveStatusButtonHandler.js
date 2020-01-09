document.addEventListener('DOMContentLoaded', (event) => {
  const switches = Array.from(document.getElementsByClassName('serverActiveStatusSwitch'))

  switches.map((el, index) => {
      if (el != null) {
          el.addEventListener('change', () => makeRequest(el))
      }
  })
})

function makeRequest(el) {
    console.log(el)
    console.log(el.dataset.target)
    window.location.assign(el.dataset.target)
}
