<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Nilai Siswa
    @endsection
</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

        <div class="card shadow mb-4 w-100">

            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Nilai Siswa</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>Tahun Ajaran</th>
                            </tr>

                            <tbody>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>

        </div>

        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="tblSiswa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>

                            <tbody>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="#" class="btn btn-success mb-2">Tambah Nilai</a>
                                    <br>
                                    <a href="#" class="btn btn-warning mb-2">Edit Nilai</a>
                                    <br>
                                    <a href="#" class="btn btn-danger mb-2">Hapus Nilai</a>
                                </td>
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>

        </div>




    @endsection



    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
    @extends('partials.footer.javascript')

    <script>


        $(function(){

            $(document).ready(function () {
                $('#tblSiswa').DataTable();
            });

            @if(Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Operasi Sukses',
                    text: '{{ Session::get("success") }}'
                })

            @elseif(Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Operasi Gagal',
                text: '{{ Session::get("error") }}'
                })

            @endif
        });

    </script>

</body>
</html>
