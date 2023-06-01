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

    <div class="card shadow mb-4 w-100">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kelas</h6>
        </div>

        <div class="card-body">
            <a href="btn btn-success mb-3 float-right">Tambah Kelas</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Kelas</th>
                            <th>Kelas</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>System Architect</td>
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

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
    @extends('partials.footer.javascript')

    <script>


        $(function(){

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
