const apiDiv = document.getElementById('serverMethodApi')
const rconDiv = document.getElementById('serverMethodRcon')
const switchInput = document.getElementById('serverConnectionMethod')

document.addEventListener('DOMContentLoaded', (event) => {
    if (switchInput == null)
        return

    watchInput()
    switchInput.addEventListener('change', watchInput)
})

const watchInput = () => {
    if (switchInput.value == 'api') {
        if (apiDiv.classList.contains('d-none'))
            apiDiv.classList.remove('d-none')
        if (!rconDiv.classList.contains('d-none'))
            rconDiv.classList.add('d-none')
    } else {
        if (!apiDiv.classList.contains('d-none'))
            apiDiv.classList.add('d-none')
        if (rconDiv.classList.contains('d-none'))
            rconDiv.classList.remove('d-none')
    }
}
