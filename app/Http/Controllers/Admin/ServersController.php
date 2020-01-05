<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Interfaces\ServerRepositoryInterface;
use App\Models\Server;
use Illuminate\Http\Request;
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
}
