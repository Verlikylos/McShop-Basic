const fileInputs = Array.from(document.getElementsByClassName('form-file-with-preview'))

fileInputs.map((element) => {
    let input = element.getElementsByClassName('form-file-input')
    let previewElement = element.getElementsByClassName('file-preview-image')
    let labelElement = element.getElementsByClassName('form-file-text')

    if (input.length && previewElement.length && labelElement.length) {
        input = input[0]
        previewElement = previewElement[0]
        labelElement = labelElement[0]
    }

    input.addEventListener('change', () => updatePreview(input, previewElement, labelElement), false)
})

function updatePreview(inputElement, previewElement, labelElement) {
    if (inputElement.files.length > 0) {
        const reader = new FileReader()

        reader.onload = (event) => {
            previewElement.src = event.target.result
        }

        reader.readAsDataURL(inputElement.files[0])

        labelElement.innerText = inputElement.files[0].name
    }
}
