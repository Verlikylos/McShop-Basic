const apiDiv = document.getElementById('serverMethodApi')
const rconDiv = document.getElementById('serverMethodRcon')
const switchInput = document.getElementById('serverConnectionMethod')

document.addEventListener('DOMContentLoaded', (event) => {
    if (switchInput == null)
        return

    switchInput.addEventListener('change', watchInput)
})

const watchInput = () => {
    apiDiv.classList.toggle('d-none')
    rconDiv.classList.toggle('d-none')
}
