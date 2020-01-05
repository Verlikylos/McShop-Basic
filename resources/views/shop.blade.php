@extends('components.layout')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="shop-header">
                        <h4><i class="fas fa-shopping-basket"></i> Sklep serwera Hardcore</h4>
                        <button class="btn btn-primary"><i class="fas fa-ticket-alt"></i> Zrealizuj voucher</button>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card service-card shadow-sm">
                                    <img src="https://via.placeholder.com/500" class="card-img-top" alt="service-image">
                                    <div class="card-body">
                                        <h5 class="card-title">Ranga VIP</h5>
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
                        @endfor
                        @for ($i = 0; $i < 3; $i++)
                            <div class="col-12">
                                <div class="card service-card card-img-left shadow-sm">
                                    <img src="https://via.placeholder.com/500" class="card-img" alt="service-image">
                                    <div class="card-body">
                                        <div class="card-horizontal-header">
                                            <h5 class="card-title">Ranga VIP</h5>
                                            <p class="card-text">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias consequuntur debitis excepturi, fuga hic saepe sequi unde. Animi architecto earum est eveniet fugiat iusto.
                                            </p>
                                        </div>
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
                                        <div class="card-horizontal-footer">
                                            <a href="{{ route('service') }}" class="btn btn-success">
                                                <i class="fas fa-shopping-cart"></i> Wybierz
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
    
                    <nav class="pagination-nav" aria-label="Service section nav">
                        <ul class="pagination pagination-centered shadow-sm">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            @include('components.sidebar')
        </div>
    </div>
@endsection
