<nav class="border-bottom" style="font-family: Calibri">
    <div class="d-flex flex-wrap">
        <ul class="nav me-auto">
            <li class="nav-item"><a href="mailto:tazesalgy@gmail.com" class="nav-link link-body-emphasis px-2 active" aria-current="page"><i class="bi-envelope-fill"></i> tazesalgy@gmail.com</a></li>
        </ul>
        @if(request()->routeIs(['home']))
        <div class="btn-group me-3 align-items-center">
            <span type="button" class="small dropdown-toggle" data-toggle="dropdown" data-bs-display="static">English - USD</span>
            <div class="dropdown-menu dropdown-menu-lg-end" style="border-radius: 0; min-width: 20em;">
                <div class="mx-3">
                    <h6 class="fw-bold">Region settings</h6>

                    <form method="POST" action="#">
                        @csrf
                        @honeypot
                        <div class="mb-3 mt-3">
                            <label for="language" class="form-label">Language</label>
                            <select class="form-select" name="language" id="language" style="border-radius: 0;" aria-label="Default select example">
                                @foreach(config('language') as $key => $lang)
                                <option value="{{ $key }}">{{ $lang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="currency" class="form-label">Currency</label>
                            <select class="form-select" name="currency" id="currency" style="border-radius: 0;">
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency['code'] }}">{{ $currency['symbol'] . ' - ' . $currency['code'] . ' ' . $currency['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary w-100" style="border-radius: 0;">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
        <div class="btn-group me-3 align-items-center">
            <span type="button" class="bi-person-circle dropdown-toggle" data-toggle="dropdown" data-bs-display="static"> </span>
            <div class="dropdown-menu dropdown-menu-lg-end" style="border-radius: 0; min-width: 20em;">
                <div class="mx-3 d-flex justify-content-center">
                    @auth('customer_web')
                        <form method="POST" action="{{ route('logout') }}" id="customerLogout">
                            @csrf
                            @honeypot
                        </form>
                        <div class="mb-3 mt-3 h6">
                            <div class="mb-3 fw-bold">Profile <i class="bi-patch-check-fill text-primary"></i></div>
                            <div class="mb-3"><i class="bi-person-fill-check"></i> {{ auth('customer_web')->user()['name'] }}</div>
                            <div class="mb-3"><i class="bi-phone-fill"></i> +993{{ auth('customer_web')->user()['phone'] }}</div>
                            <hr>
                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-primary rounded-5 w-100 mb-3" onclick="$('form#customerLogout').submit();">Sign out</a>
                        </div>
                    @elseguest('customer_web')
                        <div class="mb-3 mt-3">
                            <h6>Welcome back!</h6>
                            <a href="{{ route('login') }}" class="btn btn-sm btn-primary rounded-5 w-100 mb-3">Sign in</a>
                            <a href="{{ route('register') }}" class="btn btn-sm btn-outline-primary rounded-5 w-100 mb-3">Join now!</a>
                            <hr>
                            <small>By sliding to Continue with or Create My Account , I agree to Sebedim.com Free Membership Agreement and Receive Marketing Materials</small>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>
<header data-bs-theme="dark">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid d-flex row">
            <a class="navbar-brand col-2" href="#"><img src="{{ asset('img/sebedim.png') }}" alt=""></a>
            <div class="col-4">
                <form class="d-flex input-group" role="search">
                    <input type="text" class="form-control" style="border-color: #2eca6a" placeholder="Recipient's username" aria-label="Recipient's username">
                    <a class="input-group-text btn-success" style="border-color: #2eca6a"  href="#"><i class="bi-search"></i></a>
                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </nav>
</header>
