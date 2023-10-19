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
                <a class="btn btn-primary " role="button" href='tutor-sign-in'>Notify Student</a>
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
                                    <th style="text-align: center;">Subscription Fee</th>
                                    <th style="text-align: center;">Payment Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td style="text-align: center;">Adam</td>
                                    <td style="text-align: center;">A</td>
                                    <td style="text-align: center;">RM 45</td>
                                    <td style="text-align: center;">Pending</td>
                                    <td style="text-align: center;"><button class="btn btn-primary" type="button" style="margin-right: 10px;" data-bs-target="#manage-payment-details" data-bs-toggle="modal"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">2</td>
                                    <td style="text-align: center;">Hawa</td>
                                    <td style="text-align: center;">B</td>
                                    <td style="text-align: center;">RM 50</td>
                                    <td style="text-align: center;">Pending</td>
                                    <td style="text-align: center;"><button class="btn btn-primary" type="button" style="margin-right: 10px;"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">3</td>
                                    <td style="text-align: center;">Rina</td>
                                    <td style="text-align: center;">C</td>
                                    <td style="text-align: center;">RM 70</td>
                                    <td style="text-align: center;">Pending</td>
                                    <td style="text-align: center;"><button class="btn btn-primary" type="button" style="margin-right: 10px;"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align: center;"><strong>No</strong></td>
                                    <td style="text-align: center;"><strong>Student Name</strong></td>
                                    <td style="text-align: center;"><strong>Package</strong></td>
                                    <td style="text-align: center;"><strong>Subscription Fee</strong></td>
                                    <td style="text-align: center;"><strong>Payment Status</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
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
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="package-name" for="username"><strong>Student Name</strong></label>
                                    <p style="color: rgb(78,93,120);">Muhammad Adam</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Package</strong></label>
                                    <p style="color: rgb(78,93,120);">Package A</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Subject</strong></label>
                                    <ul>
                                        <li>Bahasa Melayu</li>
                                        <li>Bahasa Ikan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="package-name-1" for="username"><strong>Month</strong></label>
                                    <p style="color: rgb(78,93,120);">May 2023</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="email"><strong>Subscription Fee</strong></label>
                                    <p style="color: rgb(78,93,120);">RM 203</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="email"><strong>Payment Status</strong></label><select class="form-select" id="payment-status">
                                        <optgroup label="Choose your education level">
                                            <option value="Pending" selected="">Pending</option>
                                            <option value="Paid">Paid</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Cancel</button><button class="btn btn-primary" type="button">Update</button></div>
            </div>
        </div>
    </div>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>