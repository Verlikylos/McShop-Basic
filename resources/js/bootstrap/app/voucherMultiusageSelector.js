import $ from 'jquery'

let $voucherUsagesAmountInput = $('#voucherUsagesAmount')
let $voucherManyUsagesPerPlayerInputWrapper = $('#voucherManyUsagesPerPlayerWrapper')

if ($voucherUsagesAmountInput) {
    $voucherUsagesAmountInput.on('keyup change', function () {
        updateBoxVisibility($voucherUsagesAmountInput.val())
    })
}

function updateBoxVisibility($voucherUsages) {
    if ($voucherUsages > 1) {
        if ($voucherManyUsagesPerPlayerInputWrapper.hasClass('d-none'))
            $voucherManyUsagesPerPlayerInputWrapper.removeClass('d-none')
    } else {
        if (!$voucherManyUsagesPerPlayerInputWrapper.hasClass('d-none'))
            $voucherManyUsagesPerPlayerInputWrapper.addClass('d-none')

    }
}
