<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>
    @include('assets.stylesheet')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <div class="image" style="display: flex; align-items: center;">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image" style="width: 30px; margin-right: 10px;">
                        <p style="margin: 0;">{{ "Hi, " . ucwords(Helper::authUser()->NAME) }}</p>
                    </div>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">SKPI</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" class="nav-link {{ request()->route()->getName() == 'home' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                    <i class="right fas"></i>
                                </p>
                            </a>
                        </li>
                        @if (Helper::authUser()->ROLE == 'DEKAN')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        SKPI
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Ubah Profile
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Helper::authUser()->ROLE == 'ADMIN')
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Data Prodi
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('list-mahasiswa') }}" class="nav-link {{ in_array(request()->route()->getName(), ['list-mahasiswa', 'add-mahasiswa', 'add-mahasiswa-bulk']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Data Mahasiswa
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('list-kualifikasi') }}" class="nav-link {{ in_array(request()->route()->getName(), ['list-kualifikasi', 'add-kualifikasi']) ? 'active' : '' }}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Data Kualifikasi
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('list-portofolio') }}" class="nav-link {{ in_array(request()->route()->getName(), ['list-portofolio', 'add-portofolio']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-certificate"></i>
                                    <p>
                                        Data Portofolio
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Data SKPI
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Validasi SKPI
                                        <i class="right fas"></i>
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Helper::authUser()->ROLE == 'MAHASISWA')
                        <li class="nav-item">
                            <a href="{{ route('view-input-skpi') }}" class="nav-link {{ request()->route()->getName() == 'view-input-skpi' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Input Draft SKPI
                                    <i class="right fas"></i>
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('edit-profile') }}" class="nav-link {{ request()->route()->getName() == 'edit-profile' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>
                                    Ganti Password
                                    <i class="right fas"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="logout()">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Logout
                                    <i class="right fas"></i>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content-header')

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <!-- ./wrapper -->

    @include('assets.scripts')
    <script>
        function logout() {
            fetch("{{ route('logout') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = "{{ route('login') }}"
                } else {
                    console.error('Logout failed!')
                }
            });
        }
    </script>
</body>

</html>