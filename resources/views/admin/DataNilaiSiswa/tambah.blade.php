<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Admin|Data Nilai Siswa
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tambah Data NIlai Siswa</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('store_data_penempatan_siswa')}}" >
                @csrf

                <div class="mb-3">
                    <label for="email" class="mt-3 mb-2">NISN:</label>
                    <label for="name" class="mt-3 mb-2">{{$data_siswa->nisn}}</label>
                    <input type="hidden" value="{{$data_siswa->nisn}}" name="nisn"/>

                    @error('nisn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="name" class="mt-3 mb-2">Nama Siswa:</label>
                    <label for="name" class="mt-3 mb-2">{{$data_siswa->nama}}</label>
                </div>

                <div class="mb-3">
                    <label for="name" class="mt-3 mb-2">Tahun Ajaran:</label>
                    <label for="name" class="mt-3 mb-2">{{$data_tahun_ajaran->tahun_ajaran_aktif}}</label>
                </div>

                <div class="mb-3">
                    <label for="semeter" class="mt-3 mb-2">Semester</label>
                    <label for="semester" class="mt-3 mb-2">{{$data_tahun_ajaran->semester}}</label>
                </div>

                <div class="mb-3">
                    <label for="id_mapel" class="mt-3 mb-2">Pilih Mata Pelajaran</label>
                    <select class="form-control @error('id_mapel') is-invalid @enderror" name="id_mapel" id="id_kelas">
                       @foreach ($data_mapel as $mapel)
                         <option value="{{$mapel->id_mapel}}">{{$mapel->mapel}}</option>
                       @endforeach

                       @error('id_mapel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </select>
                </div>


                <div class="mb-3">
                    <label for="id_kelas" class="mt-3 mb-2">Pilih Guru</label>
                    <select class="form-control @error('id_tahun_ajaran') is-invalid @enderror" name="id_tahun_ajaran" id="id_kelas">
                         <option value=""></option>

                    </select>
                </div>


                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Nilai Siswa" style="border-radius:100px">
                </div>

                </div>

            </form>


        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')

    <script>


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
