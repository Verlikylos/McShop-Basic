<?php

namespace App\Jobs;

use App\Http\Repositories\OrderRepositoryInterface;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CompleteOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $order;
    private $orderRepository;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(OrderRepositoryInterface $orderRepository)
    {
        if (!in_array($this->order->getStatus(), ['PAID', 'FAILED'])) {
            return;
        }
        
        try {
            $this->order->getService()->redeem($this->order->getCustomer());
        } catch (\Exception $exception) {
            $data = [
                'status' => 'FAILED'
            ];
            
            $orderRepository->update($this->order, $data);
            
            $this->fail($exception);
            return;
        }
    
        $data = [
            'status' => 'COMPLETED'
        ];
    
        $orderRepository->update($this->order, $data);
    }
}
