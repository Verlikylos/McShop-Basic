<?php


namespace App\Http\Repositories\SQL;


use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class OrderRepository implements \App\Http\Repositories\OrderRepositoryInterface
{
    private $table = 'orders';
    
    public function getByHash(UuidInterface $hash, $withService = false, $withPayment = false): ?Order {
        $queryBuilder = Order::where('hash', $hash->toString());
        
        $edger = [];
        
        if ($withPayment) {
            $edger[] = 'payment';
        }
        
        if ($withService) {
            $edger[] = 'service';
        }
        
        if (!empty($edger)) {
            $queryBuilder = $queryBuilder->with($edger);
        }
        
        try {
            $order = $queryBuilder->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
        
        return $order;
    }
    
    public function new(Service $service, string $customer): Order
    {
        $order = new Order();
        
        $order->hash = Str::uuid()->toString();
        $order->customer = $customer;
        $order->service()->associate($service);
        $order->status = OrderStatus::CREATED;
        
        return $order;
    }
    
    public function save(Order $order): bool
    {
        return $order->save();
    }
    
    public function associatePayment(Order $order, Payment $payment): bool
    {
        return $order->payment()->save($payment);
    }
    
    public function update(Order $order, array $data): int
    {
        return DB::table($this->table)->where('id', $order->getId())->update($data);
    }
    
    
}
