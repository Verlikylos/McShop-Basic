<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


/**
 * App\Models\Order
 *
 * @property int $id
 * @property string $hash
 * @property string $customer
 * @property int $service_id
 * @property int $payment_id
 * @property int $profit
 * @property string $status
 * @property Carbon $date
 */
class Order extends Model
{
    protected $guarded = [];
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getHash(): ?UuidInterface
    {
        return Uuid::fromString($this->hash);
    }
    
    public function getCustomer(): string
    {
        return $this->customer;
    }
    
    public function getProfit(): int
    {
        return $this->profit;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function getDate(): Carbon
    {
        return $this->date;
    }
    
    public function service() {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
    
    public function getService(): ?Service
    {
        return $this->service;
    }
    
    public function payment() {
        return $this->hasOne(Payment::class, 'payment_id', 'id');
    }
    
    public function getPayment(): ?Payment
    {
        return $this->payment;
    }
}
