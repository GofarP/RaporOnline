<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Tambah Data Wali Kelas
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tambah Wali Kelas</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('store_data_wali_kelas')}}">
                @csrf

                <div class="mb-3">
                    <span>NIP: {{$data_guru->nip}} </span>
                    <input type="hidden" value="{{$data_guru->nip}}" name="nip"/>
                </div>

                <div class="mb-3">
                    <span>Nama Guru: {{$data_guru->nama}} </span>
                </div>

                <div class="mb-3">
                    <label for="id_kelas" class="mt-3 mb-2">Kelas:</label>
                    <select class="form-control @error('id_kelas') is-invalid @enderror" name="id_kelas" id="id_kelas">

                        @foreach ($data_kelas as $kelas)
                          <option value="{{$kelas->id_kelas}}">{{$kelas->kelas}}</option>
                        @endforeach

                        @error('id_kelas')
                             <div class="invalid-feedback">
                                 {{ $message }}
                             </div>
                         @enderror

                     </select>
                </div>

                <div class="mb-3">
                    <label for="id_tahun_ajaran" class="mt-3 mb-2">Tahun Ajaran:</label>
                    <select class="form-control @error('id_tahun_ajaran') is-invalid @enderror" name="id_tahun_ajaran" id="id_tahun_ajaran">

                        @foreach ($data_tahun_ajaran as $tahun_ajaran)
                          <option value="{{$tahun_ajaran->id_tahun_ajaran}}">{{$tahun_ajaran->tahun_ajaran}}</option>
                        @endforeach

                        @error('id_tahun_ajaran')
                             <div class="invalid-feedback">
                                 {{ $message }}
                             </div>
                         @enderror

                     </select>
                </div>

                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Wali Kelas" style="border-radius:100px">
                </div>

                </div>

            </form>

        </div>
    </div>
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>

    @extends('partials.footer.javascript')

    <script>
         $(function(){

            @if(Session::has('error'))
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
