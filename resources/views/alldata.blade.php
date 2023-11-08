<!DOCTYPE html>
<html lang="en">

@include('frame.tutor-head')

<body>

    @include('frame.tutor-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-left mx-auto">
                    
                    <br><b>Student Info (from DB):</b><br>
                    @foreach (Auth::user()->student->getAttributes() as $attribute => $value)
                    {{ $attribute }} : <b>{{ $value }}</b> <br>
                    @endforeach
                   
                    <br><b>Package Info (from DB):</b><br>
                    @foreach (Auth::user()->student->latestSubs->package->getAttributes() as $attribute => $value)
                        {{ $attribute }} : <b>{{ $value }}</b> <br>
                    @endforeach

                    <br><b>Subject Info (from DB):</b><br>
                    @foreach(Auth::user()->student->latestSubs->subject as $subject)
                        <li>{{$subject->subjectName}}</li>
                    @endforeach

                    <br><b>Subscription Info (from DB):</b><br>
                    @foreach (Auth::user()->student->latestSubs->getAttributes() as $attribute => $value)
                        {{ $attribute }} : <b>{{ $value }}</b> <br>
                    @endforeach

                    <br><b>Payment Info (from DB):</b><br>
                    @foreach (Auth::user()->student->latestSubs->payment as $payments)
                        @foreach ($payments->getAttributes() as $attribute => $value)
                            {{ $attribute }} : <b>{{ $value }}</b> <br>
                        @endforeach
                    @endforeach
                    
                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>