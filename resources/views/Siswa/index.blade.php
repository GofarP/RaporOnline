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
                    <img src="https://platinumlist.net/guide/wp-content/uploads/2023/03/IMG-worlds-of-adventure.webp"
                    style="height:240px; width:190px " >
                  </div>
                  <div class="col-sm">
                    <div class="table-responsive">
                        <table class="table" width="100%">
                            <tbody>
                                <tr>
                                    <td>NISN:</td>
                                    <td>8392839238</td>
                                </tr>

                                <tr>
                                    <td>Nama:</td>
                                    <td>8392839238</td>
                                </tr>


                                <tr>
                                    <td>Agama:</td>
                                    <td>8392839238</td>
                                </tr>


                                <tr>
                                    <td>Tempat Tanggal Lahir:</td>
                                    <td>8392839238</td>
                                </tr>


                                <tr>
                                    <td>Jenis Kelamin:</td>
                                    <td>8392839238</td>
                                </tr>


                                <tr>
                                    <td>Alamat:</td>
                                    <td>8392839238</td>
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
                        </tr>
                    </thead>

                    <tbody>
                        <td>Sejarah</td>
                        <td>90</td>
                        <td>Anu Siapa ini</td>
                        <td>7E</td>
                        <td>2013-2014</td>
                    </tbody>

            </div>
        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>

    <script>

        $(document).ready(function () {
            $('#table_data').DataTable();
        });

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
