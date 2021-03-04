const serviceCommandsWrapper = document.getElementById('serviceCommandsWrapper')
const serviceCommands = Array.from(document.getElementsByClassName(' serviceCommandInput'))
const addCommandButton = document.getElementById('addCommandButton')
let lp = null;

if (serviceCommandsWrapper != null) {
    if (lp == null) {
        serviceCommands.map((element) => {

            if (element.dataset['lp'] > lp) {
                lp = element.dataset['lp']
            }
        })
    }

    addCommandButton.addEventListener('click', () => {
        lp++

        let formGroup = document.createElement('div')
        formGroup.classList.add('form-group', 'mb-3')

        let input = document.createElement('input')
        input.type = 'text'
        input.id = `serviceCommand${lp}`
        input.name = `serviceCommands[command${lp}]`
        input.dataset['lp'] = lp
        input.classList.add('form-control', 'serviceCommandInput')

        let label = document.createElement('label')
        label.htmlFor = `serviceCommand${lp}`
        label.classList.add('form-label')
        label.innerText = `Komenda #${lp}`

        formGroup.appendChild(input)
        formGroup.appendChild(label)

        serviceCommandsWrapper.appendChild(formGroup)

        registerMaterialInput(input)



        // serviceCommandsWrapper.appendChild(
        //     <div class="form-group mb-3">
        //         <input type="text" class="form-control serviceCommandInput @error('serviceCommands') is-invalid @enderror" id="serviceCommand${lp}" name="serviceCommands[command${lp}]" data-lp="${lp}">
        //         <label for="serviceCommand${lp}" class="form-label">Komenda #${lp}</label>
        //     </div>
        // )
    })
}
