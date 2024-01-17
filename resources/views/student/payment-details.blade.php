<!DOCTYPE html>
<html lang="en">

@include('frame.student-head')

<body>

    @include('frame.student-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Make Payment</span><br></h2>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-8 col-xl-10 offset-xl-1">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Enter your payment details</p>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="/student/payment-details">
                                        @csrf
                                        <div class="row">
                                            <div class="col-xl-12 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="card-holder"><strong>Cardholder Name</strong></label><input class="form-control" type="text" id="card-holder" placeholder="Cardholder Name" name="card-name" required></div>
                                                @if($errors->has('card-name'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('card-name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="card-number"><strong>Card Number</strong></label><input class="form-control" type="text" id="card-number" placeholder="Card Number" name="card-number" required></div>
                                                @if($errors->has('card-number'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('card-number') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 offset-xl-0">
                                                <div class="mb-3">
                                                    <label class="form-label" for="expiration-date"><strong>Expiration Date</strong></label>
                                                    <div class="row">
                                                        <div class="col-md-6">  
                                                            <input class="form-control mb-2" type="text" placeholder="MM" id="mm" name="mm" required>
                                                            @if($errors->has('mm'))
                                                                <div class="alert alert-danger">
                                                                    {{ $errors->first('mm') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">  
                                                            <input class="form-control" type="text" placeholder="YY" id="yy" name="yy" required>
                                                            @if($errors->has('yy'))
                                                                <div class="alert alert-danger">
                                                                    {{ $errors->first('yy') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="cvc"><strong>CVC</strong></label><input class="form-control" type="text" id="cvc" placeholder="CVC" name="cvc" required></div>
                                                @if($errors->has('cvc'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('cvc') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center"><img class="img-fluid m-3" src="{{ asset('img/illustrations/master-card.png') }}" style="width: 60px;"><img class="img-fluid m-3" src="{{ asset('img/illustrations/visa.png') }}" style="width: 60px;"></div>
                                        <div class="mb-3 d-flex justify-content-end"><a class="me-2" href='payment'>Cancel</a><button class="btn btn-primary btn-sm" type="submit">Pay</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>