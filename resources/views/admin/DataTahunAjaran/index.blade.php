<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Tahun Ajaran
    @endsection
</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Tahun Ajaran</h6>
        </div>

        <div class="card-body">
            <a href="{{route('create_data_tahun_ajaran')}}" class="btn btn-success float-right mb-3">Tambah Tahun Ajaran</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Tahun Ajaran</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @foreach ($tahun_ajaran as $tahun_ajaran )
                        <tr>
                            <td>{{$tahun_ajaran->id_tahun_ajaran}}</td>
                            <td>{{$tahun_ajaran->tahun_ajaran}}</td>
                            <td>
                                <a href="{{route('edit_data_tahun_ajaran', $tahun_ajaran->id_tahun_ajaran)}}" class="btn btn-warning">Edit</a>
                                <br>
                                <form action="{{route('destroy_data_tahun_ajaran',$tahun_ajaran->id_tahun_ajaran)}}" method="POST"
                                    class="d-inline" id="form-delete-kredensial">
                                    @csrf
                                    @method("DELETE")
                                    <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Kredensial Siswa Ini?')"  name="btn-hapus" id="btn-hapus">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

            </div>
        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>

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
