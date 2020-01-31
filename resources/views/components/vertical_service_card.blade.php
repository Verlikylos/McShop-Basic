<div class="col-12 col-md-6 col-lg-4">
    <div class="card service-card shadow-sm">
        <img src="{{ $service->getImageUrl() }}" class="card-img-top" alt="{{ $service->getName() . '\'s image' }}">
        <div class="card-body">
            <h5 class="card-title">{{ $service->getName() }}</h5>
            <div class="service-card-pricing-table">
                <span class="badge badge-secondary">
                    <i class="fas fa-mobile-alt"></i>
                    SMS: 11,07 zł
                </span>
                <span class="badge badge-secondary">
                    <i class="fas fa-lock"></i>
                    PSC: 11,00 zł
                </span>
                <span class="badge badge-secondary">
                    <i class="fas fa-credit-card"></i>
                    Przelew: 10,00 zł
                </span>
                <span class="badge badge-secondary">
                    <i class="fab fa-paypal"></i>
                    PayPal: 10,00 zł
                </span>
            </div>
            <a href="{{ route('service') }}" class="btn btn-success">
                <i class="fas fa-shopping-cart"></i> Wybierz
            </a>
        </div>
    </div>
</div>
