<script src="{{ secure_asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ secure_asset('js/startup-modern.js') }}"></script>
<script src="{{ secure_asset('js/education-level.js') }}"></script>
<script src="{{ secure_asset('js/package.js') }}"></script>
<script src="{{ secure_asset('js/subject.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<h1></h1>
@if(session('success'))
    <script>alert("{{ session('success') }}");</script>
@endif
@if(session('error'))
    <script>alert("{{ session('error') }}");</script>
@endif