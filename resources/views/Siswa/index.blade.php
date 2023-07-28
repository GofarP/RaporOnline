<!DOCTYPE html>
<html lang="en">

<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Nilai Siswa
    @endsection


</head>

<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pribadi Siswa</h6>
            </div>

            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm text-center">
                            <img src="{{ asset('storage/' . $data_siswa->foto) }}" style="height:240px; width:190px ">
                        </div>
                        <div class="col-sm">
                            <div class="table-responsive">
                                <table class="table" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>NISN:</td>
                                            <td>{{ $data_siswa->nisn }}</td>
                                        </tr>

                                        <tr>
                                            <td>Nama:</td>
                                            <td>{{ $data_siswa->nama }}</td>
                                        </tr>


                                        <tr>
                                            <td>Agama:</td>
                                            <td>{{ $data_siswa->agama }}</td>
                                        </tr>


                                        <tr>
                                            <td>Tempat Tanggal Lahir:</td>
                                            <td>{{ $data_siswa->tempat_lahir, $data_siswa->tanggal_lahir }}</td>
                                        </tr>


                                        <tr>
                                            <td>Jenis Kelamin:</td>
                                            <td>{{ $data_siswa->jenis_kelamin }}</td>
                                        </tr>


                                        <tr>
                                            <td>Alamat:</td>
                                            <td>{{ $data_siswa->alamat }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Nilai Siswa</h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="table_data" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>Guru</th>
                                <th>Kelas</th>
                                <th>tahun Ajaran</th>
                                <th>Semester</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($data_nilai as $data)
                                <tr>
                                    <td>{{ $data->nama_mapel }}</td>
                                    <td>{{ $data->nilai }}</td>
                                    <td>{{ $data->nama_guru }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->tahun_ajaran }}</td>
                                    <td>{{$data->semester}}</td>
                                </tr>
                            @endforeach

                        </tbody>

                </div>
            </div>
        </div>
    @endsection

    @extends('partials.footer.javascript')

    <script src="{{ url('/bs/js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table_data').DataTable();
        });

        $(function() {

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Operasi Sukses',
                    text: '{{ Session::get('success') }}'
                })
            @elseif (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Operasi Gagal',
                    text: '{{ Session::get('error') }}'
                })
            @endif
        });
    </script>

</body>

</html>
