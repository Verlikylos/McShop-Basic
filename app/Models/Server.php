<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Server
 *
 * @property int $id
 * @property string $name
 * @property string $image_url
 * @property string $display_address
 * @property string $connection_method
 * @property string|null $ip_address
 * @property string|null $port
 * @property string|null $rcon_port
 * @property string|null $rcon_password
 * @property string|null $api_address
 * @property string|null $api_key
 * @property int $announcement_enabled
 * @property string|null $announcement_content
 * @property int $active
 * @property int $sort_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereAnnouncementContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereAnnouncementEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereApiAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereConnectionMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereDisplayAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server wherePort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereRconPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereRconPort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereSortId($value)
 * @mixin \Eloquent
 */
class Server extends Model
{
    public $timestamps = false;

    public $casts = [
        'announcement_enabled' => 'boolean',
        'active' => 'boolean'
    ];

    public $guarded = [];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param  string  $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->image_url;
    }

    /**
     * @param  string  $image_url
     */
    public function setImageUrl(string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * @return string
     */
    public function getDisplayAddress(): string
    {
        return $this->display_address;
    }

    /**
     * @param  string  $display_address
     */
    public function setDisplayAddress(string $display_address): void
    {
        $this->display_address = $display_address;
    }

    /**
     * @return string
     */
    public function getConnectionMethod(): string
    {
        return $this->connection_method;
    }

    /**
     * @param  string  $connection_method
     */
    public function setConnectionMethod(string $connection_method): void
    {
        $this->connection_method = $connection_method;
    }

    /**
     * @return string|null
     */
    public function getIpAddress(): ?string
    {
        return $this->ip_address;
    }

    /**
     * @param  string|null  $ip_address
     */
    public function setIpAddress(?string $ip_address): void
    {
        $this->ip_address = $ip_address;
    }

    /**
     * @return string|null
     */
    public function getPort(): ?string
    {
        return $this->port;
    }

    /**
     * @param  string|null  $port
     */
    public function setPort(?string $port): void
    {
        $this->port = $port;
    }

    /**
     * @return string|null
     */
    public function getRconPort(): ?string
    {
        return $this->rcon_port;
    }

    /**
     * @param  string|null  $rcon_port
     */
    public function setRconPort(?string $rcon_port): void
    {
        $this->rcon_port = $rcon_port;
    }

    /**
     * @return string|null
     */
    public function getRconPassword(): ?string
    {
        return $this->rcon_password;
    }

    /**
     * @param  string|null  $rcon_password
     */
    public function setRconPassword(?string $rcon_password): void
    {
        $this->rcon_password = $rcon_password;
    }

    /**
     * @return string|null
     */
    public function getApiAddress(): ?string
    {
        return $this->api_address;
    }

    /**
     * @param  string|null  $api_address
     */
    public function setApiAddress(?string $api_address): void
    {
        $this->api_address = $api_address;
    }

    /**
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->api_key;
    }

    /**
     * @param  string|null  $api_key
     */
    public function setApiKey(?string $api_key): void
    {
        $this->api_key = $api_key;
    }

    /**
     * @return int
     */
    public function isAnnouncementEnabled(): int
    {
        return $this->announcement_enabled;
    }

    /**
     * @param  int  $announcement_enabled
     */
    public function setAnnouncementEnabled(int $announcement_enabled): void
    {
        $this->announcement_enabled = $announcement_enabled;
    }

    /**
     * @return string|null
     */
    public function getAnnouncementContent(): ?string
    {
        return $this->announcement_content;
    }

    /**
     * @return string|null
     */
    public function getMarkdownedAnnouncementContet(): ?string
    {
        return app(\Parsedown::class)->setSafeMode(true)->text($this->announcement_content);
    }

    /**
     * @param  string|null  $announcement_content
     */
    public function setAnnouncementContent(?string $announcement_content): void
    {
        $this->announcement_content = $announcement_content;
    }

    /**
     * @return int
     */
    public function isActive(): int
    {
        return $this->active;
    }

    /**
     * @param  int  $active
     */
    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    /**
     * @return int
     */
    public function getSortId(): int
    {
        return $this->sort_id;
    }

    /**
     * @param  int  $sort_id
     */
    public function setSortId(int $sort_id): void
    {
        $this->sort_id = $sort_id;
    }

}
