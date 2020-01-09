import $ from 'jquery'

const serverDeleteConfirmationModalElement = $('#serverDeleteConfirmationModal')
const elementsToInsertServerName = $('.server-modal-delete-server-name-variable')
const modalServerDeleteBtnElement = $('#modalServerDeleteBtnElement')

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteButtonElements = document.getElementsByClassName('server-delete-btn')

    if (serverDeleteConfirmationModalElement) {
        for (let i = 0; i < deleteButtonElements.length; i++) {
            deleteButtonElements[i].addEventListener('click', () => openModal(deleteButtonElements[i].dataset.href, deleteButtonElements[i].dataset.serverName))
        }
    }
});

function openModal(targetUrl, serverName) {
    for (let i = 0; i < elementsToInsertServerName.length; i++) {
        elementsToInsertServerName[i].innerText = serverName;
    }

    modalServerDeleteBtnElement.attr('href', targetUrl)

    serverDeleteConfirmationModalElement.modal('show')
}
