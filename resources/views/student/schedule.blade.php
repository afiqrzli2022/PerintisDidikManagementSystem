<!DOCTYPE html>
<html lang="en">

@include('frame.student-head')

<body>

    @include('frame.student-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Schedule</span><br></h2>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6 col-xxl-5 text-nowrap">
                            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead>
                                <tr>
                                    <th class="text-center">Subject Name</th>
                                    <th class="text-center">Day</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedule->subject as $subject)
                                    <tr>
                                        <td class="text-center">{{$subject->subjectName}}</td>
                                        <td class="text-center">{{$subject->day}}</td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($subject->time)->format('h:i a') }} - 
                                            {{ \Carbon\Carbon::parse($subject->time)
                                                    ->addHours(intval(explode(':', $subject->duration)[0]))
                                                    ->addMinutes(intval(explode(':', $subject->duration)[1]))
                                                    ->format('h:i a') }}
                                        </td>
                                        @php
                                            $duration = $subject->duration;
                                            $hours = substr($duration, 0, 2); // Extract hours
                                            $minutes = substr($duration, 3, 2); // Extract minutes
                                            $carbonInterval = \Carbon\CarbonInterval::hours($hours)->minutes($minutes)->forHumans();
                                        @endphp
                                        <td class="text-center">
                                            {{ $carbonInterval }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr></tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>