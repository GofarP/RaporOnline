<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data MataPelajaran Guru
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
                <table class="table table-bordered" id="tblGuru" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Action</th>
                        </tr>

                        <tbody>

                            @foreach ($data_mapel_guru as $datamapelguru)
                            <tr>
                                <td>{{$datamapelguru->nip}}</td>
                                <td>{{$datamapelguru->nama_guru}}</td>
                                <td>{{$datamapelguru->nama_mapel}}</td>
                                <td>
                                    <a href="{{route('edit_data_mapel_guru',$datamapelguru->id_mapel_guru)}}" class="btn btn-warning">Edit</a>
                                    <br>
                                    <form action="{{route('destroy_data_mapel_guru',$datamapelguru->id_mapel_guru)}}" method="POST"
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

                        @foreach ($data_guru as  $guru)
                        <tr>
                            <td>{{$guru->nip}}</td>
                            <td>{{$guru->nama}}</td>
                            <td>{{$guru->agama}}</td>
                            <td>{{$guru->tempat_lahir}}, {{$guru->tanggal_lahir}}</td>
                            <td>{{$guru->jenis_kelamin}}</td>
                            <td>{{$guru->alamat}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$guru->foto) }}" class="w-50 h-50">
                            </td>
                            <td>{{$guru->pendidikan_terakhir}}</td>
                            <td>
                                <a href="{{route('create_data_mapel_guru',$guru->nip)}}" class="btn btn-primary">Tambah</a>
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
                $('#tblGuru').DataTable();
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
