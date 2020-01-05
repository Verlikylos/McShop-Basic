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
 * @property int|null $announcement_content
 * @property int $enabled
 * @property int $sort_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereAnnouncementContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereAnnouncementEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereApiAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereApiKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereConnectionMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereDisplayAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Server whereEnabled($value)
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
    //
}
