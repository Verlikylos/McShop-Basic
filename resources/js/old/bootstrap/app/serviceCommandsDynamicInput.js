import $ from 'jquery'

let $addCommandInputBtn = $('#addCommandInput')
let $commandInputsWrapper = $('#serviceCommandsWrapper')
let $commandInputs = $('#commandInputs')
let $serviceCommandsInput = $('#serviceCommands')
let $createServiceForm = $('#createServiceForm')
let nextInputNumber = 2;

if ($addCommandInputBtn && $commandInputsWrapper) {
    $addCommandInputBtn.on('click', addCommandInput)
    jsonToIputs()
}

if ($createServiceForm) {
    $createServiceForm.on('submit', inputsToJson)
}

function addCommandInput() {
    $commandInputs.append('<div class="form-group"><input type="text" class="form-control serviceCommandInput" placeholder="Komenda #' + nextInputNumber++ + '"></div>')
}

function inputsToJson() {
    let data = []

    $commandInputs.find('.serviceCommandInput').each((index, el) => {
        if (el.value != '')
            data.push(el.value)
    })


    $serviceCommandsInput.val(JSON.stringify(data));
}

function jsonToIputs() {
    let json = $serviceCommandsInput.val();

    if (json == null || json == '')
        return

    let data = null

    try {
        data = JSON.parse(json)
    } catch (e) {
        return
    }

    if (data == null)
        return

    if (!data[0])
        return

    $commandInputs.empty()
    $commandInputs.append('<div class="form-group"><input type="text" class="form-control serviceCommandInput" value="' + data[0] + '" placeholder="Komenda #1"></div>')

    for (let i = 1; i < data.length; i++) {
        $commandInputs.append('<div class="form-group"><input type="text" class="form-control serviceCommandInput" value="' + data[i] + '" placeholder="Komenda #' + nextInputNumber++ + '"></div>')
    }
}
