<?php

namespace App\Http\Controllers\Admin\Settings\Widgets;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdateTemspeakWidgetSettingsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class TeamspeakController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        return View::make('admin.settings.widget.teamspeak');
    }
    
    public function update(UpdateTemspeakWidgetSettingsRequest $request)
    {
        setting([
            'settings_widget_teamspeak_server_address' => $request->get('teamspeakAddress'),
            'settings_widget_teamspeak_server_port' => $request->get('teamspeakPort'),
            'settings_widget_teamspeak_server_display_address' => $request->get('teamspeakDisplayAddress'),
            'settings_widget_teamspeak_server_query_port' => $request->get('teamspeakQueryPort'),
            'settings_widget_teamspeak_server_query_user' => $request->get('teamspeakQueryUser'),
            'settings_widget_teamspeak_server_query_password' => $request->get('teamspeakQueryPassword')
        ])->save();
    
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.widget.teamspeak.updated')
        ]);
    
        return Redirect::route('admin.settings.widget.teamspeak.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
    
    public function toggle_active()
    {
        setting([
            'settings_widget_teamspeak_active' => !setting('settings_widget_teamspeak_active')
        ])->save();
    
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => setting('settings_widget_teamspeak_active') ? Lang::get('admin.settings.logs.widget.teamspeak.enabled') : Lang::get('admin.settings.logs.widget.teamspeak.disabled')
        ]);
    
        return Redirect::route('admin.settings.widget.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => setting('settings_widget_teamspeak_active') ? Lang::get('admin.settings.widget.teamspeak.enabled') : Lang::get('admin.settings.widget.teamspeak.disabled')
            ]);
    }
}
