<?php

namespace App\Http\Controllers\Payments;

use App\Facades\PaymentManager;
use App\Http\Controllers\Controller;
use App\Http\Repositories\OrderRepositoryInterface;
use App\Http\Repositories\PageRepositoryInterface;
use App\Http\Repositories\PaymentRepositoryInterface;
use App\Http\Requests\Payments\PscPaymentRequest;
use App\Jobs\CompleteOrder;
use App\Jobs\ExecuteServiceCommands;
use App\Models\Server;
use App\Models\Service;
use App\Payments\Psc\DirectPscPayment;
use App\Payments\Psc\FormPscPayment;
use App\Payments\Psc\PscPayment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class PscPaymentController extends Controller
{
    private $pageRepository;
    private $paymentRepository;
    private $orderRepository;
    
    public function __construct(PageRepositoryInterface $pageRepository, PaymentRepositoryInterface $paymentRepository, OrderRepositoryInterface $orderRepository)
    {
        $this->pageRepository = $pageRepository;
        $this->paymentRepository = $paymentRepository;
        $this->orderRepository = $orderRepository;
    }
    
    public function checkout(PscPaymentRequest $request, Server $server, Service $service)
    {
        $payment = PaymentManager::createPscPayment($server, $service);
        
        // TODO check if player is online
        
        if ($payment instanceof DirectPscPayment) {
            if (!$payment->register()) {
                return Redirect::route('service', ['server' => $server->getSlug(), 'service' => $service])
                    ->with('shopSessionMessage',[
                        'type' => 'danger',
                        'content' => Lang::get('main.payments.general_error')
                    ]);
            }
            
            $paymentModel = $this->paymentRepository->new($payment);
            $this->orderRepository->new($service, $request->get('playerName'), $paymentModel);
            
            return Redirect::away($payment->getRedirectUrl());
        }
        
        $paymentModel = $this->paymentRepository->new($payment);
        $this->orderRepository->new($service, $request->get('playerName'), $paymentModel);
        $pages = $this->pageRepository->getActive();
        
        return View::make('payment')->with(['pages' => $pages, 'formData' => $payment->getFormData()]);
    
//        FormPscPayment TODO
//        $payment = $this->paymentRepository->new('PSC', $service->getPscCostRaw(), null, $control);
//
//        $this->orderRepository->new($service, $request->get('playerName'), $payment);
//
//        $data = $payment->readyFormData($service, $server, $payment->getPid());
//        $pages = $this->pageRepository->getActive();
//
//        return View::make('payments.index')->with(['pages' => $pages, 'data' => $data]);
    }
    
    public function verify(Request $request) {
        $payment = PaymentManager::getPscPayment($request);
        
        if ($payment === null) {
            return new Response(null,  403);
        }
        
        $paymentModel = $this->paymentRepository->getByControl($payment->getControl());
        
        if ($paymentModel === null || !$paymentModel->exists) {
            return new Response(null,  403);
        }
        
        if ($paymentModel->getStatus() != 'CREATED') {
            return new Response(null,  403);
        }
        
        if (!$payment->compare($paymentModel)) {
            return new Response('he',  403);
        }
        
        $this->paymentRepository->update($paymentModel, $payment, true);
        $order = $paymentModel->getOrder();
        
        if ($order !== null && $order->exists) {
            $orderData = [
                'status' => $payment->getStatus() == 'SUCCESSFUL' ? 'PAID' : 'CANCELED',
                'profit' => $payment->getAmount() // TODO odliczanie prowizji
            ];
    
            $this->orderRepository->update($order, $orderData);
    
            if ($payment->getStatus() == 'SUCCESSFUL') {
                CompleteOrder::dispatch($order);
            }
        }
        
        return new Response('OK', 200);
    }
}
