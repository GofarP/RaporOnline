<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Atur Mata Pelajaran
    @endsection
</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

    <div class="card shadow mb-4 w-100">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Atur Mata Pelajaran</h6>
        </div>

        <div class="card-body">
            <a href="" class="btn btn-success mb-3 float-right">Atur Mata Pelajaran</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-warning">Edit</a>
                                <br>
                                <form action="" method="POST"
                                    class="d-inline" id="form-delete-kredensial">
                                    @csrf
                                    @method("DELETE")
                                    <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Data MataPelajaran Ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

            </div>
        </div>
    </div>

    <div class="card shadow mb-4 w-100">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Mata Pelajaran</h6>
        </div>

        <div class="card-body">
            <a href="" class="btn btn-success mb-3 float-right">Data Mata Pelajaran</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Mapel</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-warning">Edit</a>
                                <br>
                                <form action="" method="POST"
                                    class="d-inline" id="form-delete-kredensial">
                                    @csrf
                                    @method("DELETE")
                                    <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Data MataPelajaran Ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
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
