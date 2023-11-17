<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Subscription</span><br></h2>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Subscription list</p>
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
                                    <th>Student Name</th>
                                    <th style="text-align: center;">Education Level</th>
                                    <th style="text-align: center;">Package</th>
                                    <th style="text-align: center;">Subject Quantity</th>
                                    <th style="text-align: center;">Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentInfo as $student)
                                <tr>
                                    <td>{{$student -> user -> userName}}</td>
                                    @if ($student -> latestSubs)
                                        <td style="text-align: center;">{{$student -> latestSubs -> package -> educationLevel -> eduName}}</td>
                                        <td style="text-align: center;">{{$student -> latestSubs -> package -> packageName}}</td>
                                        <td style="text-align: center;">{{$student -> latestSubs -> package -> subjectQuantity}}</td>
                                        <td style="text-align: center;">{{$student -> latestSubs -> package -> packagePrice}}</td>
                                    @else
                                    <td style="text-align: center;">Not yet subscribe</td>                                      
                                    <td style="text-align: center;"></td>                                      
                                    <td style="text-align: center;"></td>                                      
                                    <td style="text-align: center;"></td>                                      
                                    @endif
                                    <td style="text-align: center;"><a class="btn btn-primary" role="button" href='subscription/{{$student -> userID}}'><i class="fas fa-info-circle" style="color: rgb(255,255,255);"></i>&nbsp;Details<span class="text-white-50 icon"></span></a></td>
                                    
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