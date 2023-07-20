<!DOCTYPE html>
<html lang="en">

<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Data Murid
    @endsection
</head>

<body id="page-top">

    @extends('partials.sidebar.sidebar')

    @section('content')
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Murid</h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="tblMurid" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Action</th>
                            </tr>

                        <tbody>

                            @foreach ($data_murid_kelas as $data)
                                <tr>
                                    <td>{{ $data->nisn }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->tahun_ajaran }}</td>
                                    <td>
                                        <a href="{{ route('cetak_rapor', $data->nisn) }}" class="btn btn-warning">Cetak
                                            Rapor</a>
                                        <br>
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
                <h6 class="m-0 font-weight-bold text-primary">Ranking Murid</h6>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="tblRanking" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tahun Ajaran</th>
                                <th>Ranking</th>
                                <th>Action</th>
                            </tr>

                        <tbody>


                            @foreach ($data_ranking as $data)
                                <tr data-nisn="{{ $data['NISN'] }}" data-nama="{{ $data['nama'] }}"
                                    data-kelas="{{ $data['kelas'] }}" data-tahunajaran="{{ $data['tahunajaran'] }}"
                                    data-ranking="{{ $data['ranking'] }}">
                                <tr>
                                    <td>{{ $data['NISN'] }}</td>
                                    <td>{{ $data['nama'] }}</td>
                                    <td>{{ $data['kelas'] }}</td>
                                    <td>{{ $data['tahunajaran'] }}</td>
                                    <td>{{ $data['ranking'] }}</td>
                                    <td>
                                        <a href="{{route('cetak_sertifikat',[$data['NISN'],$data['ranking']])}}" class="btn btn-success">Cetak Sertifikat</a>
                                    </td>
                                </tr>
                                </tr>
                            @endforeach
                        </form>

                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    @endsection

    @extends('partials.footer.javascript')

    <script src="{{ url('/bs/js/jquery.min.js') }}"></script>

    <script>
        $(function() {

            $(document).ready(function() {
                $('#tblMurid').DataTable();
            });



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
