<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Voucher
 *
 * @property int $id
 * @property int $service_id
 * @property string $code
 * @property int $usages_amount
 * @property bool $many_usages_per_player
 * @property array $used_by
 * @property string $status
 */
class Voucher extends Model
{
    public $timestamps = false;
    
    protected $casts = [
        'many_usages_per_player' => 'boolean',
        'used_by' => 'array'
    ];
    
    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getCode(): string
    {
        return $this->code;
    }
    
    public function getUsagesAmount(): int
    {
        return $this->usages_amount;
    }
    
    public function isManyUsagesPerPlayerAllowed(): bool
    {
        return $this->many_usages_per_player;
    }
    
    public function getUsedBy(): array
    {
        return $this->used_by;
    }
    
    public function getUsedByString(): string
    {
        $output = '';
        
        foreach ($this->used_by as $player) {
            $output .= ', ' . $player;
        }
        
        return Str::replaceFirst(', ', '', $output);
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
    
    public function getService(): Service
    {
        return $this->service;
    }
}
