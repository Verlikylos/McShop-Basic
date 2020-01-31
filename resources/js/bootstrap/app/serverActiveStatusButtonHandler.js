import $ from 'jquery'

const switches = $('input.entityActiveStatusSwitch[type="checkbox"][data-target]')

switches.each(function () {
    $(this).on('change', function () {
        makeRequest($(this))
    })
})

function makeRequest(el) {
    window.location.assign(el.data('target'))
}
