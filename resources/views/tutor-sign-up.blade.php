<!DOCTYPE html>
<html lang="en">

@include('frame.index-head')

<body>

    @include('frame.index-navbar')

    <section class="py-4 py-md-5">
        <div class="container py-md-5">
            <div class="row">
                <div class="col-md-6 text-center"><img class="img-fluid w-100" src="{{ asset('img/illustrations/tutor.png') }}"></div>
                <div class="col-md-5 col-xl-4 text-center text-md-start">
                    <h2 class="display-6 fw-bold mb-5">Sign up as<br><span class="underline pb-1"><strong>Tutor</strong></span>&nbsp;</h2>
                    <form action="{{ route('tutor.register') }}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <h3>Tutor Information</h3>
                        </div>
                        <hr>
                        <div class="mb-3"><input class="form-control" type="text" id="userName" name="userName" value="{{ old('userName') }}" placeholder="Name" pattern="^[a-zA-Z ']+$" title="Allowed format is alphabet and single quote only"></div>
                        @if($errors->has('userName'))
                            <div class="alert alert-danger">
                                {{ $errors->first('userName') }}
                            </div>
                        @endif
                        <div class="mb-3"><input class="form-control" type="text" id="userID" name="userID" value="{{ old('userID') }}" placeholder="IC Number" pattern="\d{6}-\d{2}-\d{4}" max="14" title="Please enter IC Number in the following format: 000000-00-0000"></div>
                        @if($errors->has('userID'))
                            <div class="alert alert-danger">
                                {{ $errors->first('userID') }}
                            </div>
                        @endif
                        <div class="mb-3"><input class="form-control" type="tel" id="userNumber" name="userNumber" value="{{ old('userNumber') }}" placeholder="Phone Number"></div>
                        @if($errors->has('userNumber'))
                            <div class="alert alert-danger">
                                {{ $errors->first('userNumber') }}
                            </div>
                        @endif
                        <div class="mb-3"><input class="shadow-sm form-control" type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}" placeholder="Email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter in correct email format (example: perintis@gmail.com)"></div>
                        @if($errors->has('userEmail'))
                            <div class="alert alert-danger">
                                {{ $errors->first('userEmail') }}
                            </div>
                        @endif
                        <div class="mb-3"><input class="shadow-sm form-control" type="password" id="password" name="password" placeholder="Password"></div>
                        @if($errors->has('password'))
                        <div class="alert alert-danger">
                            {{ $errors->first('password') }}
                        </div>
                        @endif
                        <div class="mb-3"><input class="shadow-sm form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-Enter Password"></div>
                        
                        <hr>
                        <div class="mb-3">
                            <select class="form-select" id="educationLevel" name="educationLevel">
                                <optgroup label="Choose your education level.">
                                    <option value="Master">Master</option>
                                    <option value="Degree">Degree</option>
                                    <option value="Diploma">Diploma</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" id="workingExperience" name="workingExperience" placeholder="Working Experience">{{ old('workingExperience') }}</textarea>
                        </div>

                        <div class="mb-5"><button class="btn btn-primary shadow" type="submit" onclick="disableBackButton()">Sign Up</button></div>
                        <p>Already have an account?&nbsp;<a href='tutor-sign-in'>Sign in</a>&nbsp;</p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function disableBackButton() {
            // Disable the back button
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function () {
                window.history.go(1);
            };
        }
    </script>

    @include('frame.footer')

    @include('frame.script')


</html>