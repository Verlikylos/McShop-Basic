<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use xPaw\MinecraftQuery;
use xPaw\MinecraftQueryException;


/**
 * App\Models\Server
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $image_url
 * @property string $display_address
 * @property string $connection_method
 * @property string|null $ip_address
 * @property string|null $port
 * @property string|null $rcon_port
 * @property string|null $rcon_password
 * @property string|null $api_address
 * @property string|null $api_key
 * @property boolean $announcement_enabled
 * @property string|null $announcement_content
 * @property boolean $active
 * @property boolean $sort_id
 */
class Server extends Model
{
    public $timestamps = false;

    protected $casts = [
        'announcement_enabled' => 'boolean',
        'active' => 'boolean'
    ];

    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getSlug(): string
    {
        return $this->slug;
    }
    
    public function getImageUrl(): string
    {
        return $this->image_url;
    }
    
    public function getDisplayAddress(): string
    {
        return $this->display_address;
    }
    
    public function getConnectionMethod(): string
    {
        return $this->connection_method;
    }
    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }
    
    public function getPort(): ?string
    {
        return $this->port;
    }
    
    public function getRconPort(): ?string
    {
        return $this->rcon_port;
    }

    public function getRconPassword(): ?string
    {
        return $this->rcon_password;
    }

    public function getApiAddress(): ?string
    {
        return $this->api_address;
    }
    
    public function getApiKey(): ?string
    {
        return $this->api_key;
    }
    
    public function isAnnouncementEnabled(): bool
    {
        return $this->announcement_enabled;
    }
    
    public function getAnnouncementContent(): ?string
    {
        return $this->announcement_content;
    }
    
    public function getAnnouncementContentFormatted(): ?string
    {
        return app(\Parsedown::class)->setSafeMode(true)->text($this->announcement_content);
    }
    
    public function isActive(): bool
    {
        return $this->active;
    }
    
    public function getSortId(): int
    {
        return $this->sort_id;
    }
    
    public function getStatus(): array
    {
        if (isset($this->status)) {
            return $this->status;
        }
        
        $status = [
            'online' => false,
            'players' => null,
            'max_players' => null,
            'version' => null,
        ];
        
        if ($this->connection_method == 'api') {
            $url = $this->api_address . '/status';
            $response = Http::get($url);
            
            if (!$response->ok()) {
                $this->status = $status;
            } else {
                $response = $response->json();
                
                $status = [
                    'online' => true,
                    'players' => $response['online'],
                    'max_players' => $response['maxOnline'],
                    'version' => $response['version'],
                ];
                
                $this->status = $status;
            }
        } else {
            $client = new MinecraftQuery();
            
            try {
                $client->Connect($this->ip_address, $this->port);
                
                $response = $client->GetInfo();
    
                $status = [
                    'online' => true,
                    'players' => $response['Players'],
                    'max_players' => $response['MaxPlayers'],
                    'version' => $response['Version'],
                ];
                
                $this->status = $status;
            } catch (MinecraftQueryException $e) {
                $this->status = $status;
            }
        }
        
        return $this->status;
    }
    
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    
    public function getServices(): Collection
    {
        // TODO change $server->services() to $server->getServices() everywhere
        
        return $this->services;
    }
    
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

}
