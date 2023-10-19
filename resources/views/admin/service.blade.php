<!DOCTYPE html>
<html lang="en">

@include('frame.admin-head')

<body>

    @include('frame.admin-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">List of Service</span><br></h2>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-8 col-xl-9 text-center mx-auto">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr></tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Education level</td>
                                    <td><a class="btn btn-primary" role="button" href='education-level'><i class="fas fa-info-circle" style="color: rgb(255,255,255);"></i>&nbsp;Details<span class="text-white-50 icon"></span></a></td>
                                </tr>
                                <tr>
                                    <td>Package</td>
                                    <td><a class="btn btn-primary" role="button" href='package'><i class="fas fa-info-circle" style="color: rgb(255,255,255);"></i>&nbsp;Details<span class="text-white-50 icon"></span></a></td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td><a class="btn btn-primary" role="button" href='subject'><i class="fas fa-info-circle" style="color: rgb(255,255,255);"></i>&nbsp;Details<span class="text-white-50 icon"></span></a></td>
                                </tr>
                            </tbody>
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