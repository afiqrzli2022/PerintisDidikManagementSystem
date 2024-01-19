<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Profile</span><br></h2>
                </div>
            </div>
            <div class="row mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="card shadow mb-3">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Administrator Details</p>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('updatedProfileAdmin') }}" id="updateForm">
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
                                                @if($errors->has('userID'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('userID') }}
                                                    </div>
                                                @endif
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
                                                <div class="mb-3"><label class="form-label" for="username"><strong>Roles</strong></label><input class="form-control" type="text" id="name-parent" value="{{ Auth::user()->Administrator->adminRoles }}" name="adminRoles" disabled></div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Office Number</strong></label><input class="form-control" type="tel" id="phoneNum-paarent" value="{{ Auth::user()->Administrator->officeNumber }}" name="officeNumber"></div>
                                                @if($errors->has('officeNumber'))
                                                    <div class="alert alert-danger">
                                                        {{ $errors->first('officeNumber') }}
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
    <script>
        var formSubmitted = false;
        document.getElementById('updateForm').addEventListener('submit', function (event) {
            var confirmed = confirm("Are you sure you want to update with this information?");
            formSubmitted = true;
            if (!confirmed) {
                formSubmitted = false;
                event.preventDefault(); // Prevent form submission if not confirmed
            }
        });

        window.addEventListener('beforeunload', function (e) {
            if (!formSubmitted) {
                var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';

                // Standard
                e.returnValue = confirmationMessage;

                // For old browsers
                return confirmationMessage;
            }
        });
    </script>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>