import $ from 'jquery'

import Editor from 'tui-editor'
import 'tui-editor/dist/tui-editor.css'; // editor's ui
import 'tui-editor/dist/tui-editor-contents.css'; // editor's content
import 'codemirror/lib/codemirror.css'; // codemirror
import 'highlight.js/styles/github.css'; // code block highlight

const $serverAnnouncementInput = $('#serverAnnouncementContent')
const $serverAnnouncementEditorElement = $('#serverAnnouncementEditor')
const $serverAnnouncementForm = $('#serverAnnouncementForm')
let serverAnnouncementEditor = null

const $serviceDescriptionInput = $('#serviceDescription')
const $serviceDescriptionEditorElement = $('#serviceDescriptionEditor')
const $serviceForm = $('#createServiceForm')
let serviceDescriptionEditor = null

const options = {
    viewer: true,
    height: 500,
    initialEditType: 'markdown',
    previewType: 'tab',
    toolbarItems: [
        'heading',
        'bold',
        'italic',
        'strike',
        'divider',
        'hr',
        'quote',
        'divider',
        'ul',
        'ol',
        'indent',
        'outdent',
        'divider',
        'link',
        'divider',
        'code',
        'codeblock',
        'divider',
    ]
}

registerEditors()
registerEvents()

function registerEditors() {

    if ($serverAnnouncementEditorElement[0]) {
        serverAnnouncementEditor = new Editor({
            el: $serverAnnouncementEditorElement[0],
            ...options
        })

        serverAnnouncementEditor.setMarkdown($serverAnnouncementInput.val())
    }

    if ($serviceDescriptionEditorElement[0]) {
        serviceDescriptionEditor = new Editor({
            el: $serviceDescriptionEditorElement[0],
            ...options
        })

        serviceDescriptionEditor.setMarkdown()
    }
}

function registerEvents() {
    if ($serverAnnouncementForm[0]) {
        $serverAnnouncementForm.on('submit', function () {
            $serverAnnouncementInput.val(serverAnnouncementEditor.getMarkdown())
        })
    }

    if ($serviceForm[0]) {
        $serviceForm.on('submit', function () {
            $serviceDescriptionInput.val(serviceDescriptionEditor.getMarkdown())
        })
    }
}

// TODO change all if ($var) to if ($var[0])
