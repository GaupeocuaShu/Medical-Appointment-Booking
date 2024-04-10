    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>

    <!-- MENU Navbar-->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href="/" class="navbar-brand"><i class="fa fa-meetup large-icon"></i>EDICLORD</a>
            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#top" class="smoothScroll">Đặt khám</a></li>
                    <li><a href="#about" class="smoothScroll">Tư vấn trực tuyến</a></li>
                    <li><a href="#team" class="smoothScroll">Store</a></li>
                    <li><a href="#news" class="smoothScroll">Tin Y tế</a></li>
                    <li><a href="#google-map" class="smoothScroll">Dành cho nhân viên Y tế</a></li>
                    @if (!Auth::check())
                        <li class="appointment-btn"><a href="{{ route('login') }}">Đăng nhập</a></li>
                    @else
                        <!-- Notification Dropdown -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i> <!-- Icon chuông thông báo -->
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu notification-dropdown">
                                <!-- Danh sách thông báo từ bác sĩ -->
                                <li>
                                    <a href="#">
                                        <img src="images/bs1.jpg" alt="Doctor" class="doctor-avatar">
                                        <span class="notification-message">Nhớ uống thuốc</span>
                                    </a>
                                </li>
                                <!-- Thêm các thông báo khác tương tự cần thiết -->
                            </ul>
                        </li>
                        <!-- User Avatar Dropdown -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset(Auth::user()->avatar) }}" alt="Avatar" class="avatar">
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('profile') }}" class="profile"><i class="fa fa-user"></i>
                                        My
                                        Profile</a></li>
                                <li><a href="#" class="messages"><i class="fa fa-envelope"></i> Messages</a></li>
                                <li><a href="#" class="activity"><i class="fa fa-bell"></i> Activity</a></li>
                                <li><a href="#" class="faq"><i class="fa fa-question-circle"></i> FAQ</a></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                            Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif


                </ul>
            </div>

        </div>
    </section>
