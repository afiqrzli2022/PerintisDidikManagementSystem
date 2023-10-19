<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Package</span><br></h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto"><button class="btn btn-primary" type="button" data-bs-target="#add-package" data-bs-toggle="modal"><i class="fas fa-plus" style="color: rgb(255,255,255);"></i>&nbsp;Add<span class="text-white-50 icon"></span></button></div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Package list</p>
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
                                    <th style="text-align: center;">ID</th>
                                    <th style="text-align: center;">Package Name</th>
                                    <th style="text-align: center;">Subject Quantity</th>
                                    <th style="text-align: center;">Price</th>
                                    <th style="text-align: center;">Education Level</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align: center;">1</td>
                                    <td style="text-align: center;">P01</td>
                                    <td style="text-align: center;">A</td>
                                    <td style="text-align: center;">1</td>
                                    <td style="text-align: center;">RM 45</td>
                                    <td style="text-align: center;">UPSR</td>
                                    <td style="text-align: center;"><button class="btn btn-primary" type="button" style="margin-right: 10px;" data-bs-target="#edit-package" data-bs-toggle="modal"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button><button class="btn btn-primary" type="button" style="background: var(--bs-red);border-style: none;"><i class="fas fa-trash-alt" style="color: rgb(255,255,255);"></i>&nbsp;Delete<span class="text-white-50 icon"></span></button></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">2</td>
                                    <td style="text-align: center;">P02</td>
                                    <td style="text-align: center;">B</td>
                                    <td style="text-align: center;">5</td>
                                    <td style="text-align: center;">RM 50</td>
                                    <td style="text-align: center;">SPM</td>
                                    <td style="text-align: center;"><button class="btn btn-primary" type="button" style="margin-right: 10px;"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button><button class="btn btn-primary" type="button" style="background: var(--bs-red);border-style: none;"><i class="fas fa-trash-alt" style="color: rgb(255,255,255);"></i>&nbsp;Delete<span class="text-white-50 icon"></span></button></td>
                                </tr>
                                <tr>
                                    <td style="text-align: center;">3</td>
                                    <td style="text-align: center;">P03</td>
                                    <td style="text-align: center;">C</td>
                                    <td style="text-align: center;">7</td>
                                    <td style="text-align: center;">RM 70</td>
                                    <td style="text-align: center;">PT3</td>
                                    <td style="text-align: center;"><button class="btn btn-primary" type="button" style="margin-right: 10px;"><i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button><button class="btn btn-primary" type="button" style="background: var(--bs-red);border-style: none;"><i class="fas fa-trash-alt" style="color: rgb(255,255,255);"></i>&nbsp;Delete<span class="text-white-50 icon"></span></button></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align: center;"><strong>No</strong></td>
                                    <td style="text-align: center;"><strong>ID</strong></td>
                                    <td style="text-align: center;"><strong>Package Name</strong></td>
                                    <td style="text-align: center;"><strong>Subject Quantity</strong></td>
                                    <td style="text-align: center;"><strong>Price</strong></td>
                                    <td style="text-align: center;"><strong>Education Level Name</strong></td>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="add-package">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add package</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="package-name" for="username"><strong>Package Name</strong></label><input class="form-control" type="text" id="package-name" value="" name="package-name"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="email"><strong>Quantity</strong></label><input class="form-control" type="number" id="quantity" name="quantity"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Price (RM)</strong></label><input class="form-control" type="text" id="price" name="price"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Education Level</strong></label><select class="form-select">
                                        <optgroup label="Choose your education level">
                                            <option value="SPM" selected="">SPM</option>
                                            <option value="PT3">PT3</option>
                                            <option value="UPSR">UPSR</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="reset" data-bs-dismiss="modal">Clear</button><button class="btn btn-primary" type="button">Update</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-package">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit package</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="package-name-1" for="username"><strong>Package Name</strong></label><input class="form-control" type="text" id="package-name-2" value="A" name="package-name"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="email"><strong>Quantity</strong></label><input class="form-control" type="number" id="quantity-1" name="quantity" value="1"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Price (RM)</strong></label><input class="form-control" type="text" id="price-1" name="price" value="45"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Education Level</strong></label><select class="form-select">
                                        <optgroup label="Choose your education level">
                                            <option value="SPM" selected="">SPM</option>
                                            <option value="PT3">PT3</option>
                                            <option value="UPSR" selected="">UPSR</option>
                                        </optgroup>
                                    </select></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="reset" data-bs-dismiss="modal">Clear</button><button class="btn btn-primary" type="button">Update</button></div>
            </div>
        </div>
    </div>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>