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
            <a href="{{route('create_data_kelas')}}" class="btn btn-success float-right mb-3">Tambah Data Kelas</a>
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

                    @foreach ($data_kelas as $kelas)
                        <tr>
                            <td>{{$kelas->id_kelas}}</td>
                            <td>{{$kelas->kelas}}</td>
                            <td>
                                <a href="{{route('edit_data_kelas')}}" class="btn btn-warning">Edit</a>
                                <br>
                                <form action="{{route('destroy_data_kelas',$kelas->id_kelas)}}" method="POST"
                                    class="d-inline" id="form-delete-data-guru">
                                    @csrf
                                    @method("DELETE")
                                    <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Data Guru Ini?')"  name="btn-hapus" id="btn-hapus">Hapus</button>
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
