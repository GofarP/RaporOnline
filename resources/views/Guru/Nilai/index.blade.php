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
                <h6 class="m-0 font-weight-bold text-primary">Data Nilai Siswa</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>

                            <tbody>

                            @foreach ($data_nilai as $data )
                                <td>{{$data->NISN}}</td>
                                <td>{{$data->nama_siswa}}</td>
                                <td>{{$data->kelas}}</td>
                                <td>{{$data->nama_mapel}}</td>
                                <td>{{$data->nilai}}</td>
                                <td>{{$data->tahun_ajaran}}</td>
                                <td>
                                    <a href="{{route('edit_data_nilai_siswa',$data->id_nilai_master)}}" class="btn btn-warning">Edit Nilai</a>
                                    <br>
                                    <form action="{{route('destroy_data_nilai_siswa',$data->id_nilai_master)}}"
                                        method="POST"  class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button class="btn btn-danger mt-3" onclick="return confirm('Apakah Anda Ingin Menghapus Data Nilai Siswa Ini?')" >Hapus Nilai</button>
                                    </form>
                                </td>
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
                    <table class="table table-bordered" id="tblSiswa" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>

                            <?php $no=1; ?>
                            @foreach ($data_penempatan_siswa as $data )
                            <tbody>
                                <td>{{$no}}</td>
                                <td>{{$data->nisn}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->kelas}}</td>
                                <td>{{$data->tahun_ajaran}}</td>
                                <td>
                                    <a href="{{route('create_data_nilai_siswa',$data->id_penempatan_siswa)}}" class="btn btn-success mb-2">Tambah Nilai</a>
                                </td>
                            </tbody>
                            <?php $no++ ?>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>

        </div>




    @endsection



    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
    @extends('partials.footer.javascript')

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
