<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Penempatan Siswa
    @endsection
</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penempatan Siswa</h6>
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

                            @foreach ($data_penempatan as $penempatan)
                            <tr>
                                <td>{{$penempatan->nisn}}</td>
                                <td>{{$penempatan->nama}}</td>
                                <td>{{$penempatan->kelas}}</td>
                                <td>{{$penempatan->tahun_ajaran}}</td>
                                <td>
                                    <a href="{{route('edit_data_penempatan_siswa',$penempatan->id_penempatan_siswa)}}" class="btn btn-warning">Edit</a>
                                    <br>
                                    <form action="{{route('destroy_data_penempatan_siswa',$penempatan->id_penempatan_siswa)}}" method="POST"
                                        class="d-inline" id="form-delete-kredensial">
                                        @csrf
                                        @method("DELETE")
                                        <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Data Penempatan Siswa Ini?')">Hapus</button>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Agama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($data_siswa as  $data)
                        <tr>
                            <td>{{$data->nisn}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->agama}}</td>
                            <td>{{$data->tempat_lahir}}, {{$data->tanggal_lahir}}</td>
                            <td>{{$data->jenis_kelamin}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$data->foto) }}" class="w-50 h-50">
                            </td>
                            <td>
                                <a href="{{route('create_data_penempatan_siswa',$data->nisn)}}" class="btn btn-primary">Tambah</a>
                                <br>

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
