const redirectSwitches = Array.from(document.getElementsByClassName(' switch-input-redirect'))

redirectSwitches.map(element => {
    element.addEventListener('change', () => window.location = element.dataset['switchTarget'])
})
