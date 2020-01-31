<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerAnnouncementRequest;
use App\Http\Requests\UpdateServerRequest;
use App\Models\Server;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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
        // TODO Use repositories instead of inline queries in all controllers
        $servers = Server::orderBy('sort_id')->paginate(10);

        return View::make('admin.servers.index')->with(['servers' => $servers, 'serversCount' => count($servers)]);
    }

    public function create()
    {
        return View::make('admin.servers.create');
    }

    public function store(StoreServerRequest $request)
    {
        $data = [
            'name' => $request->get('serverName'),
            'slug' => str_replace('+', '-', strtolower(urlencode($request->get('serverName')))),
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

        if ($request->hasFile('serverImage') && $request->file('serverImage')->isValid()) {
            $data['image_url'] = asset(str_replace('public/', '', $request->file('serverImage')->storePublicly('public/uploads/servers')));
        }

        $server = $this->serverRepository->new($data);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
            'Pomyślnie dodano serwer o nazwie ' .
            '<span class="font-weight-bold">' . $server->getName() .
            ' (ID: #' . $server->getId() . ')</span>!']);
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

    public function toggle_active(Server $server) {
        $this->serverRepository->update($server->getId(), ['active' => !$server->isActive()]);

        $message = 'Serwer <span class="font-weight-bold">' . $server->getName() .
            ' (ID: #' . $server->getId() . ')</span> został pomyślnie aktywowany!';

        if ($server->isActive()) {
            $message = str_replace('aktywowany', 'dezaktywowany', $message);

            return Redirect::back()
                ->with('sessionMessage', ['type' => 'success', 'content' => $message]);
        }

        return Redirect::back()
            ->with('sessionMessage', ['type' => 'success', 'content' => $message]);
    }

    public function swap(Server $server, bool $up)
    {
        $secondServer = null;

        if ($up) {
            $secondServer = $this->serverRepository->getWithHigherSortIdThan($server->getSortId());
        } else {
            $secondServer = $this->serverRepository->getWithLowerSortIdThan($server->getSortId());
        }

        if ($secondServer == null) {
            throw new BadRequestHttpException();
        }

        $firstServerData = [
            'sort_id' => $secondServer->getSortId()
        ];

        $secondServerData = [
            'sort_id' => $server->getSortId()
        ];

        $this->serverRepository->update($server->getId(), $firstServerData);
        $this->serverRepository->update($secondServer->getId(), $secondServerData);

        return Redirect::back()
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pozycja serwera <span class="font-weight-bold">' . $server->getName() .
                ' (ID: #' . $server->getId() . ')</span> została zaktualizowana!']);
    }

    public function edit(Server $server)
    {
        return View::make('admin.servers.edit')->with(['server' => $server]);
    }

    public function update(UpdateServerRequest $request, Server $server)
    {
        $data = [
            'name' => $request->get('serverName'),
            'slug' => str_replace('+', '-', strtolower(urlencode($request->get('serverName')))),
            'display_address' => $request->get('serverDisplayAddress'),
            'connection_method' => $request->get('serverConnectionMethod'),
            'ip_address' => $request->get('serverIpAddress'),
            'port' => $request->get('serverPort'),
            'rcon_port' => $request->get('serverRconPort'),
            'rcon_password' => $request->get('serverRconPassword'),
            'api_address' => $request->get('serverApiAddress'),
            'api_key' => $request->get('serverApiKey'),
        ];

        if ($request->hasFile('serverImage') && $request->file('serverImage')->isValid()) {
            $data['image_url'] = asset(str_replace('public/', '', $request->file('serverImage')->storePublicly('public/uploads/servers')));
        }

        $this->serverRepository->update($server->getId(), $data);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie zaktualizowano serwer ' .
                '<span class="font-weight-bold">' . $server->getName() .
                ' (ID: #' . $server->getId() . ')</span>!']);
    }

    public function delete(Server $server)
    {
        $this->serverRepository->delete($server->getId());

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', ['type' => 'success', 'content' =>
                'Pomyślnie usunięto serwer ' .
                '<span class="font-weight-bold">' . $server->getName() .
                ' (ID: #' . $server->getId() . ')</span>!']);
    }
}
