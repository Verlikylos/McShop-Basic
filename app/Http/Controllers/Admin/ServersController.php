<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Repositories\ServerRepositoryInterface;
use App\Http\Requests\StoreServerRequest;
use App\Http\Requests\UpdateServerAnnouncementRequest;
use App\Http\Requests\UpdateServerRequest;
use App\Models\Server;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ServersController extends Controller
{
    private $serverRepository;
    private $logRepository;

    public function __construct(ServerRepositoryInterface $serverRepository, LogRepositoryInterface $logRepository)
    {
        $this->serverRepository = $serverRepository;
        $this->logRepository = $logRepository;
    }

    public function index()
    {
        // TODO Use repositories instead of inline queries in all controllers
        $servers = Server::orderBy('sort_id')->paginate(10);

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

        if (Str::endsWith($data['api_address'], '/')) {
            $data['api_address'] = Str::replaceLast('/', '', $data['api_address']);
        }

        if ($request->hasFile('serverImage') && $request->file('serverImage')->isValid()) {
            $data['image_url'] = asset(str_replace('public/', '', $request->file('serverImage')->storePublicly('public/uploads/servers')));
        }

        $server = $this->serverRepository->new($data);

        $this->logRepository->new([
            'category' => 'SERVERS',
            'color' => 'success',
            'details' => Lang::get('admin.servers.logs.created', [
                'server' => $server->getName(),
                'server_id' => $server->getId()
            ])
        ]);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.servers.created', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);
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

        $this->logRepository->new([
            'category' => 'SERVERS',
            'color' => 'info',
            'details' => Lang::get('admin.servers.logs.announcement.edited', [
                'server' => $server->getName(),
                'server_id' => $server->getId()
            ])
        ]);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.servers.announcement.edited', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);
    }

    public function toggle_active(Server $server) {
        $this->serverRepository->update($server->getId(), ['active' => !$server->isActive()]);

        if ($server->isActive()) {
            $this->logRepository->new([
                'category' => 'SERVERS',
                'color' => 'primary',
                'details' => Lang::get('admin.servers.logs.status.disabled', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);

            return Redirect::back()
                ->with('sessionMessage', [
                    'type' => 'success',
                    'content' => Lang::get('admin.servers.status.disabled', [
                        'server' => $server->getName(),
                        'server_id' => $server->getId()
                    ])
                ]);
        }

        $this->logRepository->new([
            'category' => 'SERVERS',
            'color' => 'primary',
            'details' => Lang::get('admin.servers.logs.status.enabled', [
                'server' => $server->getName(),
                'server_id' => $server->getId()
            ])
        ]);

        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.servers.status.enabled', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);
    }

    public function swap(Server $server, bool $up)
    {
        $secondServer = null;

        if ($up) {
            $secondServer = $this->serverRepository->getWithLowerSortIdThan($server->getSortId());
        } else {
            $secondServer = $this->serverRepository->getWithHigherSortIdThan($server->getSortId());
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

        $this->logRepository->new([
            'category' => 'SERVERS',
            'color' => 'primary',
            'details' => Lang::get('admin.servers.logs.order.updated', [
                'server' => $server->getName(),
                'server_id' => $server->getId()
            ])
        ]);

        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.servers.order.updated', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);
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

        if (Str::endsWith($data['api_address'], '/')) {
            $data['api_address'] = Str::replaceLast('/', '', $data['api_address']);
        }

        if ($request->hasFile('serverImage') && $request->file('serverImage')->isValid()) {
            $data['image_url'] = asset(str_replace('public/', '', $request->file('serverImage')->storePublicly('public/uploads/servers')));
        }

        $this->serverRepository->update($server->getId(), $data);

        $this->logRepository->new([
            'category' => 'SERVERS',
            'color' => 'info',
            'details' => Lang::get('admin.servers.logs.updated', [
                'server' => $server->getName(),
                'server_id' => $server->getId()
            ])
        ]);

        return Redirect::route('admin.servers.index')
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.servers.updated', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);
    }

    public function delete(Server $server)
    {
        $this->serverRepository->delete($server->getId());

        $this->logRepository->new([
            'category' => 'SERVERS',
            'color' => 'danger',
            'details' => Lang::get('admin.servers.logs.deleted', [
                'server' => $server->getName(),
                'server_id' => $server->getId()
            ])
        ]);

        return Redirect::back()
            ->with('sessionMessage', [
                'type' => 'success',
                'content' => Lang::get('admin.servers.deleted', [
                    'server' => $server->getName(),
                    'server_id' => $server->getId()
                ])
            ]);
    }
}
