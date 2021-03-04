const inputs = document.getElementsByClassName('form-control')

window.registerMaterialInput = function (element) {
    if (element != null) {
        checkInputs(element)
        element.addEventListener('change', () => checkInputs(element))
    }
}

Array.prototype.map.call(inputs, element => {
    registerMaterialInput(element)
})

function checkInputs(element) {
    if (element.value != '') {
        if (!element.classList.contains('active')) {
            element.classList.add('active')
        }
    } else {
        if (element.classList.contains('active')) {
            element.classList.remove('active')
        }
    }
}
