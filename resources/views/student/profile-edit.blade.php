<!DOCTYPE html>
<html lang="en">

@include('frame.student-head')

<body>

    @include('frame.student-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Profile</span><br></h2>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-4">
                    <div class="card mb-3">
                        <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="{{ asset('img/avatar/user-default.jpg') }}" width="160" height="160">
                            <div class="mb-3" ><input type="file"  style="display: none"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row mb-3 d-none">
                        <div class="col">
                            <div class="card text-white bg-primary shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card text-white bg-success shadow">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <p class="m-0">Peformance</p>
                                            <p class="m-0"><strong>65.2%</strong></p>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-rocket fa-2x"></i></div>
                                    </div>
                                    <p class="text-white-50 small m-0"><i class="fas fa-arrow-up"></i>&nbsp;5% since last month</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Student and Guardian Details</p>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('updatedProfileStudent') }}" id="updateForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="username"><strong>Full Name</strong></label><input class="form-control" type="text" id="name-tutor" value="{{ Auth::user()->userName }}" name="userName" pattern="^[a-zA-Z ']+$" title="Allowed format is alphabet and single quote only"></div>
                                                @if($errors->has('userName'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('userName') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="email"><strong>IC Number</strong></label><input class="form-control" type="text" id="identity-card-student" value="{{ Auth::user()->userID }}" name="userID" disabled></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Phone Number</strong></label><input class="form-control" type="tel" id="phoneNum-student" value="{{ Auth::user()->userNumber }}" name="userNumber"></div>
                                                @if($errors->has('userNumber'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('userNumber') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Email</strong></label><input class="form-control" type="email" id="email-student" value="{{ Auth::user()->userEmail }}" name="userEmail"></div>
                                                @if($errors->has('userEmail'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('userEmail') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>New Password</strong></label><input class="form-control" type="password" placeholder="Enter new password" name="password"></div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Re-Enter New Password</strong></label><input class="form-control" type="password" placeholder="Re-enter new password" name="password_confirmation"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Old Password</strong></label><input class="form-control" type="password" placeholder="Enter old password" name="oldPassword"></div>
                                            </div>
                                            <div class="col">
                                                @if($errors->has('password'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('password') }}
                                                    </div>
                                                @endif
                                                @if($errors->has('oldPassword'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('oldPassword') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="username"><strong>Full Name</strong></label><input class="form-control" type="text" id="name-parent" value="{{ Auth::user()->student->guardianName }}" name="guardianName" pattern="^[a-zA-Z ']+$" title="Allowed format is alphabet and single quote only"></div>
                                                @if($errors->has('guardianName'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('guardianName') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Phone Number</strong></label><input class="form-control" type="tel" id="phoneNum-paarent" value="{{ Auth::user()->student->guardianNumber }}" name="guardianNumber"></div>
                                                @if($errors->has('guardianNumber'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('guardianNumber') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Address</strong></label><textarea class="form-control" id="address" name="studentAddress" form="updateForm">{{ Auth::user()->student->studentAddress }}</textarea></div>
                                                @if($errors->has('studentAddress'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('studentAddress') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3"><button class="btn btn-primary btn-sm" form="updateForm" type="submit">Update</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('updateForm').addEventListener('submit', function (event) {
            
            var confirmed = confirm("Are you sure you want to register with this information?");
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function () {
                window.history.go(1);
            };
            if (!confirmed) {
                event.preventDefault(); // Prevent form submission if not confirmed
            }
        });
    </script>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>