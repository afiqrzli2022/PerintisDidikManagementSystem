<!DOCTYPE html>
<html lang="en">

@include('frame.student-head')

<body>

    @include('frame.student-navbar')

    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Invoice</span><br></h2>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-md-8 col-xl-12 mx-auto">
                    <div class="accordion text-muted" role="tablist" id="accordion-1">
                        <div class="card shadow mb-3">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Latest Invoice Details</p>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Invoice Number</strong></label>
                                                <p style="color: rgb(78,93,120);">{{Auth::user() -> student -> latestSubs -> onePayment -> paymentID}}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Subscription Date</strong></label>
                                                <p style="color: rgb(78,93,120);">{{\Carbon\Carbon::parse(Auth::user() -> student -> latestSubs -> subscribeDate )->format('d/m/y') }} ({{\Carbon\Carbon::parse(Auth::user() -> student -> latestSubs -> subscribeDate )->format('F')}})</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Package</strong></label>
                                                <p style="color: rgb(78,93,120);">{{Auth::user() -> student -> latestSubs -> package -> packageName}} ({{Auth::user() -> student -> latestSubs -> package -> educationLevel -> eduName}})</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Subject ({{Auth::user() -> student -> latestSubs ->package -> subjectQuantity}} subject)</strong></label>
                                                <ul>
                                                    @foreach(Auth::user() -> student -> latestSubs -> subject as $subject)
                                                        <li>{{$subject->subjectName}}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment status</strong></label>
                                                @if(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus == 'Paid')
                                                <p style="color: rgb(5,200,25);"><strong>Paid</strong></p>
                                                @elseif(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus == 'Pending')
                                                <p style="color: rgb(255,116,23);"><strong>Pending</strong></p>
                                                @elseif(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus == 'Failed')
                                                <p style="color: rgb(241,30,30);"><strong>Failed</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Total Price</strong></label>
                                                <p style="color: rgb(78,93,120);font-weight: bold;">RM {{Auth::user() -> student -> latestSubs -> onePayment -> paymentPrice}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus !== 'Pending')
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment Date</strong></label>
                                                <p style="color: rgb(78,93,120);">{{\Carbon\Carbon::parse(Auth::user() -> student -> latestSubs -> onePayment -> paymentDate )->format('d/m/y')}}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment Amount</strong></label>
                                                @if(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus == 'Paid')
                                                <p style="color: rgb(78,93,120);">RM {{Auth::user() -> student -> latestSubs -> onePayment -> paymentAmount}}</p>
                                                @elseif(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus == 'Failed')
                                                <p style="color: rgb(78,93,120);">RM 0</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment Method</strong></label>
                                                <p style="color: rgb(78,93,120);">{{Auth::user() -> student -> latestSubs -> onePayment -> paymentMethod}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(Auth::user() -> student -> latestSubs -> onePayment -> paymentStatus == 'Pending')
                                    <hr>
                                    <div class="mb-3 d-flex justify-content-end"><a class="btn btn-primary btn-sm" role="button" href='payment-details'>Pay Now</a></div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        @foreach(Auth::user() -> student -> latestSubs -> payment as $payment)
                            @if($payment != Auth::user() -> student -> latestSubs -> onePayment)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-{{ $loop->iteration }}" aria-expanded="false" aria-controls="accordion-1 .item-{{ $loop->iteration }}">

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4 col-xl-4"><p style="font-size: 0.7em;">Ref: {{$payment -> paymentID}}</p></div>
                                                <div class="col-md-4 col-xl-2">
                                                @if($payment -> paymentStatus == 'Paid')
                                                    <p style="font-size: 0.8em;color: rgb(5,200,25);">Paid</p>
                                                @elseif($payment -> paymentStatus == 'Failed')
                                                    <p style="font-size: 0.8em;color: rgb(241,30,30);">Failed</p>
                                                @endif
                                                </div>
                                                <div class="col-md-4 col-xl-2"><p style="font-size: 0.8em;">RM {{$payment -> paymentPrice}}</p></div>
                                                <div class="col-md-4 col-xl-2"><p style="font-size: 0.8em;">Date : {{\Carbon\Carbon::parse($payment -> paymentDate )->format('d/m/y')}}</p></div>
                                                <div class="col-md-4 col-xl-2"><p style="font-size: 0.8em;">{{$payment -> package -> packageName}}</p></div>
                                            </div>
                                        </div>

                                        </button>
                                    </h2>
                                    <div class="accordion-collapse collapse item-{{ $loop->iteration }}" role="tabpanel" data-bs-parent="#accordion-1">
                                        <div class="accordion-body">
                                            <div class="card shadow mb-3">
                                                <div class="card-header py-3">
                                                    <p class="text-primary m-0 fw-bold">Invoice Details</p>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="username"><strong>Invoice Number</strong></label>
                                                                    <p style="color: rgb(78,93,120);">{{$payment -> paymentID}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="email"><strong>Subscription Date</strong></label>
                                                                    <p style="color: rgb(78,93,120);">{{\Carbon\Carbon::parse($payment -> subscription -> subscribeDate )->format('d/m/y')}} ({{\Carbon\Carbon::parse($payment -> subscription -> subscribeDate )->format('F')}})</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="username"><strong>Package</strong></label>
                                                                    <p style="color: rgb(78,93,120);">{{$payment -> package -> packageName}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="email"><strong>Payment status</strong></label>
                                                                    @if($payment -> paymentStatus == 'Paid')
                                                                    <p style="color: rgb(5,200,25);"><strong>Paid</strong></p>
                                                                    @elseif($payment -> paymentStatus == 'Failed')
                                                                    <p style="color: rgb(241,30,30);"><strong>Failed</strong></p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="email"><strong>Total Price</strong></label>
                                                                    <p style="color: rgb(78,93,120);font-weight: bold;">RM {{$payment -> paymentPrice}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="email"><strong>Payment Date</strong></label>
                                                                    <p style="color: rgb(78,93,120);">{{\Carbon\Carbon::parse($payment -> paymentDate )->format('d/m/y')}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="email"><strong>Payment Amount</strong></label>
                                                                    @if($payment -> paymentStatus == 'Paid')
                                                                    <p style="color: rgb(78,93,120);">RM {{$payment -> paymentAmount}}</p>
                                                                    @elseif($payment -> paymentStatus == 'Failed')
                                                                    <p style="color: rgb(78,93,120);">RM 0</p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="mb-3"><label class="form-label" for="email"><strong>Payment Method</strong></label>
                                                                    <p style="color: rgb(78,93,120);">{{$payment -> paymentMethod}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>