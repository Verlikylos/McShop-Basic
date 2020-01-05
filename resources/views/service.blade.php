@extends('components.layout')

@section('content')
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <img class="img-fluid rounded shadow-sm" src="https://via.placeholder.com/500" alt="service image">
                    <h5 class="mt-3">Koszt usługi:</h5>
                    <ul class="list-group service-pricing-table shadow-sm">
                        <li class="list-group-item">
                            <span>
                                <i class="fas fa-mobile-alt fa-fw"></i> SMS Premium:
                            </span>
                            <span class="badge badge-primary">11,07 zł</span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                <i class="fas fa-lock fa-fw"></i> PaySafeCard:
                            </span>
                            <span class="badge badge-primary">11,00 zł</span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                <i class="fas fa-credit-card fa-fw"></i> Przelew:
                            </span>
                            <span class="badge badge-primary">10,00 zł</span>
                        </li>
                        <li class="list-group-item">
                            <span>
                                <i class="fab fa-paypal fa-fw"></i> PayPal:
                            </span>
                            <span class="badge badge-primary">10,00 zł</span>
                        </li>
                    </ul>
                    <h5 class="mt-3">Ostatnio tą usługę zakupili:</h5>
                    <div class="service-last-customers">
                        @for ($i = 0; $i < 8; $i++)
                            <img class="avatar shadow-sm" src="https://crafatar.com/avatars/61296cbd20144ebebfd38695b2a864b3" alt="player head" data-toggle="tooltip" data-placement="top" title="Verlikylos">
                        @endfor
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <h3>Ranga VIP</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur convallis nibh a justo iaculis, nec suscipit sapien semper. Nam feugiat felis id est tristique aliquam. Vivamus luctus pellentesque tempus. Etiam sodales venenatis libero sed consectetur. Phasellus et lectus nulla. Mauris dictum scelerisque iaculis. Pellentesque ornare condimentum elit, sed laoreet risus tempor vel. Vivamus diam turpis, blandit congue neque eget, faucibus convallis purus. Aenean mattis sapien scelerisque, condimentum mi et, aliquet metus. Proin non ultrices diam. Quisque dui magna, ullamcorper non vehicula sit amet, dignissim quis dui. Donec accumsan volutpat massa, non scelerisque mauris laoreet id.
                    </p>
                    <p>
                        In nec hendrerit neque. Pellentesque ultricies rutrum pulvinar. Maecenas eget augue nulla. Donec tincidunt massa id lorem mattis, eu convallis ipsum aliquam. Mauris blandit mauris sed mollis scelerisque. Quisque et volutpat tortor. Mauris ultrices purus orci, eget blandit metus luctus a. Maecenas ut mauris lectus. Nullam vel nulla feugiat, pharetra augue ac, luctus dui. Phasellus et purus lobortis, eleifend velit ut, tempus quam. Curabitur faucibus tristique tincidunt. Cras hendrerit auctor diam, nec feugiat enim blandit at. Maecenas ac erat ac quam feugiat posuere sed et ex. Quisque bibendum nibh non metus bibendum placerat. Phasellus euismod vitae nunc id varius. Suspendisse eget neque id nunc tincidunt auctor.
                    </p>
                    <p>
                        Sed tincidunt, risus eget posuere volutpat, eros sem eleifend ipsum, a suscipit odio velit et augue. Phasellus diam nulla, tempus in risus vitae, faucibus posuere justo. Sed nec pulvinar eros. Cras condimentum fringilla vestibulum. Mauris tincidunt nulla a sagittis bibendum. Mauris maximus vitae dui at sagittis. Cras vel enim a nisi dictum tristique. Donec mi mi, sodales at varius quis, semper eget nulla. Sed scelerisque dolor id dictum tincidunt. Vivamus semper, leo ac imperdiet accumsan, justo quam tristique nulla, et mollis velit nibh eget ante. Integer viverra dapibus orci, id tempor dolor commodo sit amet. Pellentesque ut tempor mi. Mauris a justo id lorem fermentum posuere quis at urna.
                    </p>
                    <p>
                        Nam libero quam, porttitor nec egestas tempor, molestie sed enim. Maecenas pretium magna ut velit efficitur, non tincidunt quam convallis. Sed ultricies dignissim metus, non vestibulum nisl scelerisque vitae. Sed massa ligula, interdum vel eleifend vitae, pretium a dui. Cras id tristique est, at eleifend ex. Quisque vel accumsan felis. Aenean id posuere ligula. Nam venenatis nibh ac consequat bibendum. Phasellus id elementum lacus. Cras a justo nec orci placerat consectetur. Fusce vulputate elit ut enim molestie lacinia. Mauris a justo id lorem fermentum posuere quis at urna. Phasellus euismod vitae nunc id varius. Suspendisse eget neque id nunc tincidunt auctor.
                    </p>
                </div>
            </div>
    
            <div id="servicePaymentTabs" class="shadow-sm">
                <ul class="nav nav-pills nav-fill" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-sms-tab" data-toggle="pill" href="#sms-tab" role="tab" aria-controls="sms-tab" aria-selected="true">
                            <i class="fas fa-mobile-alt"></i> SMS Premium
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-psc-tab" data-toggle="pill" href="#psc-tab" role="tab" aria-controls="psc-tab" aria-selected="false">
                            <i class="fas fa-lock"></i> PaySafeCard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-transfer-tab" data-toggle="pill" href="#transfer-tab" role="tab" aria-controls="transfer-tab" aria-selected="false">
                            <i class="fas fa-credit-card"></i> Przelew
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-paypal-tab" data-toggle="pill" href="#paypal-tab" role="tab" aria-controls="paypal-tab" aria-selected="false">
                            <i class="fab fa-paypal"></i> PayPal
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="sms-tab" role="tabpanel" aria-labelledby="pills-sms-tab">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                <h4>
                                    <i class="fas fa-mobile-alt"></i> Płatność SMS Premium
                                </h4>
                                <span class="badge badge-primary">
                                    Koszt: 10,00 zł (11,07 zł z VAT)
                                </span>
                                
                                <p class="service-payment-cta">
                                    Aby aktywować usługę, wyślij SMS o treści<br />
                                    <span class="font-weight-bold">AP.HOSTMC</span> pod numer <span class="font-weight-bold">76068</span>.<br />
                                    Otrzymany kod wprowadź poniżej:
                                </p>
    
                                <form>
                                    <div class="form-group">
                                        <label for="username">Twój nick z serwera</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Kod z SMS</label>
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Kod z SMS">
                                    </div>
                                    
                                    <button class="btn btn-success">Zrealizuj usługę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="psc-tab" role="tabpanel" aria-labelledby="pills-psc-tab">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                <h4>
                                    <i class="fas fa-lock"></i> Płatność PaySafeCard
                                </h4>
                                <span class="badge badge-primary">
                                    Koszt: 11,00 zł
                                </span>
    
                                <p class="service-payment-cta">
                                    Aby aktywować usługę,<br />
                                    wpisz poniżej swój nick z serwera i przejdź dalej.
                                </p>
    
                                <form>
                                    <div class="form-group">
                                        <label for="username">Twój nick z serwera</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                    </div>
        
                                    <button class="btn btn-success">Zrealizuj usługę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="transfer-tab" role="tabpanel" aria-labelledby="pills-transfer-tab">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                <h4>
                                    <i class="fas fa-credit-card"></i> Płatność przelewem
                                </h4>
                                <span class="badge badge-primary">
                                    Koszt: 10,00 zł
                                </span>
    
                                <p class="service-payment-cta">
                                    Aby aktywować usługę,<br />
                                    wpisz poniżej swój nick z serwera i przejdź dalej.
                                </p>
    
                                <form>
                                    <div class="form-group">
                                        <label for="username">Twój nick z serwera</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                    </div>
        
                                    <button class="btn btn-success">Zrealizuj usługę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="paypal-tab" role="tabpanel" aria-labelledby="pills-paypal-tab">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4 mx-auto">
                                <h4>
                                    <i class="fab fa-paypal"></i> Płatność PayPal
                                </h4>
                                <span class="badge badge-primary">
                                    Koszt: 10,00 zł
                                </span>
    
                                <p class="service-payment-cta">
                                    Aby aktywować usługę,<br />
                                    wpisz poniżej swój nick z serwera i przejdź dalej.
                                </p>
    
                                <form>
                                    <div class="form-group">
                                        <label for="username">Twój nick z serwera</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="Twój nick z serwera">
                                    </div>
        
                                    <button class="btn btn-success">Zrealizuj usługę</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
