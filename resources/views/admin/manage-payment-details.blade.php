<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    <nav class="navbar navbar-dark navbar-expand-md sticky-top bg-primary navbar-shrink py-3" id="mainNav">
        <div class="container"><a class="navbar-brand d-flex align-items-center" href='home'><span class="bs-icon-sm bs-icon-circle bs-icon-white shadow d-flex justify-content-center align-items-center me-2 bs-icon" style="color: rgb(255,255,255);"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-mortarboard-fill">
                        <path fill-rule="evenodd" d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"></path>
                        <path fill-rule="evenodd" d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"></path>
                    </svg></span><span>Perintis Didik System</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href='../home'><i class="fas fa-home"></i><span>&nbsp;<strong>Home</strong></span></a></li>
                    <li class="nav-item"><a class="nav-link" href='../manage-payment'><i class="fas fa-money-check-alt"></i><span>&nbsp;<strong>Payment</strong></span></a></li>
                    <li class="nav-item"><a class="nav-link" href='../service'><i class="fas fa-wrench"></i><span>&nbsp;<strong>Service</strong></span></a></li>
                    <li class="nav-item"><a class="nav-link" href='../profile'><i class="fas fa-user"></i><span>&nbsp;Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href='{{route('logout')}}'><i class="fas fa-sign-out-alt"></i><span>&nbsp;Sign out</span></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Subscription Details</span><br></h2>
                </div>
            </div>
            @if ($studentDetail->latestSubs->pendingPayment)
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <form method="post"  onsubmit="return confirm('{{$studentDetail->user->userName}} payment status will turn to Paid');">
                        @csrf
                        <button class="btn btn-primary " role="submit">Turn to Paid</button>
                    </form>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Student Details</p>
                        </div>
                        <div class="card-body">
                            <div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Full Name</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> user -> userName}}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>IC Number</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> userID}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Phone Number</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> user -> userNumber}}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Email</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> user -> userEmail}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Guardian Name</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> guardianName}}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Guardian Phone Number</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> guardianNumber}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Address</strong></label>
                                                <p style="color: rgb(78,93,120);">{{ $studentDetail -> studentAddress}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Package&nbsp;</strong></label>
                                                <p style="color: rgb(78,93,120);">
                                                    @if ($studentDetail -> latestSubs)
                                                        {{ $studentDetail -> latestSubs -> package -> packageName}} ({{ $studentDetail -> latestSubs -> package -> educationLevel -> eduName}})
                                                    @else
                                                        No subscription yet
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Subject Taken</strong></label>
                                                <p style="color: rgb(78,93,120);">
                                                    @if ($studentDetail -> latestSubs)
                                                        {{$studentDetail -> latestSubs -> package -> subjectQuantity}} Subjects
                                                    @else
                                                        No subject taken yet
                                                    @endif
                                                </p>
                                                <ul>
                                                    @if ($studentDetail -> latestSubs)
                                                        @foreach ($studentDetail -> latestSubs -> subject as $subject)
                                                            <li>{{$subject->subjectName}}</li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($studentDetail -> latestSubs)
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="username"><strong>Subscription Date</strong></label>
                                                <p style="color: rgb(78,93,120);">
                                                    {{$studentDetail -> latestSubs -> subscribeDate}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment status</strong></label>
                                                @if($studentDetail -> latestSubs -> onePayment -> paymentStatus == 'Paid')
                                                <p style="color: rgb(5,200,25);"><strong>Paid</strong></p>
                                                @elseif($studentDetail -> latestSubs -> onePayment -> paymentStatus == 'Pending')
                                                <p style="color: rgb(255,116,23);"><strong>Pending</strong></p>
                                                @elseif($studentDetail -> latestSubs -> onePayment -> paymentStatus == 'Failed')
                                                <p style="color: rgb(241,30,30);"><strong>Failed</strong></p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Total Price</strong></label>
                                                <p style="color: rgb(78,93,120);font-weight: bold;">RM {{$studentDetail -> latestSubs -> onePayment -> paymentPrice}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @if($studentDetail -> latestSubs -> onePayment -> paymentStatus !== 'Pending')
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment Date</strong></label>
                                                <p style="color: rgb(78,93,120);">{{\Carbon\Carbon::parse($studentDetail -> latestSubs -> onePayment -> paymentDate )->format('d/m/y')}}</p>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment Amount</strong></label>
                                                @if($studentDetail -> latestSubs -> onePayment -> paymentStatus == 'Paid')
                                                <p style="color: rgb(78,93,120);">RM {{$studentDetail -> latestSubs -> onePayment -> paymentAmount}}</p>
                                                @elseif($studentDetail -> latestSubs -> onePayment -> paymentStatus == 'Failed')
                                                <p style="color: rgb(78,93,120);">RM 0</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3"><label class="form-label" for="email"><strong>Payment Method</strong></label>
                                                <p style="color: rgb(78,93,120);">{{$studentDetail -> latestSubs -> onePayment -> paymentMethod}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
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