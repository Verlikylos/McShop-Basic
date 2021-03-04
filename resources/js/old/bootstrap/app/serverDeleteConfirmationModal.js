import $ from 'jquery'

const entityDeleteConfirmationModalElement = $('#entityDeleteConfirmationModal')
const elementsToInsertEntityName = $('.entity-modal-delete-entity-name-variable')
const modalEntityDeleteBtnElement = $('#modalEntityDeleteBtnElement')

document.addEventListener('DOMContentLoaded', (event) => {
    const deleteButtonElements = document.getElementsByClassName('entity-delete-btn')

    if (entityDeleteConfirmationModalElement) {
        for (let i = 0; i < deleteButtonElements.length; i++) {
            deleteButtonElements[i].addEventListener('click', () => openModal(deleteButtonElements[i].dataset.target, deleteButtonElements[i].dataset.entityName))
        }
    }
});

function openModal(targetUrl, serverName) {
    for (let i = 0; i < elementsToInsertEntityName.length; i++) {
        elementsToInsertEntityName[i].innerText = serverName;
    }

    modalEntityDeleteBtnElement.attr('href', targetUrl)

    entityDeleteConfirmationModalElement.modal('show')
}
