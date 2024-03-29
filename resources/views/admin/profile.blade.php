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
                                    <form>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="username"><strong>Full Name</strong></label>
                                                    <p style="color: rgb(78,93,120);">{{ Auth::user()->userName }}</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="email"><strong>IC Number</strong></label>
                                                    <p style="color: rgb(78,93,120);">{{ Auth::user()->userID }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Phone Number</strong></label>
                                                    <p style="color: rgb(78,93,120);">{{ Auth::user()->userNumber }}</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="last_name"><strong>Email</strong></label>
                                                    <p style="color: rgb(78,93,120);">{{ Auth::user()->userEmail }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Password</strong></label>
                                                    <p style="color: rgb(78,93,120);">Click "Edit" to change your password.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="username"><strong>Role</strong></label>
                                                    <p style="color: rgb(78,93,120);">{{ Auth::user()->Administrator->adminRoles }}</p>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="mb-3"><label class="form-label" for="first_name"><strong>Office Number</strong></label>
                                                    <p style="color: rgb(78,93,120);">{{ Auth::user()->Administrator->officeNumber }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3"><a class="btn btn-primary btn-sm" role="button" href="profile-edit">Edit</a></div>
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