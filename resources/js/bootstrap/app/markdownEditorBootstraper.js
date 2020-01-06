import Editor from 'tui-editor'
import 'tui-editor/dist/tui-editor.css'; // editor's ui
import 'tui-editor/dist/tui-editor-contents.css'; // editor's content
import 'codemirror/lib/codemirror.css'; // codemirror
import 'highlight.js/styles/github.css'; // code block highlight

const serverAnnouncementContentInput = document.getElementById('serverAnnouncementContent')
const serverAnnouncementEditorElement = document.getElementById('serverAnnouncementEditor')
const serverAnnouncementForm = document.getElementById('serverAnnouncementForm')
let serverAnnouncementEditor = null;

const options = {
    viewer: true,
    height: 500,
    initialEditType: 'markdown',
    previewType: 'tab'
}

registerEditors()
registerEvents()

function registerEditors() {
    if (serverAnnouncementEditorElement != null) {
        serverAnnouncementEditor = new Editor({
            el: serverAnnouncementEditorElement,
            ...options
        })
    }
}

function insertMarkdownToFormInput(input, editorInstance) {
    input.value = editorInstance.getMarkdown()
}

function registerEvents() {
    if (serverAnnouncementForm != null) {
        serverAnnouncementEditor.setMarkdown(serverAnnouncementContentInput.value)

        serverAnnouncementForm.addEventListener('submit', (event) => insertMarkdownToFormInput(serverAnnouncementContentInput, serverAnnouncementEditor))
    }
}
