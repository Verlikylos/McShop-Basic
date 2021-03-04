import $ from 'jquery'

const bruttoInput = $('#numberBrutto')
const nettoInput = $('#numberNetto')

if (bruttoInput[0] && nettoInput[0]) {
    calculateBrutto()
    nettoInput.on('keyup', calculateBrutto)
}

function calculateBrutto() {
    if (nettoInput.val() == null || nettoInput.val() == "")
        bruttoInput.val('0 zł')

    let brutto = (nettoInput.val() * 1.23).toFixed(2)

    bruttoInput.val(brutto + ' zł')
}
