import $ from 'jquery'

let select = $('#smsNumbersTableActiveOperator')

if (select[0]) {
    select.on('change', () => {
        window.location.assign(select.data('target') + '/' + select.val())
    })
}
