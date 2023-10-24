<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/startup-modern.js') }}"></script>
<script src="{{ asset('js/package.js') }}"></script>
<script src="{{ asset('js/education-level.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@if(session('success'))
    <script>alert("{{ session('success') }}");</script>
@endif