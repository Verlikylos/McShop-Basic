import $ from 'jquery'

$('input[type="checkbox"][data-collapse-target]').each(function () {
    $(this).on('change', function () {
        let el = $(this);
        let target = $('#' + el.data('collapse-target'))

        if (target)
            target.toggleClass('d-none')
    })
})
