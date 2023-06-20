<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Tambah Data Mata Pelajaran
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tambah Nilai Siswa</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('store_data_nilai_siswa',$data_penempatan_siswa->id_penempatan_siswa)}}">
                @csrf

                <div class="mb-3">
                    <span>NISN: {{$data_penempatan_siswa->nisn}} </span>
                </div>

                <div class="mb-3">
                    <span>Nama Siswa: {{$data_siswa->nama}} </span>
                </div>

                <div class="mb-3">
                    <span>Kelas: {{$data_kelas->kelas}} </span>
                </div>

                <div class="mb-3">

                    <label for="id_mapel" class="mt-3 mb-2">Nama Mata Pelajaran:</label>

                    <select class="form-control @error('id_mapel') is-invalid @enderror" name="id_mapel" id="id_mapel">

                        @foreach ($data_mapel as $mapel)
                          <option value="{{$mapel->id_mapel}}">{{$mapel->nama}}</option>
                        @endforeach

                        @error('id_mapel')
                             <div class="invalid-feedback">
                                 {{ $message }}
                             </div>
                         @enderror

                     </select>

                </div>

                <div class="mb-3">
                    <label for="nilai" class="mt-3 mb-2">Nilai Mata Pelajaran:</label>
                    <input type="number" name="nilai" id="nilai" placeholder="Masukkan Nilai Mata Pelajaran"  data-parsley-required="true"
                        class="form-control @error('nilai') is-invalid @enderror" value="{{ old('nilai') }}">
                        @error('nilai')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                </div>


                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Nilai Mata Pelajaran" style="border-radius:100px">
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
