const announcementEnabledSwitch = document.getElementById('serverAnnouncementEnabled')
let label = null;

document.addEventListener('DOMContentLoaded', (event) => {
    if (announcementEnabledSwitch == null)
        return

    let labels = Array.from(document.getElementsByTagName('label'))


    labels.map((lab, index) => {
        if (lab.getAttribute('for') == announcementEnabledSwitch.id) {
            label = lab
        }
    })

    if (label != null) {
        announcementEnabledSwitch.addEventListener('change', updateLabel)
    }
})

function updateLabel() {
    console.info(label.toString())
    label.innerHTML = announcementEnabledSwitch.checked ? 'Ogłoszenie aktywne&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' : 'Ogłoszenie nieaktywne'
}
