<div id="wrapper">
    <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">


            <!-- Admin -->

            <!-- Divider -->
            <hr class="sidebar-divider">

                     <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin_home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Menu Data Guru -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataGuru"
                    aria-expanded="true" aria-controls="collapseDataGuru">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Guru</span>
                </a>
                <div id="collapseDataGuru" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Guru:</h6>
                        <a class="collapse-item" href="{{route('index_data_guru')}}">Lihat Data</a>
                        <a class="collapse-item" href="{{route('create_data_guru')}}">Tambah Data</a>
                        <a class="collapse-item" href="{{route('index_kredensial_guru')}}">Lihat Kredensial</a>
                        <a class="collapse-item" href="{{route('create_kredensial_guru')}}">Tambah Kredensial</a>
                    </div>
                </div>
            </li>

            <!-- Menu Data Siswa -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataSiswa"
                    aria-expanded="true" aria-controls="collapSeDataSiswa">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Siswa</span>
                </a>
                <div id="collapseDataSiswa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Siswa:</h6>
                        <a class="collapse-item" href="{{route('index_data_siswa')}}">Lihat Data</a>
                        <a class="collapse-item" href="{{route('create_data_siswa')}}">Tambah Data</a>
                        <a class="collapse-item" href="{{route('index_kredensial_siswa')}}">Lihat Kredensial</a>
                        <a class="collapse-item" href="{{route('create_kredensial_siswa')}}">Tambah Kredensial</a>
                    </div>
                </div>
            </li>

              <!-- Menu MataPelajaran -->
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataMapel"
                    aria-expanded="true" aria-controls="collapseDataMapel">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Mata Pelajaran</span>
                </a>
                <div id="collapseDataMapel" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Mata Pelajaran:</h6>
                        <a class="collapse-item" href="{{route('index_data_mata_pelajaran')}}">Lihat Data</a>
                        <a class="collapse-item" href="{{route('create_data_mata_pelajaran')}}">Tambah Data</a>
                    </div>
                </div>
              </li>

                <!-- Menu Nilai Siswa -->
               <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNilaiSiswa"
                        aria-expanded="true" aria-controls="collapseNilaiSiswa">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Nilai Siswa</span>
                    </a>

                    <div id="collapseNilaiSiswa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Nilai Siswa:</h6>
                            <a class="collapse-item" href="">Lihat Nilai Siswa</a>
                            <a class="collapse-item" href="cards.html">Tambah Nilai Siswa</a>
                        </div>
                    </div>
                </li>


                <!-- Mata Pelajaran Guru -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMapelGuru"
                        aria-expanded="true" aria-controls="collapseMapelGuru">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Mapel Guru</span>
                    </a>

                    <div id="collapseMapelGuru" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Mapel Guru:</h6>
                            <a class="collapse-item" href="">Lihat Mapel Guru</a>
                            <a class="collapse-item" href="cards.html">Tambah Mapel Guru</a>
                        </div>
                    </div>
                </li>



                   <!-- Penempatan Siswa -->
                   <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePenempatanSiswa"
                        aria-expanded="true" aria-controls="collapsePenempatanSiswa">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Penempatan Siswa</span>
                    </a>
                    <div id="collapsePenempatanSiswa" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Penempatan Siswa:</h6>
                            <a class="collapse-item" href="{{route('index_data_penempatan_siswa')}}">Lihat Penempatan Siswa</a>
                        </div>
                    </div>
                </li>

                  <!-- Tahun Ajaran -->
                  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTahunAjaran"
                        aria-expanded="true" aria-controls="collapseTahunAjaran">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Tahun Ajaran</span>
                    </a>
                    <div id="collapseTahunAjaran" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Tahun Ajaran:</h6>
                            <a class="collapse-item" href="{{route('index_data_tahun_ajaran')}}">Lihat Tahun Ajaran</a>
                            <a class="collapse-item" href="{{route('create_data_tahun_ajaran')}}">Tambah Tahun Ajaran</a>
                        </div>
                    </div>
                </li>


                <!-- Kelas -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKelas"
                        aria-expanded="true" aria-controls="collapseKelas">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Kelas</span>
                    </a>
                    <div id="collapseKelas" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Kelas:</h6>
                            <a class="collapse-item" href="{{route('index_data_kelas')}}">Lihat Kelas</a>
                            <a class="collapse-item" href="{{route('create_data_kelas')}}">Tambah Kelas</a>
                        </div>
                    </div>
                </li>



            <!-- Divider -->
            <hr class="sidebar-divider">


                    <!--Guru-->
                <!-- Heading -->
                <div class="sidebar-heading">
                    Guru
                </div>


                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a>
                </li>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">

                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Nilai Siswa</span>
                    </a>

                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Nilai Siswa:</h6>
                            <a class="collapse-item" href="{{route('nilaisiswa.index')}}">Data Nilai Siswa</a>
                            <a class="collapse-item" href="{{route('nilaisiswa.create')}}">Tambah Nilai Siswa</a>
                        </div>
                    </div>
                </li>


                <!-- Divider -->
                <hr class="sidebar-divider">


                        <!--Siswa-->
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Siswa
                    </div>

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Lihat Nilai</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">


                <li class="nav-item">
                    <a class="nav-link" href="" onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                        <i class="fas fa-fw fa-power-off" ></i>
                        <span>Logout</span></a>

                    <form id="logout-form-admin" action="{{route('logout')}}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>




            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="{{url('img/undraw_rocket.svg')}}" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>

        </ul>
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div id="content-wrapper">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                            aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                        placeholder="Search for..." aria-label="Search"
                                        aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @yield('content-header')
                </div>

                <!-- Content Row -->
                <div class="row">
                    @yield('content')
                </div>



            </div>
            <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    @extends('partials.footer.javascript')
</div>
