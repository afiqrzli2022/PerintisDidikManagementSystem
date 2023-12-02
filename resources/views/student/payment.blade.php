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
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="true" aria-controls="accordion-1 .item-1">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-xl-2">Ref: 1234DF</div>
                                        <div class="col-md-4 col-xl-2">Pending</div>
                                        <div class="col-md-4 col-xl-2">RM 80</div>
                                        <div class="col-md-4 col-xl-">Date : 08/12/23</div>
                                        <div class="col-md-4 col-xl-2">Package A</div>
                                    </div>
                                </div>

                                </button>
                            </h2>
                            <div class="accordion-collapse collapse show item-1" role="tabpanel" data-bs-parent="#accordion-1">
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
                                                            <p style="color: rgb(78,93,120);">ABC</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Subscription Date</strong></label>
                                                            <p style="color: rgb(78,93,120);">11/02/2034</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div><label class="form-label" for="email" style="text-align: center;font-weight: bold;"><strong>Subscription</strong></label></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Package</strong></label>
                                                            <p style="color: rgb(78,93,120);">Mathematics Package</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Subject</strong></label>
                                                            <ul>
                                                                <li>Mathematics</li>
                                                                <li>Additional Mathematics</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Payment status</strong></label>
                                                            <p style="color: rgb(5,200,25);"><strong>Paid</strong></p>
                                                            <p style="color: rgb(78,93,120);"><strong>Pending</strong></p>
                                                            <p style="color: rgb(241,30,30);"><strong>Failed</strong></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Total</strong></label>
                                                            <p style="color: rgb(78,93,120);font-weight: bold;">RM 20</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3 d-flex justify-content-end"><a class="btn btn-primary btn-sm" role="button" href="payment-details.html">Pay Now</a></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">
                                
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-xl-2">Ref: 9421GB</div>
                                        <div class="col-md-4 col-xl-2">Paid</div>
                                        <div class="col-md-4 col-xl-2">RM 50</div>
                                        <div class="col-md-4 col-xl-">Date : 11/11/23</div>
                                        <div class="col-md-4 col-xl-2">Package B</div>
                                    </div>
                                </div>
                            
                                </button>
                            </h2>
                            <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
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
                                                            <p style="color: rgb(78,93,120);">ABC</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Subscription Date</strong></label>
                                                            <p style="color: rgb(78,93,120);">11/02/2034</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div><label class="form-label" for="email" style="text-align: center;font-weight: bold;"><strong>Subscription</strong></label></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Package</strong></label>
                                                            <p style="color: rgb(78,93,120);">Mathematics Package</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Subject</strong></label>
                                                            <ul>
                                                                <li>Mathematics</li>
                                                                <li>Additional Mathematics</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Payment status</strong></label>
                                                            <p style="color: rgb(5,200,25);"><strong>Paid</strong></p>
                                                            <p style="color: rgb(78,93,120);"><strong>Pending</strong></p>
                                                            <p style="color: rgb(241,30,30);"><strong>Failed</strong></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Total</strong></label>
                                                            <p style="color: rgb(78,93,120);font-weight: bold;">RM 20</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3 d-flex justify-content-end"><a class="btn btn-primary btn-sm" role="button" href="payment-details.html">Pay Now</a></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">

                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4 col-xl-2">Ref: 1283YZ</div>
                                        <div class="col-md-4 col-xl-2">Failed</div>
                                        <div class="col-md-4 col-xl-2">RM 12</div>
                                        <div class="col-md-4 col-xl-">Date : 02/23/23</div>
                                        <div class="col-md-4 col-xl-2">Package C</div>
                                    </div>
                                </div>

                                </button>
                            </h2>
                            <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
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
                                                            <p style="color: rgb(78,93,120);">ABC</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Subscription Date</strong></label>
                                                            <p style="color: rgb(78,93,120);">11/02/2034</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div><label class="form-label" for="email" style="text-align: center;font-weight: bold;"><strong>Subscription</strong></label></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="username"><strong>Package</strong></label>
                                                            <p style="color: rgb(78,93,120);">Mathematics Package</p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Subject</strong></label>
                                                            <ul>
                                                                <li>Mathematics</li>
                                                                <li>Additional Mathematics</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Payment status</strong></label>
                                                            <p style="color: rgb(5,200,25);"><strong>Paid</strong></p>
                                                            <p style="color: rgb(78,93,120);"><strong>Pending</strong></p>
                                                            <p style="color: rgb(241,30,30);"><strong>Failed</strong></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="mb-3"><label class="form-label" for="email"><strong>Total</strong></label>
                                                            <p style="color: rgb(78,93,120);font-weight: bold;">RM 20</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3 d-flex justify-content-end"><a class="btn btn-primary btn-sm" role="button" href="payment-details.html">Pay Now</a></div>
                                            </form>
                                        </div>
                                    </div>
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