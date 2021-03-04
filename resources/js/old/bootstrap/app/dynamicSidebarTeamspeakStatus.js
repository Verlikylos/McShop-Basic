import $ from 'jquery'

const $teamspeakStatusCard = $('#teamspeakStatusCard[data-target]')

if ($teamspeakStatusCard[0]) {
    updateServerStatus()
}

function updateServerStatus() {
    $.ajax({
        url: $teamspeakStatusCard.data('target'),
        type: 'get'
    }).done(function (data) {

        if (!data['online']) {
            setOffline()
            return
        }

        let progress = Math.round((data['players'] / data['max_players']) * 100)

        $teamspeakStatusCard.empty()
        $teamspeakStatusCard.append('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: ' + progress + '%" aria-valuenow="' + progress + '" aria-valuemin="0" aria-valuemax="100"></div></div>')
        $teamspeakStatusCard.append('<span class="badge badge-success">Online</span>')
        $teamspeakStatusCard.append('<span class="badge badge-info ml-1">' + data['players'] + '/' + data['max_players'] + '</span>')

    }).fail(function (data) {
        setOffline()
    })
}

function setOffline() {
    $teamspeakStatusCard.empty();
    $teamspeakStatusCard.append('<div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div></div>')
    $teamspeakStatusCard.append('<span class="badge badge-danger">Offline</span>')
}
