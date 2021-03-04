import $ from 'jquery'

let select = $('select.entityActiveFilterSelect[data-target]')

select.each(function () {
    $(this).on('change', () => {
        window.location.assign(select.data('target') + '/' + select.val())
    })
})
