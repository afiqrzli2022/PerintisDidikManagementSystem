<!DOCTYPE html>
<html lang="en">

@include('frame.tutor-head')

<body>

    @include('frame.tutor-navbar')
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
                        <div class="card-body text-center shadow"><img class="rounded-circle mb-3 mt-4" src="../assets/img/avatar/user-default.jpg" width="160" height="160">
                            <div class="mb-3"><input type="file"></div>
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
                                    <p class="text-primary m-0 fw-bold">Tutor Details</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('updatedProfileTutor') }}" id="updateForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="username"><strong>Full Name</strong></label><input class="form-control" type="text" id="name-tutor" name="userName" value="{{ Auth::user()->userName }}"></div>
                                                @if($errors->has('userName'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('userName') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="email"><strong>IC Number</strong></label><input class="form-control" type="text" id="identity-card-tutor" name="userID" value="{{ Auth::user()->userID }}" disabled=""></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Phone Number</strong></label><input class="form-control" type="tel" id="phoneNum-tutor" name="userNumber" value="{{ Auth::user()->userNumber }}"></div>
                                                @if($errors->has('userNumber'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('userNumber') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Email</strong></label><input class="form-control" type="email" id="email-tutor" value="{{ Auth::user()->userEmail }}" name="userEmail"></div>
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
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Education Level</strong></label>
                                                    <select class="form-select" id="education-level" name="education-level" disabled>
                                                        <optgroup label="Choose your education level.">
                                                            <option value="{{Auth::user()->tutor->educationLevel}}">{{ Auth::user()->tutor->educationLevel }}</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Working Experience</strong></label><textarea class="form-control" id="working-experience"  name="workingExperience" form="updateForm">{{ Auth::user()->tutor->workingExperience }}</textarea></div>
                                                @if($errors->has('workingExperience'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('workingExperience') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3"><button class="btn btn-primary btn-sm" type="submit" form="updateForm">Update</button></div>
                                    </form>
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