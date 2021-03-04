const selectpickers = Array.from(document.getElementsByClassName('selectpicker'))

const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}

selectpickers.map((element) => {
    let dynamicInputs = []

    for (let i = 0; i < element.options.length; i++) {
        if (element.options[i].value == '') {
            continue;
        }

        let dynamicInputWrapper = document.getElementById(element.id + capitalize(element.options[i].value) + 'Wrapper')

        if (dynamicInputWrapper != null) {
            dynamicInputWrapper.dataset['selectpickerValue'] = element.options[i].value

            dynamicInputs.push(dynamicInputWrapper)
        }
    }

    element.addEventListener('change', () => updateDynamicInputs(dynamicInputs, element))
})

function updateDynamicInputs(dynamicInputs, element) {
    dynamicInputs.map((input) => {
        if (element.value == input.dataset['selectpickerValue']) {
            if (input.classList.contains('d-none')) {
                input.classList.remove('d-none')
            }
        } else {
            if (!input.classList.contains('d-none')) {
                input.classList.add('d-none')
            }
        }
    })
}
