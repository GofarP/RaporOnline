<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Guru
    @endsection


</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data guru</h6>
        </div>

        <div class="card-body">
            <a href="{{route('create_data_guru')}}" class="btn btn-success float-right mb-3">Tambah Data Guru</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="table_data" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Agama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>2011/04/25</td>
                            <td>$320,800</td>
                            <td>Foto</td>
                            <td>S4</td>
                            <td>
                                <a href="#" class="btn btn-warning">Edit</a>
                                <br>
                                <button href="#" class="btn btn-danger mt-3">Hapus</button>
                            </td>
                        </tr>
                    </tbody>

            </div>
        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>

    <script>

        $(document).ready(function () {
            $('#table_data').DataTable();
        });

    </script>

</body>
</html>
