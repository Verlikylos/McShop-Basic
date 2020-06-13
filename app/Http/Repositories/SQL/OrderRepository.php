<?php


namespace App\Http\Repositories\SQL;


use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class OrderRepository implements \App\Http\Repositories\OrderRepositoryInterface
{
    private $table = 'orders';
    
    public function new(Service $service, string $customer, Payment $payment = null): Order
    {
        $data = [
            'customer' => $customer,
            'service_id' => $service->getId(),
            'profit' => 0,
            'status' => 'CREATED',
            'date' => now()
        ];
        
        if ($payment !== null) {
            $data['payment_id'] = $payment->getId();
        }
        
        $order = new Order($data);
        $order->save();
        
        return $order;
    }
    
    public function update(Order $order, array $data): int
    {
        return DB::table($this->table)->where('id', $order->getId())->update($data);
    }
    
    
}
