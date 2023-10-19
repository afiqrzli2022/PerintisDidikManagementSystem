<!DOCTYPE html>
<html lang="en">

@include('frame.index-head')

<body>

    @include('frame.index-navbar')
    
    <section class="py-5">
        <div class="container py-4 py-xl-5">
            <div class="row gy-4 gy-md-0">
                <div class="col-md-6 text-center text-md-start d-flex d-sm-flex d-md-flex justify-content-center align-items-center justify-content-md-start align-items-md-center justify-content-xl-center">
                    <div style="max-width: 350px;">
                        <h1 class="display-6 fw-bold mb-4">Welcome to&nbsp;<span class="underline">Perintis Didik</span>Management System!</h1>
                        <p class="my-4" style="text-align: left;">Our web-based application simplifies student registration, login, service management, subscriptions, and payments. Say goodbye to tuition center problems! Enjoy a user-friendly interface for administrators, tutors, and students alike. Boost productivity and profitability effortlessly. Join us for an efficient and seamless experience!</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="{{ asset('img/illustrations/misi-visi-perintis-didik.png') }}"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container py-4 py-xl-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="display-6 fw-bold mb-4"><span class="underline">Choose your role</span><br></h2>
                    <p class="text-muted">Tutor, Student, or Administrator, and unlock the full potential of Perintis Didik Management System.</p>
                </div>
            </div>
            <div class="row gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
                <div class="col">
                    <div class="card border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <h4 class="display-5 fw-bold card-title mb-4" style="font-size: 35px;text-align: center;">Tutor</h4>
                            <div><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="{{ asset('img/illustrations/tutor.png') }}"></div><a class="btn btn-primary" role="button" href='tutor-sign-in'>Sign In</a>
                            <p style="text-align: center;">Dont have an account?&nbsp;<a href='tutor-sign-up'>Sign up</a>&nbsp;</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <h4 class="display-5 fw-bold card-title mb-4" style="font-size: 35px;text-align: center;">Student</h4>
                            <div><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="{{ asset('img/illustrations/student.png') }}"></div><a class="btn btn-warning" role="button" href='student-sign-in'>Sign In</a>
                            <p style="text-align: center;">Dont have an account?&nbsp;<a href='student-sign-up'>Sign up</a>&nbsp;</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 h-100">
                        <div class="card-body d-flex flex-column justify-content-between p-4">
                            <h4 class="display-5 fw-bold card-title mb-4" style="font-size: 35px;text-align: center;">Administrator</h4>
                            <div><img class="rounded img-fluid w-100 fit-cover" style="min-height: 300px;" src="{{ asset('img/illustrations/admin.png') }}"></div><a class="btn btn-primary" role="button" href='admin-sign-in'>Sign In</a>
                            <p style="text-align: center;">Dont have an account?&nbsp;<a href='admin-sign-up'>Sign up</a>&nbsp;</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="position-relative py-5">
        <div class="d-md-none"><iframe allowfullscreen="" frameborder="0" src="https://cdn.bootstrapstudio.io/placeholders/map.html" width="100%" height="100%"></iframe></div>
        <div class="d-none d-md-block position-absolute top-0 start-0 w-100 h-100"><iframe allowfullscreen="" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15936.27304209586!2d101.4895276!3d3.0764469!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc5257950d2a2b%3A0xbd88c2b4f3abacaa!2sPusat%20Tuisyen%20Perintis%20Didik!5e0!3m2!1sen!2smy!4v1688531654837!5m2!1sen!2smy" width="100%" height="100%"></iframe></div>
        <div class="position-relative mx-2 my-5 m-md-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-xl-5 col-xxl-4 offset-md-6 offset-xl-7 offset-xxl-8">
                        <div>
                            <form class="border rounded shadow p-3 p-md-4 p-lg-5" method="post" style="background: var(--bs-body-bg);">
                                <h3 class="mb-3">Address:</h3>
                                <p>Jalan Kristal AR7/AR<br>Seksyen 7<br>40000 Shah Alam<br>Selangor</p>
                            </form>
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