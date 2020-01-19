<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property int $server_id
 * @property string $image_url
 * @property string $description
 * @property int $require_online_player
 * @property string $commands
 * @property int $smsnumber_id
 * @property int $psc_cost
 * @property int $transfer_cost
 * @property int $paypal_cost
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereCommands($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service wherePaypalCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service wherePscCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereRequireOnlinePlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereSmsnumberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereTransferCost($value)
 * @mixin \Eloquent
 */
class Service extends Model
{
    //
}
