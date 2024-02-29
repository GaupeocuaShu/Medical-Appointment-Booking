<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
  <title>General Dashboard &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset("admin/modules/bootstrap/css/bootstrap.min.css")}}">
  <link rel="stylesheet" href="{{asset("admin/modules/fontawesome/css/all.min.css")}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset("admin/modules/jqvmap/dist/jqvmap.min.css")}}">
  <link rel="stylesheet" href="{{asset("admin/modules/weather-icon/css/weather-icons.min.css")}}">
  <link rel="stylesheet" href="{{asset("admin/modules/weather-icon/css/weather-icons-wind.min.css")}}">
  <link rel="stylesheet" href="{{asset("admin/modules/summernote/summernote-bs4.css")}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset("admin/css/style.css")}}">
  <link rel="stylesheet" href="{{asset("admin/css/components.css")}}">
  {{-- Datatable  --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA -->
</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">

      {{-- Navbar --}}
      @include('admin.layout.navbar')


      {{-- Sidebar --}}
      @include('admin.layout.sidebar')


      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>

      {{-- Footer --}}
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset("admin/modules/jquery.min.js")}}"></script>
  <script src="{{asset("admin/modules/popper.js")}}"></script>
  <script src="{{asset("admin/modules/tooltip.js")}}"></script>
  <script src="{{asset("admin/modules/bootstrap/js/bootstrap.min.js")}}"></script>
  <script src="{{asset("admin/modules/nicescroll/jquery.nicescroll.min.js")}}"></script>
  <script src="{{asset("admin/modules/moment.min.js")}}"></script>
  <script src="{{asset("admin/js/stisla.js")}}"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
  {{-- Fontawesom Icon --}}
  <script src="https://kit.fontawesome.com/1027857984.js" crossorigin="anonymous"></script>
  <!-- JS Libraies -->
  <script src="{{asset("admin/modules/simple-weather/jquery.simpleWeather.min.js")}}"></script>
  <script src="{{asset("admin/modules/chart.min.js")}}"></script>
  <script src="{{asset("admin/modules/jqvmap/dist/jquery.vmap.min.js")}}"></script>
  <script src="{{asset("admin/modules/jqvmap/dist/maps/jquery.vmap.world.js")}}"></script>
  <script src="{{asset("admin/modules/summernote/summernote-bs4.js")}}"></script>
  <script src="{{asset("admin/modules/chocolat/dist/js/jquery.chocolat.min.js")}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset("admin/js/page/index-0.js")}}"></script>
  
  <!-- Template JS File -->
  <script src="{{asset("admin/js/scripts.js")}}"></script>
  <script src="{{asset("admin/js/custom.js")}}"></script>
  {{-- Datatable --}}
  <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
  <script>
    // ------------------------------ Change Status --------------------------------- 
    $("body").on("click",".status",function(){
      const URL = $(this).data("url");

      $.ajax({
        type: "PUT",
        url: URL ,
        dataType: "JSON",
        success: function (data) {
          alert(data.status);
        },
      });
    }) 
    // ------------------------------ Delete Items --------------------------------- 
    $("body").on("click",".delete",function(){
      const URL = $(this).data("url");
      $.ajax({
        type:"DELETE",
        url: URL ,
        dataType: "JSON",
        success:(data) => {
          if(data.status == "success"){
            alert($(this));
            $(this).parent().parent().hide();
          }
        },
      });
    })
  </script> 
  @stack('scripts')
</body>
</html>