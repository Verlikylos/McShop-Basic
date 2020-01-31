<div class="card server-status-card shadow">
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
<div class="card server-status-card shadow">
    <div class="card-body">
        <h5>Serwer TeamSpeak3</h5>
        <a href="#">
            <span class="badge badge-primary">ts.vmcshop.pro</span>
        </a>
        
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 50%" aria-valuenow="16" aria-valuemin="0" aria-valuemax="32"></div>
        </div>
        
        <span class="badge badge-success">Online</span>
        <span class="badge badge-info">16/32</span>
    </div>
</div>
<div class="discord-widget shadow">
    <iframe src="https://discordapp.com/widget?id=411286006646702081&theme=light" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
</div>
