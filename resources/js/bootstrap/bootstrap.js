const bootstrap = require('bootstrap')

import './sidenav'
import './switch-input-redirect'
import './file-input-preview'
import './selectpicker-dynamic-inputs'
import './markdown-editors'
import './material-input'
import './service-dynamic-commands'

document.addEventListener('DOMContentLoaded', evt => {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, {delay: 3000}).show()
    })
});
