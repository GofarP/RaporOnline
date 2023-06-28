<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Wali Kelas
    @endsection
</head>
<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')

    <div class="card shadow mb-4 w-100">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Wali Kelas</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="tblWaliKelas" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Wali Kelas</th>
                            <th>Tahun Ajaran</th>
                            <th>Action</th>
                        </tr>

                        <tbody>

                            @foreach ($data_wali_kelas as $data)
                            <tr>
                                <td>{{$data->nip}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->kelas}}</td>
                                <td>{{$data->tahun_ajaran}}</td>
                                <td>
                                    <a href="{{route('edit_data_wali_kelas',$data->id_wali_kelas)}}" class="btn btn-warning">Edit</a>
                                    <br>
                                    <form action="{{route('destroy_data_wali_kelas',$data->id_wali_kelas)}}" method="POST"
                                        class="d-inline" id="form-delete-kredensial">
                                        @csrf
                                        @method("DELETE")
                                        <button href="#" class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Data Wali Kelas Ini?')">Hapus</button>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Guru</h6>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="tblGuru" width="100%" cellspacing="0">
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

                        @foreach ($data_guru as  $data)
                        <tr>
                            <td>{{$data->nip}}</td>
                            <td>{{$data->nama}}</td>
                            <td>{{$data->agama}}</td>
                            <td>{{$data->tempat_lahir}}, {{$data->tanggal_lahir}}</td>
                            <td>{{$data->jenis_kelamin}}</td>
                            <td>{{$data->alamat}}</td>
                            <td>
                                <img src="{{ asset('storage/'.$data->foto) }}" class="w-50 h-50">
                            </td>
                            <td>
                                <a href="{{route('create_data_wali_kelas',$data->nip)}}" class="btn btn-primary">Tambah</a>
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
                $('#tblWaliKelas').DataTable();
            });


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
