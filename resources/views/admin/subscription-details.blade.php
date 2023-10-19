<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Subscription Details</span><br></h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Student Details</p>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="username"><strong>Full Name</strong></label>
                                            <p style="color: rgb(78,93,120);">Muhammad Adam</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="email"><strong>Identity Card</strong></label>
                                            <p style="color: rgb(78,93,120);">010203-10-4444</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="username"><strong>Package&nbsp;</strong></label>
                                            <p style="color: rgb(78,93,120);">SPM Package B</p>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="username"><strong>Subject Taken</strong></label>
                                            <p style="color: rgb(78,93,120);">4 Subjects</p>
                                            <ul>
                                                <li>Bahasa Melayu Form 5</li>
                                                <li>History Form 5</li>
                                                <li>Mathematics Form 5</li>
                                                <li>Additional Mathematics Form5&nbsp;</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Price</strong></label>
                                            <p style="color: rgb(78,93,120);">RM100.00</p>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" role="dialog" tabindex="-1" id="add-education-level">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Education Level</h4><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3"><label class="form-label" id="package-name" for="username"><strong>Education Level Name</strong></label><input class="form-control" type="text" id="education-level-name" value="" name="education-level-name"></div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="reset" data-bs-dismiss="modal">Clear</button><button class="btn btn-primary" type="button">Update</button></div>
            </div>
        </div>
    </div>

    @include('frame.footer')

    @include('frame.script')

</body>

</html>