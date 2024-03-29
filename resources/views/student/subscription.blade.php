<!DOCTYPE html>
<html lang="en">

@include('frame.student-head')

<body>
    @include('frame.student-navbar')

    <form id="subscription-form" method="POST">
        @csrf
        <section class="py-5">
            <div class="container py-5">
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <h2 class="display-6 fw-bold mb-4"><span class="underline">Subscription</span><br></h2>
                        <p class="text-muted">Simplify your education journey with Perintis Didik. Subscribe now for easy student registration and seamless management!</p>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-8 col-xl-6 text-center mx-auto">
                        <form>
                            <select class="form-select" id="educationLevelSelect">
                                <optgroup label="Choose your education level">
                                    @foreach ($educationLevel as $edu)
                                        @if (Auth::user()->student->latestSubs && Auth::user()->student->latestSubs->package && Auth::user()->student->latestSubs->package->educationlevel)
                                            @if ($edu->eduID == Auth::user()->student->latestSubs->package->educationlevel->eduID)
                                                <option value="{{ $edu->eduID }}" selected>{{ $edu->eduName }}</option>
                                            @else
                                                <option value="{{ $edu->eduID }}">{{ $edu->eduName }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $edu->eduID }}">{{ $edu->eduName }}</option>
                                        @endif
                                     @endforeach
                                </optgroup>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                    @foreach ($educationLevel as $edu)
                    @if($edu->hasPackage())
                        @foreach ($edu->package as $package)
                        <div class="col package-card" data-edu-id="{{ $edu->eduID }}" data-subject-quantity="{{ $package->subjectQuantity }}" data-package-id="{{ $package->packageID }}" style="display: none;">
                            <div class="card border-warning border-2 h-100">
                                <div class="card-body d-flex flex-column justify-content-between p-4">
                                    <div>
                                        <h6 class="fw-bold text-center text-muted">
                                            {{ $package->packageName }}
                                            @if (Auth::user()->student->latestSubs && Auth::user()->student->latestSubs->package)
                                                @if ($package->packageID == Auth::user()->student->latestSubs->package->packageID)
                                                    (Selected)
                                                @endif
                                            @endif
                                        </h6>
                                        <h4 class="display-5 fw-bold text-center mb-4">RM {{ $package->packagePrice }}</h4>
                                        <ul class="list-unstyled">
                                            <li class="d-flex mb-2">
                                                <span class="bs-icon-xs bs-icon-rounded bs-icon me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check fs-5 text-primary">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M5 12l5 5l10 -10"></path>
                                                    </svg>
                                                </span>
                                                <span>Education Level : {{ $edu->eduName }}</span>
                                            </li>
                                            <li class="d-flex mb-2">
                                                <span class="bs-icon-xs bs-icon-rounded bs-icon me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-check fs-5 text-primary">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M5 12l5 5l10 -10"></path>
                                                    </svg>
                                                </span>
                                                <span>Subject Quantity: {{ $package->subjectQuantity }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <a class="btn btn-warning package-button" role="button" href="#" data-bs-target="#subscription-subject" data-bs-toggle="modal">
                                        @if (Auth::user()->student->latestSubs && Auth::user()->student->latestSubs->package)
                                            @if ($package->packageID == Auth::user()->student->latestSubs->package->packageID)
                                                Change Subject
                                            @else
                                                Select
                                            @endif
                                        @else
                                            Select
                                        @endif
                                    </a>
                                    <input type="hidden" name="packageID" value="{{ $package->packageID }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <a class="col package-card" data-edu-id="{{ $edu->eduID }}" data-subject-quantity="{{ $package->subjectQuantity }}" data-package-id="{{ $package->packageID }}" style="display: none;">No package available</a>
                    @endif
                    @endforeach
                </div>
            </div>
        </section>
    </form>

    <!-- The Subscription Subject Modal -->
    <div class="modal fade" role="dialog" tabindex="-1" id="subscription-subject">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Choose your subject</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload();"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Package Available</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Subject Name</th>
                                            <th class="text-center">Day</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr></tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light" type="button" data-bs-dismiss="modal" onclick="location.reload();">Close</button>
                    <button class="btn btn-primary" type="button" id="subscribe-btn">Subscribe</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            // Listen for changes in the education level dropdown
            $('#educationLevelSelect').change(function () {
                // Get the selected education level value
                const selectedEduId = $(this).val();

                // Hide all package cards by default
                $('.package-card').hide();

                // Show package cards that match the selected education level
                $(`.package-card[data-edu-id="${selectedEduId}"]`).show();

                // Hide the subscription modal when the education level is changed
                $('#subscription-subject').modal('hide');
            });

            // Trigger the change event on page load to initially show packages for the default selected education level
            $('#educationLevelSelect').trigger('change');

            // Listen for the modal show event
            $('#subscription-subject').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Button that triggered the modal
                const eduId = button.closest('.package-card').data('edu-id'); // Get the eduID from the package-card
                
                $('.package-button').click(function () {
                    const subjectQuantity = button.closest('.package-card').data('subject-quantity'); // Get the subj from the package-card
                    const packageId = button.closest('.package-card').data('package-id'); // Get the packageID from the package-card
                    $('#subscribe-btn').attr('data-subject-quantity', subjectQuantity);
                    $('#subscribe-btn').attr('data-package-id', packageId);
                });
                const modal = $(this);

                // Update the modal title based on the selected education level
                const eduName = $(`#educationLevelSelect option[value="${eduId}"]`).text();
                modal.find('.modal-title').text(`Choose your subject for ${eduName}`);

                // Filter the subjects based on the selected education level and update the modal content
                const subjects = @json($educationLevel->pluck('subject')->flatten());
                const filteredSubjects = subjects.filter(subject => subject.eduID === eduId);
                const modalBody = modal.find('.modal-body');
                modalBody.empty();

                if (filteredSubjects.length > 0) {
                    const table = $('<table class="table my-0"></table>');
                    const tbody = $('<tbody></tbody>');

                    filteredSubjects.forEach(subject => {
                        const tr = $('<tr></tr>');
                        tr.append(`<td class="text-center">${subject.subjectName}</td>`);
                        tr.append(`<td class="text-center">${subject.day}</td>`);
                        tr.append(`<td class="text-center">${subject.time}</td>`);

                        // Create a checkbox input and check it if the subject is in the latest subscription
                        const checkbox = $(`<input type="checkbox" value="${subject.subjectID}" name="subjectID[]" class="form-control-sm">`);
                        
                        if (isSubjectInLatestSubscription(subject)) {
                            checkbox.prop('checked', true);
                        }
                        
                        tr.append($('<td class="text-center"></td>').append(checkbox));
                        tbody.append(tr);
                        
                    });

                    table.append(tbody);
                    modalBody.append(table);
                } else {
                    modalBody.html('<p>No subjects available for this education level.</p>');
                }
            });


            function isSubjectInLatestSubscription(subject) {
                @if (Auth::user()->student->latestSubs)
                    const latestSubscriptionSubjects = @json(Auth::user()->student->latestSubs->subject->pluck('subjectID'));
                    return latestSubscriptionSubjects.includes(subject.subjectID);
                @else
                    return false;
                @endif
            }

                // Handle form submission
            $('#subscribe-btn').click(function () {
                
                // Get the subjectQuantity for the selected package
                const subjectQuantity = $(this).data('subject-quantity');
                const packageId = $(this).data('package-id');
                
                // Get the selected education level and package ID
                const selectedEduId = $('#educationLevelSelect').val();
                const selectedPackageCard = $('.package-card[data-edu-id="' + selectedEduId + '"]').find('input[name="packageID"]').val();

                // Get the selected subject IDs
                const selectedSubjectIds = $('input[name="subjectID[]"]:checked').map(function () {
                    return this.value;
                }).get();

                if (selectedSubjectIds.length > subjectQuantity) {
                    // Display an error message or prevent form submission
                    alert('You cannot select more subjects than allowed. Please select a maximum of '+subjectQuantity+' subjects');
                    return;
                } else if (selectedSubjectIds.length < 1) {
                    alert('You must select at least one subject.');
                    return;
                } else if (selectedSubjectIds.length === subjectQuantity){

                } else {
                    if (confirm("Are you sure you want to proceed with "+selectedSubjectIds.length+" subjects ? ("+subjectQuantity+" subjects are allowed)")) {
                        
                    } else {
                        return;
                    }
                }

                // Add hidden input fields to the form to send the data
                $('<input>').attr({
                    type: 'hidden',
                    name: 'eduID',
                    value: selectedEduId
                }).appendTo('#subscription-form');

                $('<input>').attr({
                    type: 'hidden',
                    name: 'packageID',
                    value: packageId
                }).appendTo('#subscription-form');

                // Add hidden input fields for the selected subject IDs
                selectedSubjectIds.forEach(subjectId => {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'selectedSubjects[]',
                        value: subjectId
                    }).appendTo('#subscription-form');
                });

                // Submit the form
                $('#subscription-form').submit();
            });
        });
    </script>

    @include('frame.footer')
    @include('frame.script')
</body>

</html>

