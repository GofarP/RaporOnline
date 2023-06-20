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
            <h6 class="m-0 font-weight-bold text-primary">Data Pribadi Guru</h6>
        </div>

        <div class="card-body">
            <div class="container">
                <div class="row">
                  <div class="col-sm text-center">
                    <img src="{{ asset('storage/'.$data_guru->foto) }}"
                    style="height:240px; width:190px " >
                  </div>
                  <div class="col-sm">
                    <div class="table-responsive">
                        <table class="table" width="100%">
                            <tbody>
                                <tr>
                                    <td>NIP:</td>
                                    <td>{{$data_guru->nip}}</td>
                                </tr>

                                <tr>
                                    <td>Nama:</td>
                                    <td>{{$data_guru->nama}}</td>
                                </tr>


                                <tr>
                                    <td>Agama:</td>
                                    <td>{{$data_guru->agama}}</td>
                                </tr>


                                <tr>
                                    <td>Tempat Tanggal Lahir:</td>
                                    <td>{{$data_guru->tempat_lahir}}, {{$data_guru->tanggal_lahir}}</td>
                                </tr>


                                <tr>
                                    <td>Jenis Kelamin:</td>
                                    <td>{{$data_guru->jenis_kelamin}}</td>
                                </tr>


                                <tr>
                                    <td>Alamat:</td>
                                    <td>{{$data_guru->alamat}}</td>
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
            <h6 class="m-0 font-weight-bold text-primary">Mata Pelajaran Yang Diampu</h6>
        </div>

        <div class="card-body">
            <ul>
                @foreach ($data_mapel_diampu as $data)
                    <li>{{$data->nama}}</li>
                @endforeach
            </ul>
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
