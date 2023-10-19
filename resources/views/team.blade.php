<!DOCTYPE html>
<html lang="en">

@include('frame.index-head')

<body>

    @include('frame.index-navbar')

    <section class="py-5">
        <div class="container py-5">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2 class="fw-bold"><span class="underline pb-2">Our team</span><br></h2>
                </div>
            </div>
            <div class="row gy-4 row-cols-2 row-cols-md-4">
                <div class="col">
                    <div class="card border-0 shadow-none">
                        <div class="card-body text-center d-flex flex-column align-items-center p-0"><img class="rounded-circle mb-3 fit-cover" width="130" height="130" src="{{ asset('img/team/ad.png') }}">
                            <h5 class="fw-bold text-primary card-title mb-0">Addina Sofeya Md Kamalhisham</h5>
                            <p class="text-muted card-text mb-2">Project Leader</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow-none">
                        <div class="card-body text-center d-flex flex-column align-items-center p-0"><img class="rounded-circle mb-3 fit-cover" width="130" height="130" src="{{ asset('img/team/intan.png') }}">
                            <h5 class="fw-bold text-primary card-title mb-0">Intan Nur Aqilah Zolkanain</h5>
                            <p class="text-muted card-text mb-2">System Designer</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow-none">
                        <div class="card-body text-center d-flex flex-column align-items-center p-0"><img class="rounded-circle mb-3 fit-cover" width="130" height="130" src="{{ asset('img/team/izzah.png') }}">
                            <h5 class="fw-bold text-primary card-title mb-0">Izzah Maisarah Mokhtar</h5>
                            <p class="text-muted card-text mb-2">Document Manager</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow-none">
                        <div class="card-body text-center d-flex flex-column align-items-center p-0"><img class="rounded-circle mb-3 fit-cover" width="130" height="130" src="{{ asset('img/team/afiq.png') }}">
                            <h5 class="fw-bold text-primary card-title mb-0">Muhammad Afiq <br>Razali</h5>
                            <p class="text-muted card-text mb-2">Lead Developer</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-0 shadow-none">
                        <div class="card-body text-center d-flex flex-column align-items-center p-0"><img class="rounded-circle mb-3 fit-cover" width="130" height="130" src="{{ asset('img/team/syahrul.png') }}">
                            <h5 class="fw-bold text-primary card-title mb-0">Muhammad Syahrul Nizam Abdul Ghani</h5>
                            <p class="text-muted card-text mb-2">Developer</p>
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