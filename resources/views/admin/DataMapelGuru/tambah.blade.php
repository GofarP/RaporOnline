<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Tambah Data Mata Pelajaran Guru
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tambah Data Mata Pelajaran Guru</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('store_data_mapel_guru')}}" >
                @csrf

                <div class="mb-3">
                    <label for="email" class="mt-3 mb-2">NIP:</label>
                    <label for="name" class="mt-3 mb-2">{{$data_guru->nip}}</label>
                    <input type="hidden" value="{{$data_guru->nip}}" name="nip"/>

                    @error('nisn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="name" class="mt-3 mb-2">Nama Guru:</label>
                    <label for="name" class="mt-3 mb-2">{{$data_guru->nama}}</label>
                </div>

                <div class="mb-3">
                    <label for="id_mapel" class="mt-3 mb-2">Pilih Mata Pelajaran:</label>
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
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Guru MataPelajaran" style="border-radius:100px">
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
