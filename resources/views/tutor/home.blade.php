<!DOCTYPE html>
<html lang="en">

@include('frame.tutor-head')

<body>

    @include('frame.tutor-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Home</span><br></h2>
                    @if(Auth::user()->tutor)
                        <p>Welcome,  {{ Auth::user()->userName }} !</p>
                    @else
                        <p>You are not logged in. Please <a href="{{ route('index') }}">log in</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>