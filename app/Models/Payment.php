<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $pid
 * @property string $hash
 * @property string $type
 * @property string $provider
 * @property int $cost
 * @property string $details
 * @property string $status
 */
class Payment extends Model
{
    protected $guarded = [];
    
    protected $casts = [
        'details' => 'object'
    ];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getPid(): ?string
    {
        return $this->pid;
    }
    
    public function getHash(): ?UuidInterface
    {
        return Uuid::fromString($this->hash);
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getProvider(): string
    {
        return $this->provider;
    }
    
    public function getCostRaw(): int
    {
        return $this->cost;
    }
    
    public function getCost(): float
    {
        return round((float) $this->cost / 100, 2);
    }
    
    public function getDetails(): object
    {
        return $this->details;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function order() {
        return $this->belongsTo(Order::class, 'id', 'id');
    }
    
    public function getOrder(): ?Order
    {
        return $this->order;
    }
}
