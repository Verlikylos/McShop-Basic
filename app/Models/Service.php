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
 * @property bool $requires_online_player
 * @property array $commands
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereRequiresOnlinePlayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereSmsnumberId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereTransferCost($value)
 * @mixin \Eloquent
 * @property int $active
 * @property int $sort_id
 * @property-read \App\Models\Server $server
 * @property-read \App\Models\SmsNumber|null $smsnumber
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereSortId($value)
 */
class Service extends Model
{
    public $timestamps = false;
    
    protected $casts = [
        'requires_online_player' => 'boolean',
        'commands' => 'array'
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
    public function getSlug(): string
    {
        return $this->slug;
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
    public function getDescription(): string
    {
        return $this->description;
    }
    
    /**
     * @param  string  $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    
    /**
     * @return bool
     */
    public function isRequiresOnlinePlayer(): bool
    {
        return $this->requires_online_player;
    }
    
    /**
     * @param  bool  $requires_online_player
     */
    public function setRequiresOnlinePlayer(bool $requires_online_player): void
    {
        $this->requires_online_player = $requires_online_player;
    }
    
    /**
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands;
    }
    
    /**
     * @param  array  $commands
     */
    public function setCommands(array $commands): void
    {
        $this->commands = $commands;
    }
    
    /**
     * @return float
     */
    public function getPscCost(): float
    {
        return round((float) $this->psc_cost / 100, 2);
    }
    
    /**
     * @param  float  $psc_cost
     */
    public function setPscCost(float $psc_cost): void
    {
        $this->psc_cost = intval($psc_cost * 100);
    }
    
    /**
     * @return float
     */
    public function getTransferCost(): float
    {
        return round((float) $this->transfer_cost / 100, 2);
    }
    
    /**
     * @param  int  $transfer_cost
     */
    public function setTransferCost(int $transfer_cost): void
    {
        $this->transfer_cost = intval($transfer_cost * 100);
    }
    
    /**
     * @return float
     */
    public function getPaypalCost(): float
    {
        return round((float) $this->paypal_cost / 100, 2);
    }
    
    /**
     * @param  int  $paypal_cost
     */
    public function setPaypalCost(int $paypal_cost): void
    {
        $this->paypal_cost = intval($paypal_cost * 100);
    }
    
    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
    
    /**
     * @param  bool  $active
     */
    public function setActive(bool $active): void
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
    
    
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function server()
    {
        return $this->belongsTo(Server::class, 'server_id', 'id');
    }
    
    /**
     * @return Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }
    
    /**
     * @param  Server  $server
     */
    public function setServer(Server $server): void
    {
        $this->server = $server;
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function smsnumber()
    {
        return $this->belongsTo(SmsNumber::class, 'smsnumber_id', 'id');
    }
    
    /**
     * @return SmsNumber|null
     */
    public function getSmsNumber(): ?SmsNumber
    {
        return $this->smsnumber;
    }
    
    /**
     * @param  SmsNumber  $number
     */
    public function setSmsNumber(SmsNumber $number): void
    {
        $this->smsnumber = $number;
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    
    public function getAvailablePaymentBadges(): array
    {
        $badges = [];
        
        if ($this->getSmsNumber() != null) {
            $badges[] = $this->makeBadge('sms');
        }
        
        if ($this->getPscCost() > 0) {
            $badges[] = $this->makeBadge('psc');
        }
        
        if ($this->getTransferCost() > 0) {
            $badges[] = $this->makeBadge('transfer');
        }
        
        if ($this->getPaypalCost() > 0) {
            $badges[] = $this->makeBadge('paypal');
        }
        
        return $badges;
    }
    
    private function makeBadge($payment = 'sms'): ?string
    {
        $paymentMethods = config('mcshop.payment_methods');
        
        if (!in_array($payment, array_keys($paymentMethods))) {
            return null;
        }
        
        return '<span class="badge badge-' . $paymentMethods[$payment]['color'] . '">' . $paymentMethods[$payment]['displayname'] . '</span>';
    }
}
