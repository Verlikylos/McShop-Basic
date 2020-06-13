<?php


namespace App\Http\Repositories\SQL;


use App\Http\Repositories\PaymentRepositoryInterface;
use App\Models\Payment;
use App\Payments\Psc\PscPayment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class PaymentRepository implements PaymentRepositoryInterface
{
    private $table = 'payments';
    
    public function new(\App\Payments\Payment $payment): ?Payment
    {
        $type = null;
        
        if ($payment instanceof PscPayment) {
            $type = 'PSC';
        }
        
        if ($type === null) {
            return null;
        }
        
        $data = [
            'type' => $type,
            'pid' => $payment->getPid(),
            'control' => $payment->getControl(),
            'cost' => $payment->getAmount(),
            'status' => $payment->getStatus()
        ];
        
        $paymentModel = new Payment($data);
        $paymentModel->save();
        
        
        return $paymentModel;
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
