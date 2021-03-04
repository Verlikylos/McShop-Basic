const SimpleMDE = require('simplemde/dist/simplemde.min')

const options = {
    autoDownloadFontawesome: false,
    autosave: {
        enabled: false,
    },
    forceSync: true,
    hideIcons: ['guide', 'fullscreen', 'preview', 'side-by-side'],
    spellChecker: false,
}

const simplemde = new SimpleMDE({...options, element: document.getElementById('serviceDescription')});
