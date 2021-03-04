import $ from 'jquery'

const $playerNameInput = $('#playerName')
const $smsCodeInput = $('#smsCode')

const $targetPlayerNameInputs = $('.player-name-input')
const $targetSmsCodeInputs = $('.sms-code-input')

if ($playerNameInput[0]) {
    $playerNameInput.on('keyup change', function () {
        $targetPlayerNameInputs.each(function () {
            $(this).val($playerNameInput.val())
        })
    })
}

if ($smsCodeInput[0]) {
    $smsCodeInput.on('keyup change', function () {
        $targetSmsCodeInputs.each(function () {
            $(this).val($smsCodeInput.val())
        })
    })
}
