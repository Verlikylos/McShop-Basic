<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeamspeakController extends Controller
{
    public function status()
    {
        $status = [
            'online' => false,
            'players' => null,
            'max_players' => null
        ];
        
        try {
            $uri = 'serverquery://' . setting('settings_widget_teamspeak_server_query_user') . ':' . setting('settings_widget_teamspeak_server_query_password') .
                '@' . setting('settings_widget_teamspeak_server_address') . ':' . setting('settings_widget_teamspeak_server_query_port') . '/?server_port=' .
                setting('settings_widget_teamspeak_server_port');
            
            $framework = new \TeamSpeak3();
            
            $virtualServer = $framework->factory($uri);
    
            $status = [
                'online' => true,
                'players' => $virtualServer->virtualserver_clientsonline - $virtualServer->virtualserver_queryclientsonline,
                'max_players' => $virtualServer->virtualserver_maxclients,
            ];
            
            return $status;
        } catch(\TeamSpeak3_Exception $e) {
            return $status;
        }
    }
}
