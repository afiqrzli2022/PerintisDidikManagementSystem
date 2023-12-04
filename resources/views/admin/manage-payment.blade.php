<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Manage Payment</span><br></h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                <a class="btn btn-primary " role="button" href='notify-pending'>Notify Student</a>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Manage Payment</p>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                        <option value="10" selected="">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>&nbsp;</label></div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                        </div>
                    </div>
                    
                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Student Name</th>
                                    <th style="text-align: center;">Package</th>
                                    <th style="text-align: center;">Education Level</th>
                                    <th style="text-align: center;">Payment Date</th>
                                    <th style="text-align: center;">Subscription Fee</th>
                                    <th style="text-align: center;">Payment Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentInfo as $student)
                                    <tr>
                                        <td style="text-align: center;">{{ $loop->iteration}}</td>
                                        <td style="text-align: center;">{{ $student->user->userName }}</td>
                                        @if($student->latestSubs)
                                            <td style="text-align: center;">{{ $student->latestSubs->package->packageName }}</td>
                                            <td style="text-align: center;">{{ $student->latestSubs->package->educationLevel->eduName }}</td>
                                            @if ($student->latestSubs->pendingPayment)
                                                <td style="text-align: center;"></td>
                                                <td style="text-align: center;">{{ $student->latestSubs->pendingPayment->paymentPrice}}</td>
                                                <td style="text-align: center;">{{ $student->latestSubs->pendingPayment->paymentStatus }}</td>
                                                <td style="text-align: center;"><a class="btn btn-primary" id="detail-btn" type="button" style="margin-right: 10px;" href='manage-payment/{{$student -> userID}}'>Edit<span class="text-white-50 icon"></span></a></td>
                                                @elseif($student->latestSubs->latestPayment)
                                                <td style="text-align: center;">{{ $student->latestSubs->latestPayment->paymentDate ? \Carbon\Carbon::parse($student->latestSubs->latestPayment->paymentDate)->format('d/m/y') : '' }}</td> 
                                                <td style="text-align: center;">{{ $student->latestSubs->latestPayment->paymentPrice}}</td>
                                                <td style="text-align: center;">{{ $student->latestSubs->latestPayment->paymentStatus }}</td>
                                                <td style="text-align: center;"><a class="btn btn-primary" id="detail-btn" type="button" style="margin-right: 10px;" href='manage-payment/{{$student -> userID}}'>View<span class="text-white-50 icon"></span></a></td>
                                            @endif
                                        @else
                                            <td style="text-align: center;">Not yet subscribe</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 3 of 3</p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" aria-label="Previous" href="#"><span aria-hidden="true">«</span></a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span aria-hidden="true">»</span></a></li>
                                </ul>
                            </nav>
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