<!DOCTYPE html>
<html lang="en">

@include('frame.index-head')

<body>

    @include('frame.index-navbar')
    
    <section class="py-4 py-md-5">
        <div class="container py-md-5">
            <div class="row">
                <div class="col-md-6 text-center"><img class="img-fluid w-100" src="{{ asset('img/illustrations/admin-student-tutor.png') }}"></div>
                <div class="col-md-5 col-xl-4 text-center text-md-start">
                    <h2 class="display-6 fw-bold mb-5"><span class="underline pb-1">Sign in</span><br></h2>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <form method="post" action="{{ route('sign-in') }}">
                        @csrf
                            <div class="mb-3"><select class="form-select">
                                    <optgroup label="Choose your role">
                                        <option value="Administrator" selected="">Administrator</option>
                                        <option value="Student">Student</option>
                                        <option value="Tutor">Tutor</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="mb-3"><input class="shadow form-control @error('userPass') is-invalid @enderror" type="email" id="userEmail" name="userEmail" placeholder="Email" value="{{ old('userEmail') }}"></div>
                            <div class="mb-3"><input class="shadow form-control @error('userPass') is-invalid @enderror" type="password" id="userPass" name="userPass" placeholder="Password"></div>
                            <div class="mb-5"><button class="btn btn-primary shadow" type="submit">Log in</button></div>

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                        @endif

                        <p>Dont have an account?&nbsp;<a href="{{ route('index') }}">Sign up</a>&nbsp;</p>
                        
                    </form>

                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>