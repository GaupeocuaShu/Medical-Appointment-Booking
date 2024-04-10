<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>General Dashboard &mdash; Stisla</title>
    {{-- Toastify --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('doctor/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doctor/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('doctor/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doctor/modules/weather-icon/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doctor/modules/weather-icon/css/weather-icons-wind.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doctor/modules/summernote/summernote-bs4.css') }}">
    {{-- Selectric --}}
    <link rel="stylesheet" href="{{ asset('doctor/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('doctor/modules/jquery-selectric/selectric.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('doctor/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('doctor/css/components.css') }}">
    {{-- Datatable  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
    {{-- CK Editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.0/classic/ckeditor.js"></script>
    <style type="text/css">
        .ck-editor__editable_inline {
            height: 750px;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            {{-- Navbar --}}
            @include('doctor.layout.navbar')


            {{-- Sidebar --}}
            @include('doctor.layout.sidebar')


            <!-- Main Content -->
            <div class="main-content">
                @yield('content')
            </div>

            {{-- Footer --}}
            <footer class="main-footer">

                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('doctor/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/popper.js') }}"></script>
    <script src="{{ asset('doctor/modules/tooltip.js') }}"></script>
    <script src="{{ asset('doctor/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/moment.min.js') }}"></script>
    <script src="{{ asset('doctor/js/stisla.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- Toastify --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    {{-- Sweat Alert  --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Fontawesom Icon --}}
    <script src="https://kit.fontawesome.com/1027857984.js" crossorigin="anonymous"></script>
    <!-- JS Libraies -->
    <script src="{{ asset('doctor/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/chart.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('doctor/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('doctor/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    {{-- Selectric --}}
    <script src="{{ asset('doctor/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('doctor/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('doctor/js/page/index-0.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('doctor/js/scripts.js') }}"></script>
    <script src="{{ asset('doctor/js/custom.js') }}"></script>
    {{-- Datatable --}}
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    {{-- CkEditor --}}
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                    ckfinder: {
                        uploadUrl: "{{ route('doctor.ckeditor.upload', ['_token' => csrf_token()]) }}",
                    }
                }

            )
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error(error);
            });
    </script>
    {{-- CkEditor --}}

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $err)

                Toastify({
                    text: "{{ $err }}",
                    duration: 3000,
                    className: "info",
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    }
                }).showToast();
            @endforeach
        @endif
        @if (Session::has('status'))
            Toastify({
                text: "{{ session('status') }}",
                duration: 3000,
                className: "info",
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                }
            }).showToast();
        @endif
    </script>
    <script>
        $(document).ready(function() {
            // Do anything

            // ------------------------------ Change Status --------------------------------- 
            $("body").on("change", ".status", function() {

                const currentStatus = $(this).data("status");
                const phone = $(this).data('user-phone');
                const URL = $(this).data("url");
                const status = $(this).val()
                const id = $(this).data("id");
                const selectName = $(this).data("name");
                const data = {
                    key: status
                };
                let text = "";
                let confirmButtonText = "Yes, I Agree";

                // Set up button text for schedule status select
                if (selectName == "schedule-status") {
                    [text, confirmButtonText] = setUpScheduleStatusText();
                }

                function setUpScheduleStatusText() {
                    let text = "";
                    let confirmButtonText = "Agree!";
                    if (status == "confirmed") {
                        text = `You should call this number <b><u>${phone}</u></b> to confirm the schedule`;
                        confirmButtonText = "Yes, I've already called the patient!";
                    } else if (status == "canceled") {
                        text = "Give the reason to the patient why you cancel this schedule";
                    } else if (status == "completed") {
                        text = "Give some notes to the patient after schedule";
                    } else {
                        text = "Give some notes to the patient to prepare for the schedule";
                    }
                    return [text, confirmButtonText];
                }

                // Reset Status if  canceling the request
                resetStatus = () => {
                    $(`.select-status-${id} option[value=${currentStatus}]`).prop("selected", 'true');
                }

                // Chang status by send AJAX 
                function changeStatus(data = null, text = null) {
                    $.ajax({
                        type: "PUT",
                        async: false,
                        url: URL,
                        data: data,
                        dataType: "JSON",
                        success: function(data) {

                            if (data.status == 'success_show') {
                                Swal.fire({
                                    title: "Updated!",
                                    text: data.text,
                                    icon: "success"
                                });
                            }

                            if (data.status == 'success') {
                                Toastify({
                                    text: data.message,
                                    className: "info",
                                    style: {
                                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                                    }
                                }).showToast();
                            }

                            if (data.status == 'hide') {
                                Swal.fire({
                                    title: "Updated!",
                                    text: "The status has changed.",
                                    icon: "success"
                                });
                                $(`.select-status-${data.id}`).parents().eq(2).hide(3000);
                            }


                            if (data.is_empty == true) {
                                const html =
                                    '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>';
                                $("tbody").html(html);
                            }

                        },
                    });
                }

                // Update Role Status 
                if (selectName == "role-status") {
                    Swal.fire({
                        title: "Are you sure?",
                        html: text,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: confirmButtonText,
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            resetStatus();
                        } else {
                            changeStatus(data);
                        }
                    })
                }
                // Update Role Status 
                else if (selectName == "schedule-status") {
                    Swal.fire({
                        title: "Are you sure?",
                        html: text,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: confirmButtonText,
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            resetStatus();
                        } else {
                            if (status != "confirmed") {
                                async function writeNote() {
                                    const {
                                        value: text
                                    } = await Swal.fire({
                                        input: "textarea",
                                        inputLabel: "Message",
                                        inputPlaceholder: "Type your message here...",
                                        inputAttributes: {
                                            "aria-label": "Type your message here"
                                        },
                                        showCancelButton: true
                                    });
                                    if (text) {
                                        Swal.fire({
                                            title: text,
                                            confirmButtonText: "Send",
                                        });
                                        changeStatus({
                                            ...data,
                                            text
                                        });
                                    } else resetStatus();
                                }
                                writeNote();
                            } else {
                                changeStatus(data);
                            }
                        }
                    });
                } else changeStatus();
            })
            // ------------------------------ Delete Items --------------------------------- 
            $("body").on("click", ".delete", function() {
                const URL = $(this).data("url");
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: URL,
                            dataType: "JSON",
                            success: (data) => {
                                if (data.status == "success") {
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: data.message,
                                        icon: "success"
                                    });
                                    $(this).parent().parent().hide();
                                    if (data.is_empty == true) {
                                        const html =
                                            '<td valign="top" colspan="6" class="dataTables_empty">No data available in table</td>';
                                        $("tbody").html(html);
                                    }
                                } else {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong!",
                                        footer: '<a href="#">Why do I have this issue?</a>'
                                    });
                                }
                            },
                        });

                    }
                });

            })
        });
    </script>
    @stack('scripts')
</body>

</html>
