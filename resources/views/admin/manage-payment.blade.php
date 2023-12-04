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
                                                <td style="text-align: center;"><button class="btn btn-primary" id="detail-btn" type="button" style="margin-right: 10px;" data-bs-target="#manage-payment-details" data-bs-toggle="modal" data-student-id="{{ $student->userID }}"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button></td>
                                                @elseif($student->latestSubs->latestPayment)
                                                <td style="text-align: center;">{{ $student->latestSubs->latestPayment->paymentDate ? \Carbon\Carbon::parse($student->latestSubs->latestPayment->paymentDate)->format('d/m/y') : '' }}</td> 
                                                <td style="text-align: center;">{{ $student->latestSubs->latestPayment->paymentPrice}}</td>
                                                <td style="text-align: center;">{{ $student->latestSubs->latestPayment->paymentStatus }}</td>
                                                <td style="text-align: center;"><button class="btn btn-primary" id="detail-btn" type="button" style="margin-right: 10px;opacity: 0"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button></td>
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
    
    <div class="modal fade" role="dialog" tabindex="-1" id="manage-payment-details">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Payment</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" method="post">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="userName"><strong>Student Name</strong></label>
                                    <p style="color: rgb(78,93,120);"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="packageName"><strong>Package</strong></label>
                                    <p style="color: rgb(78,93,120);"></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="eduLevel"><strong>Education Level</strong></label>
                                    <p style="color: rgb(78,93,120);"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" ><strong>Subject</strong></label>
                                    <ul id="subject"> 

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="month"><strong>Month</strong></label>
                                    <p style="color: rgb(78,93,120);"></p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="fee"><strong>Subscription Fee</strong></label>
                                    <p style="color: rgb(78,93,120);"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="email"><strong>Payment Status</strong></label><select class="form-select" name="paymentStatus">
                                        <optgroup label="Choose status">
                                            <option value="Pending">Pending</option>
                                            <option value="Paid">Paid</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                        </div>
                        <input type="hidden" id="paymentID" name="paymentID">
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="submit" form="updateForm">Update</button></div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#detail-btn').click(function () {
                const studentID = $(this).data('student-id');
                $.ajax({
                    method: 'GET',
                    url: '/admin/manage-payment/'+ studentID,
                    success: function(data) {
                        // Populate the form fields with retrieved data
                        $('#userName').next('p').text(data.userName);
                        $('#packageName').next('p').text(data.student.latest_subs.package.packageName); 
                        $('#eduLevel').next('p').text(data.student.latest_subs.package.eduID);
                        $('#subscription-fee').text(data.subscriptionFee);
                        $('#month').next('p').text(data.student.latest_subs.subscribeDate);
                        $('#fee').next('p').text('RM '+data.student.latest_subs.package.packagePrice);
                        $('#paymentID').val(data.student.latest_subs.one_payment.paymentID);
                        //console.error(JSON.stringify(data));
                        
                        // Assuming data is the received JSON object
                        var subjects = data.student.latest_subs.subject;

                        // Displaying subject names
                        var subjectsList = $('#subject');
                        subjectsList.empty(); // Clear existing list items if any

                        subjects.forEach(function(subject) {
                            subjectsList.append('<li>' + subject.subjectName + '</li>');
                        });
                    
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
        </script>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>