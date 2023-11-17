<!DOCTYPE html>
<html lang="en">

@include('frame.index-head')

<body>

    @include('frame.index-navbar')

    <section class="py-4 py-md-5">
        <div class="container py-md-5">
            <div class="row">
                <div class="col-md-6 text-center"><img class="img-fluid w-100" src="{{ asset('img/illustrations/admin.png') }}"></div>
                <div class="col-md-5 col-xl-4 text-center text-md-start">
                    <h2 class="display-6 fw-bold mb-5">Sign up as<br><span class="underline pb-1"><strong>Admin</strong></span>&nbsp;</h2>
                    <form action="{{ route('admin.register') }}" method="POST">
                    @csrf

                        <div class="mb-3"><h3>Admin Information</h3></div>
                        <hr>
                        <div class="mb-3"><input class="form-control" type="text" id="userName" name="userName" value="{{ old('userName') }}" placeholder="Name"></div>
                        @if($errors->has('userName'))
                            <div class="alert alert-danger">
                                {{ $errors->first('userName') }}
                            </div>
                        @endif
                        <div class="mb-3"><input class="form-control" type="text" id="userID" name="userID" value="{{ old('userID') }}" placeholder="IC Number"></div>
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
                        <div class="mb-3"><input class="shadow-sm form-control" type="email" id="userEmail" name="userEmail" value="{{ old('userEmail') }}" placeholder="Email"></div>
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

                        <hr>
                        <div class="mb-3"><select class="form-select" id="adminRoles" name="adminRoles">
                                <optgroup label="Choose your role.">
                                    <option value="Admin">Admin</option>
                                    <option value="Assistant">Assistant</option>
                                </optgroup>
                            </select></div>
                        <div class="mb-3"><input class="form-control" type="text" id="officeNumber" name="officeNumber" value="{{ old('officeNumber') }}" placeholder="Office Number"></div>
                        @if($errors->has('officeNumber'))
                            <div class="alert alert-danger">
                                {{ $errors->first('officeNumber') }}
                            </div>
                        @endif

                        <div class="mb-5"><button class="btn btn-primary shadow" type="submit">Sign up</button></div>
                        <p>Already have an account?&nbsp;<a href='admin-sign-in'>Sign In</a>&nbsp;</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>