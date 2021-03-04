<?php

namespace App\Http\Controllers;

use App\Enums\PaymentType;
use App\Facades\PaymentManager;
use App\Http\Repositories\OrderRepositoryInterface;
use App\Http\Repositories\PageRepositoryInterface;
use App\Http\Repositories\PaymentRepositoryInterface;
use App\Models\Server;
use App\Models\Service;
use App\Payments\Gateways\FormBasedPaymentGateway;
use App\Payments\Gateways\WhiteLabelPaymentGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    private $orderRepository;
    private $paymentRepository;
    private $pageRepository;
    
    public function __construct(OrderRepositoryInterface $orderRepository, PaymentRepositoryInterface $paymentRepository, PageRepositoryInterface $pageRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->paymentRepository = $paymentRepository;
        $this->pageRepository = $pageRepository;
    }
    
    public function checkout(Request $request, Server $server, Service $service)
    {
        //TODO check payment type in request validation
        
        $paymentGateway = PaymentManager::getPaymentGateway($request->get('paymentType'));
        
        if ($paymentGateway === null) {
            return Redirect::route('service', ['server' => $server->getSlug(), 'service' => $service])
                ->with('shopSessionMessage',[
                    'type' => 'danger',
                    'content' => Lang::get('main.payments.general_error')
                ]);
        }
        
        $order = $this->orderRepository->new($service, $request->get('playerName'));
        $paymentCost = $service->getCostRaw($request->get('paymentType'));
        
        if ($paymentCost === null) {
            return Redirect::route('service', ['server' => $server->getSlug(), 'service' => $service])
                ->with('shopSessionMessage',[
                    'type' => 'danger',
                    'content' => Lang::get('main.payments.general_error')
                ]);
        }
        
        $payment = $this->paymentRepository->new(
            $request->get('paymentType'),
            setting('settings_payments_' . strtolower($request->get('paymentType')) . '_operator'),
            $paymentCost
        );
        
        $this->orderRepository->associatePayment($order, $payment);
    
    
        if ($paymentGateway instanceof WhiteLabelPaymentGateway) {
            $response = $paymentGateway->register($order);
            
            if ($response['error']) {
                return Redirect::route('service', ['server' => $server->getSlug(), 'service' => $service])
                    ->with('shopSessionMessage',[
                        'type' => 'danger',
                        'content' => Lang::get('main.payments.general_error')
                    ]);
            }
            
            if ($response['pid'] !== null) {
                $this->paymentRepository->setPid($payment, $response['pid']);
            }
            
            $this->paymentRepository->save($payment);
            $this->orderRepository->save($order);
            
            return Redirect::away($response['redirectUrl']);
        }
        
        if ($paymentGateway instanceof FormBasedPaymentGateway) {
            $formData = $paymentGateway->getFormData($order);
            $pages = $this->pageRepository->getActive();
    
            $this->paymentRepository->save($payment);
            $this->orderRepository->save($order);
    
            return View::make('payment')->with(['pages' => $pages, 'formData' => $formData]);
        }
    
        abort(500);
        //TODO sms payment
    }
}
