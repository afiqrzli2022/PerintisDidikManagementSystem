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
                    <div class="row mb-3 d-none">
                        <div class="col">
                            <div class="card text-white bg-primary shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-success shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <div class="mb-3"><label class="form-label" for="card-number"><strong>Card Number</strong></label><input class="form-control" type="text" id="card-number" name="card-number"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="expiration-date"><strong>Expiration Date</strong></label><input class="form-control mb-2" type="text" id="mm" name="mm"><input class="form-control" type="text" id="yy" name="yy"></div>
                                            </div>
                                            <div class="col-xl-6 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="cvc"><strong>CVC</strong></label><input class="form-control" type="text" id="cvc" name="cvc"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="name-card"><strong>Name on card</strong></label><input class="form-control" type="text" id="name-card" name="name-card"></div>
                                            </div>
                                        </div>
                                        <div class="text-center"><img class="img-fluid m-3" src="{{ asset('img/illustrations/master-card.png') }}" style="width: 60px;"><img class="img-fluid m-3" src="{{ asset('img/illustrations/visa.png') }}" style="width: 60px;"><img class="img-fluid m-3" src="{{ asset('img/illustrations/touch-n-go.png') }}" style="width: 60px;"><img class="img-fluid m-3" src="{{ asset('img/illustrations/maybank.png') }}" style="width: 100px;"><img class="img-fluid m-3" src="{{ asset('img/illustrations/bank-islam.png') }}" style="width: 100px;"></div>
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