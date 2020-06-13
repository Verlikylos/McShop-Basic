<div class="col-12">
    <div class="card service-card card-img-left shadow-sm">
        <img src="{{ $service->getImageUrl() }}" class="card-img" alt="{{ $service->getName() . '\'s image' }}">
        <div class="card-body">
            <div class="card-horizontal-header">
                <h5 class="card-title">{{ $service->getName() }}</h5>
                <p class="card-text">
                    {{ substr($service->getDescription(), 0, 180) . '...' }}
                </p>
            </div>
            <div class="card-horizontal-footer">
                <div class="service-card-pricing-table">
                    @if ($service->getSmsNumber() != null && $service->getSmsNumber()->exists)
                        <div class="price-tag">
                            <span class="price">{{ $service->getSmsNumber()->getBruttoCostFormatted() }}</span>
                            <span class="payment-method">SMS</span>
                        </div>
                    @endif
                    @if ($service->getPscCost() > 0)
                        <div class="price-tag">
                            <span class="price">{{ $service->getPscCostFormatted() }}</span>
                            <span class="payment-method">PSC</span>
                        </div>
                    @endif
                    @if ($service->getTransferCost() > 0)
                        <div class="price-tag">
                            <span class="price">{{ $service->getTransferCostFormatted() }}</span>
                            <span class="payment-method">Przelew</span>
                        </div>
                    @endif
                    @if ($service->getPaypalCost() > 0)
                        <div class="price-tag">
                            <span class="price">{{ $service->getPaypalCostFormatted() }}</span>
                            <span class="payment-method">PayPal</span>
                        </div>
                    @endif
                </div>
                <a href="{{ route('service', ['server' => $server->getSlug(), 'service' => $service->getSlug()]) }}" class="btn btn-success">
                    <i class="fas fa-shopping-cart"></i> Wybierz
                </a>
            </div>
        </div>
    </div>
</div>
