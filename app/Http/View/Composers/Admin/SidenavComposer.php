<?php


namespace App\Http\View\Composers\Admin;


use App\Http\Repositories\ServerRepositoryInterface;
use Illuminate\View\View;

class SidenavComposer
{
    protected $serverRepository;

    public function __construct(ServerRepositoryInterface $serverRepository)
    {
        $this->serverRepository = $serverRepository;
    }

    public function compose(View $view)
    {
        $view->with('navServers', $this->serverRepository->all());
    }
}
