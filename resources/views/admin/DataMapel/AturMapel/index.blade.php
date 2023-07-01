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
            <h6 class="m-0 font-weight-bold text-primary">Data Mata Pelajaran Guru</h6>
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tblAtur" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>

                        <tbody>

                            @foreach ($data_atur_mapel as $data)
                            <tr>
                                <td>{{$data->id_atur_mata_pelajaran}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->kelas}}</td>
                                <td>{{$data->tahun_ajaran}}</td>
                                <td>
                                    <a href="{{route('update_atur_mata_pelajaran',$data->id_atur_mata_pelajaran)}}" class="btn btn-warning">Edit</a>
                                    <br>
                                    <form action="{{route('destroy_atur_mata_pelajaran',$data->id_atur_mata_pelajaran)}}" method="POST"
                                        class="d-inline" id="form-delete-kredensial">
                                        @csrf
                                        @method("DELETE")
                                        <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Data Ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

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
                <table class="table table-bordered" id="tableMapel" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($data_mapel as  $data)
                        <tr>
                            <td>{{$data->id_mapel}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->agama}}</td>
                            <td>
                                <a href="{{route('create_atur_mata_pelajaran',$data->id_mapel)}}" class="btn btn-primary">Tambah</a>
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
