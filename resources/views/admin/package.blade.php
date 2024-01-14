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
            @if($errors->has('packageID'))
                <div class="alert alert-danger">
                    {{ $errors->first('packageID') }}
                </div>
            @endif
            @if($errors->has('packageName'))
                <div class="alert alert-danger">
                    {{ $errors->first('packageName') }}
                </div>
            @endif
            @if($errors->has('subjectQuantity'))
                <div class="alert alert-danger">
                    {{ $errors->first('subjectQuantity') }}
                </div>
            @endif
            @if($errors->has('packagePrice'))
                <div class="alert alert-danger">
                    {{ $errors->first('packagePrice') }}
                </div>
            @endif
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Package list</p>
                </div>
                <div class="card-body">
                    <div class="row"  style="display:none">
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
                                @foreach ($packages as $package)
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration}}</td>
                                    <td style="text-align: center;">{{ $package->packageID}}</td>
                                    <td style="text-align: center;">{{ $package->packageName}}</td>
                                    <td style="text-align: center;">{{ $package->subjectQuantity}}</td>
                                    <td style="text-align: center;">{{ $package->packagePrice}}</td>
                                    <td style="text-align: center;">{{ $package->educationLevel->eduID}}</td>
                                    <td style="text-align: center;">
                                        <button class="btn btn-primary" type="button" style="margin-right: 10px;" data-bs-target="#edit-package" data-bs-toggle="modal" 
                                        onclick="handleEditButtonClickPackage('{{ $package->packageID }}' , '{{$package->packageName}}' , '{{$package->packagePrice}}' , '{{$package->subjectQuantity}}' , '{{$package->educationLevel->eduID}}')">
                                            <i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span>
                                        </button>
                                        <button class="btn btn-primary" type="button" style="background: var(--bs-red);border-style: none;"
                                        onclick="confirmDeletePackage('{{ $package->packageID }}')">
                                            <i class="fas fa-trash-alt" style="color: rgb(255,255,255);"></i>&nbsp;Delete<span class="text-white-50 icon"></span>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <div class="row"  style="display:none">
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
                    <form action="{{ url('/admin/package') }}" method="POST" id="addPackage">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" id="package-name-1" for="packageID"><strong>Package ID</strong></label>
                                    <input class="form-control" type="text" id="package-name" name="packageID"  placeholder="Ex: SPM01">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" id="package-name" for="username"><strong>Package Name</strong></label>
                                    <input class="form-control" type="text" id="package-name" name="packageName"  placeholder="Ex: Pakej 2  ">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email"><strong>Subject Quantity</strong></label>
                                    <input class="form-control" type="number" id="package-name" name="subjectQuantity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="first_name"><strong>Price (RM)</strong></label>
                                    <input class="form-control" type="text" id="package-name" name="packagePrice"  placeholder="Ex: 90">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="last_name"><strong>Education Level</strong></label>
                                    <select class="form-select" id="package-name" name="eduID">
                                        <optgroup label="Choose your education level">
                                            @foreach($educationLevels as $eduID => $eduName)
                                                <option value="{{$eduID}}">{{$eduName}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="reset" form="addPackage">Clear</button>
                    <button class="btn btn-primary" type="submit" form="addPackage">Add</button></div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-package">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit package</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-package-form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" id="package-name-1" for="packageID"><strong>Package ID</strong></label>
                                    <input class="form-control" type="text" id="packageID" name="packageID">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" id="package-name-1" for="username"><strong>Package Name</strong></label>
                                    <input class="form-control" type="text" id="packageName" name="packageName">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="package-name-1"><strong>Quantity</strong></label>
                                    <input class="form-control" type="number" id="subjectQuantity" name="subjectQuantity">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="package-name-1"><strong>Price (RM)</strong></label>
                                    <input class="form-control" type="text" id="packagePrice" name="packagePrice">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="last_name"><strong>Education Level</strong></label>
                                    <select class="form-select" id="eduID" name="eduID">
                                        <optgroup label="Choose your education level">
                                            @foreach($educationLevels as $eduID => $eduName)
                                                <option value="{{$eduID}}">{{$eduName}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="reset" data-bs-dismiss="modal">Clear</button>
                    <button class="btn btn-primary" type="submit" onclick="document.getElementById('edit-package-form').submit()">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!---->

    <!--Delete-->
    <form id="delete-form-package" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    <!---->

    @include('frame.footer')

    @include('frame.script')

</body>

</html>