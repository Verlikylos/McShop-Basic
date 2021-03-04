<?php


namespace App\Http\Repositories\SQL;


use App\Enums\PaymentStatus;
use App\Http\Repositories\PaymentRepositoryInterface;
use App\Models\Payment;
use App\Payments\Psc\PscPayment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class PaymentRepository implements PaymentRepositoryInterface
{
    private $table = 'payments';
    
    public function new($type, $provider, $cost): Payment
    {
        $payment = new Payment();
        
        $payment->pid = null;
        $payment->hash = Str::uuid()->toString();
        $payment->type = $type;
        $payment->provider = $provider;
        $payment->cost = $cost;
        $payment->details = null;
        $payment->status = PaymentStatus::CREATED;
        
        return $payment;
    }
    
    public function setPid(Payment $payment, string $pid): bool
    {
        if ($payment->pid !== null) {
            return false;
        }
        
        $payment->pid = $pid;
        
        return true;
    }
    
    public function save(Payment $payment): bool
    {
        return $payment->save();
    }
    
    public function getByControl(Uuid $control): ?Payment
    {
        try {
            $payment = Payment::where('control', $control->toString())->with('order')->firstOrFail();
        } catch (ModelNotFoundException $e) {
            return null;
        }
        
        return $payment;
    }
    
    public function update(Payment $paymentModel, \App\Payments\Payment $payment, bool $withPid = false): int
    {
        $data = [
            'status' => $payment->getStatus()
        ];
        
        if ($withPid) {
            $data['pid'] = $payment->getPid();
        }
    
        return DB::table($this->table)->where('id', $paymentModel->getId())->update($data);
    }
    
    
}
