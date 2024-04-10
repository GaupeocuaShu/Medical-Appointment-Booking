<!DOCTYPE html>
<html lang="en">

<head>

    <title>Health - Medical Website Template</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Tooplate">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('frontend/home/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/home/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/home/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/home/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/home/css/doctor-team.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/choose-date/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/booking-result/style.css') }}">

    {{-- Ckeditor --}}
    <script src="{{ asset('vendor/ckeditor/build/ckeditor.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/home/css/tooplate-style.css') }}">

</head>


<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


    {{-- Navbar --}}

    @include('frontend.layout.navbar')

    {{-- Content --}}

    @yield('content')


    {{-- Footer --}}
    @include('frontend.layout.footer')


    <!-- SCRIPTS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('frontend/home/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/home/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/home/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('frontend/home/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/home/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/home/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('frontend/home/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/home/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/home/js/doctor-team.js') }}"></script>
    <script src="{{ asset('frontend/choose-date/custom.js') }}"></script>
    <script src="{{ asset('frontend/booking-result/custom.js') }}"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scripts')
</body>


</html>
