<div class="card server-status-card shadow mt-3 mt-md-0">
    <div id="#serverStatusCard" class="card-body">
        <h5>Serwer {{ $server->getName() }}</h5>
        <span class="badge badge-primary">{{ $server->getDisplayAddress() }}</span>
        
        <div id="serverStatusCard" data-target="{{ route('api.servers.status', $server->getSlug()) }}">
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
    
            <span class="badge badge-info">
                <i class="fas fa-spinner fa-pulse"></i>
                Łączenie z serwerem
            </span>
        </div>
    </div>
</div>

@if (setting('settings_widget_teamspeak_active'))
    <div class="card server-status-card shadow">
        <div class="card-body">
            <h5>Serwer TeamSpeak3</h5>
            <a href="ts3server://{{ setting('settings_widget_teamspeak_server_display_address') }}">
                <span class="badge badge-primary">{{ setting('settings_widget_teamspeak_server_display_address') }}</span>
            </a>
    
            <div id="teamspeakStatusCard" data-target="{{ route('api.teamspeak.status') }}">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
        
                <span class="badge badge-info">
                    <i class="fas fa-spinner fa-pulse"></i>
                    Łączenie z serwerem
                </span>
            </div>
        </div>
    </div>
@endif

@if (setting('settings_widget_discord_active'))
    <div class="discord-widget shadow">
        <iframe src="https://discordapp.com/widget?id={{ setting('settings_widget_discord_server_id') }}&theme={{ setting('settings_widget_discord_theme') }}" width="350" height="{{ setting('settings_widget_discord_height') }}" allowtransparency="true" frameborder="0"></iframe>
    </div>
@endif
