<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Subject</span><br></h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto"><button class="btn btn-primary" type="button" data-bs-target="#add-subject" data-bs-toggle="modal"><i class="fas fa-plus" style="color: rgb(255,255,255);"></i>&nbsp;Add<span class="text-white-50 icon"></span></button></div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Subject list</p>
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
                                    <th style="text-align: center;">Subject Name</th>
                                    <th style="text-align: center;">Time</th>
                                    <th style="text-align: center;">Day</th>
                                    <th style="text-align: center;">Duration</th>
                                    <th style="text-align: center;">Education Level</th>
                                    <th style="text-align: center;">Tutor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subjects as $subject)
                                    <tr>
                                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                                        <td style="text-align: center;">{{ $subject->subjectID }}</td>
                                        <td style="text-align: center;">{{ $subject->subjectName }}</td>
                                        <td style="text-align: center;">{{ $subject->time }}</td>
                                        <td style="text-align: center;">{{ $subject->day }}</td>
                                        <td style="text-align: center;">{{ $subject->duration }}</td>
                                        <td style="text-align: center;">{{ $subject->educationLevel->eduID }}</td>
                                        <td style="text-align: center;">{{ $subject->tutor->user->userName }}</td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-primary" type="button" style="margin-right: 10px;" data-bs-target="#edit-subject" data-bs-toggle="modal">
                                            <i class="fas fa-edit" style="color: rgb(255,255,255);"></i>&nbsp;Edit<span class="text-white-50 icon"></span></button>
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-primary" type="button" style="background: var(--bs-red);border-style: none;">
                                            <i class="fas fa-trash-alt" style="color: rgb(255,255,255);"></i>&nbsp;Delete<span class="text-white-50 icon"></span></button>
                                        </td>
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
    <div class="modal fade" role="dialog" tabindex="-1" id="add-subject">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Subject</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" id="package-name" for="username"><strong>Subject Name</strong></label>
                                    <input class="form-control" type="text" id="subject-name-1" name="subjectName">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" id="package-name" for="username"><strong>Subject ID</strong></label>
                                    <input class="form-control" type="text" id="subject-name-1" name="subjectID">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email"><strong>Time</strong></label>
                                    <input class="form-control" type="time" id="subject-time" name="time">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="last_name"><strong>Day</strong></label>
                                    <select class="form-select" id="day" name="day">
                                        <option value="Monday" >Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="last_name"><strong>Duration</strong></label>
                                    <input class="form-control" type="text" id="duration" name="duration" placeholder="HH:MM:SS">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Education Level</strong></label>
                                    <select class="form-select" id="education-level" name="eduID">
                                        <optgroup label="Choose your education level">
                                            @foreach($educationLevels as $eduID => $eduName)
                                                <option value="{{$eduID}}">{{$eduName}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Tutor</strong></label>
                                    <select class="form-select" id="education-level" name="tutorID">
                                        <optgroup label="Choose tutor to teach this subject">
                                            @foreach($tutors as $tutor)
                                                <option value="{{$tutor->userID}}">{{$tutor->user->userName}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="reset" data-bs-dismiss="modal">Clear</button><button class="btn btn-primary" type="button">Update</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="edit-subject">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Subject</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="subject-name"><strong>Subject Name</strong></label><input class="form-control" type="text" id="subject-name" value="Mathematics" name="subject-name"></div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="email"><strong>Time</strong></label>
                                    <input class="form-control" type="time" id="subject-time-1" name="time">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Day</strong></label><select class="form-select" id="day-1">
                                        <option value="Monday" selected="">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                    </select></div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="last_name"><strong>Duration</strong></label>
                                    <input class="form-control" type="text" id="duration-1" name="duration" placeholder="HH:MM:SS">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Education Level</strong></label>
                                    <select class="form-select" id="education-level" name="eduID">
                                        <optgroup label="Choose your education level">
                                            @foreach($educationLevels as $eduID => $eduName)
                                                <option value="{{$eduID}}">{{$eduName}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Tutor</strong></label>
                                    <select class="form-select" id="education-level" name="tutorID">
                                        <optgroup label="Choose tutor to teach this subject">
                                            @foreach($tutors as $tutor)
                                                <option value="{{$tutor->userID}}">{{$tutor->user->userName}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
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