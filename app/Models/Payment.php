<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


/**
 * App\Models\Payment
 *
 * @property int $id
 * @property string $type
 * @property string $pid
 * @property string $control
 * @property int $cost
 * @property string $status
 */
class Payment extends Model
{
    public $timestamps = false;
    
    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getPid(): ?string
    {
        return $this->pid;
    }
    
    public function getControl(): ?UuidInterface
    {
        return Uuid::fromString($this->control);
    }
    
    public function getCostRaw(): int
    {
        return $this->cost;
    }
    
    public function getCost(): float
    {
        return round((float) $this->cost / 100, 2);
    }
    
    public function getCostString(): string {
        return number_format($this->getCost(), 2, '.', '');
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
