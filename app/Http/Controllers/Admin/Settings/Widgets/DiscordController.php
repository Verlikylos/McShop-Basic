<?php

namespace App\Http\Controllers\Admin\Settings\Widgets;

use App\Http\Controllers\Controller;
use App\Http\Repositories\LogRepositoryInterface;
use App\Http\Requests\UpdateDiscordWidgetSettingsRequest;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class DiscordController extends Controller
{
    private $logRepository;
    
    public function __construct(LogRepositoryInterface $logRepository)
    {
        $this->logRepository = $logRepository;
    }
    
    public function index()
    {
        return View::make('admin.settings.widget.discord');
    }
    
    public function update(UpdateDiscordWidgetSettingsRequest $request)
    {
        setting([
            'settings_widget_discord_server_id' => $request->get('discordServerId'),
            'settings_widget_discord_height' => $request->get('discordHeight'),
            'settings_widget_discord_theme' => $request->get('discordTheme')
        ])->save();
        
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => Lang::get('admin.settings.logs.widget.discord.updated')
        ]);
        
        return Redirect::route('admin.settings.widget.discord.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => Lang::get('admin.settings.saved')
            ]);
    }
    
    public function toggle_active()
    {
        setting([
            'settings_widget_discord_active' => !setting('settings_widget_discord_active')
        ])->save();
        
        $this->logRepository->new([
            'category' => 'SETTINGS',
            'color' => 'primary',
            'details' => setting('settings_widget_discord_active') ? Lang::get('admin.settings.logs.widget.discord.enabled') : Lang::get('admin.settings.logs.widget.discord.disabled')
        ]);
        
        return Redirect::route('admin.settings.widget.index')
            ->with('sessionMessage',[
                'type' => 'success',
                'content' => setting('settings_widget_discord_active') ? Lang::get('admin.settings.widget.discord.enabled') : Lang::get('admin.settings.widget.discord.disabled')
            ]);
    }
}
