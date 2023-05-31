<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Kredensial Guru
    @endsection
</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kredensial guru</h6>
        </div>

        <div class="card-body">
            <a href="{{route('create_kredensial_guru')}}" class="btn btn-success mb-3 float-right">Tambah Kredensial</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($kredensial as $kred )

                        <tr>
                            <td>{{$kred->email}}</td>
                            <td>{{$kred->name}}</td>
                            <td>
                                <a href="{{route('edit_kredensial_guru', $kred->id_users)}}" class="btn btn-warning">Edit</a>
                                <br>

                                <form action="{{route('destroy_kredensial_guru',$kred->id_users)}}" method="POST"
                                    class="d-inline" id="form-delete-kredensial">
                                    @csrf
                                    @method("DELETE")
                                    <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Kredensial Guru Ini?')"  name="btn-hapus" id="btn-hapus">Hapus</button>
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
