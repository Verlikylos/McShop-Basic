<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * App\Models\SmsNumber
 *
 * @property int $id
 * @property string $provider
 * @property string $number
 * @property int $netto_cost
 */
class SmsNumber extends Model
{
    public $timestamps = false;

    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getProvider(): string
    {
        return $this->provider;
    }
    
    public function getNumber(): string
    {
        return $this->number;
    }
    
    public function getNettoCost(): float
    {
        return round((float) $this->netto_cost / 100, 2);
    }
    
    public function getNettoCostFormatted(): string
    {
        return number_format($this->getNettoCost(), 2, ',', ' ') . ' zł';
    }
    
    public function getBruttoCost(): float
    {
        return round((float) ($this->netto_cost * 1.23) / 100, 2);
    }
    
    public function getBruttoCostFormatted(): string
    {
        return number_format($this->getBruttoCost(), 2, ',', ' ') . ' zł';
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'smsnumber_id');
    }
    
    public function getServices(): Collection
    {
        return $this->services;
    }
}
