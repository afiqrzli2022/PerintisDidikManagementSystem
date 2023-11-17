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
                                                <div class="mb-3"><label class="form-label" for="card-number"><strong>Card Number</strong></label><input class="form-control" type="text" id="card-number" name="card-number"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-6 offset-xl-0">
                                                <div class="mb-3">
                                                    <label class="form-label" for="expiration-date"><strong>Expiration Date</strong></label>
                                                    <div class="row">
                                                        <div class="col-md-6">  
                                                            <input class="form-control mb-2" type="text" id="mm" name="mm">
                                                        </div>
                                                        <div class="col-md-6">  
                                                            <input class="form-control" type="text" id="yy" name="yy">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 offset-xl-0">
                                                <div class="mb-3"><label class="form-label" for="cvc"><strong>CVC</strong></label><input class="form-control" type="text" id="cvc" name="cvc"></div>
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