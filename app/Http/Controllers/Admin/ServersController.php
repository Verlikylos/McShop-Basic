<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerAnnouncementRequest;
use App\Models\Server;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ServersController extends Controller
{
    /**
     * @var ServerRepositoryInterface
     */
    private $serverRepository;

    public function __construct(ServerRepositoryInterface $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    public function index()
    {
        $servers = Server::paginate(10);

        return View::make('admin.servers.index')->with(['servers' => $servers]);
    }

    public function create()
    {
        return View::make('admin.servers.create');
    }

    public function store(StoreServerRequest $request)
    {
        $data = [
            'name' => $request->get('serverName'),
            'image_url' => $request->has('serverImage') ? $request->file('serverImage')->storePublicly('avatars') : null,
            'display_address' => $request->get('serverDisplayAddress'),
            'connection_method' => $request->get('serverConnectionMethod'),
            'ip_address' => $request->get('serverIpAddress'),
            'port' => $request->get('serverPort'),
            'rcon_port' => $request->get('serverRconPort'),
            'rcon_password' => $request->get('serverRconPassword'),
            'api_address' => $request->get('serverApiAddress'),
            'api_key' => $request->get('serverApiKey'),
            'active' => false,
            'sort_id' => $this->serverRepository->getLastSortIndex() + 1,
        ];

        $server = $this->serverRepository->new($data);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
            'Pomyślnie dodano serwer o nazwie ' .
            '<span class="font-weight-bold">' . $server->getName() .
            ' (ID: #' . $server->getId() . ')</span>']);
    }

    public function show_announcement(Server $server)
    {
        return View::make('admin.servers.announcement')->with(['server' => $server]);
    }

    public function update_announcement(UpdateServerAnnouncementRequest $request, Server $server) {
        $data = [
            'announcement_enabled' => $request->has('serverAnnouncementEnabled'),
            'announcement_content' => $request->get('serverAnnouncementContent', '')
        ];

        $this->serverRepository->update($server->id, $data);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Ogłoszenie serwera ' .
                '<span class="font-weight-bold">' . $server->getName() .
                ' (ID: #' . $server->getId() . ')</span> zostało pomyślnie zaktualizowane!']);
    }
}
