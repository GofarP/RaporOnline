<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Update Data Penempatan Siswa
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Update Data Penempatan Siswa</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('update_data_penempatan_siswa',$data_penempatan->id_penempatan_siswa)}}" >
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="mt-3 mb-2">NISN:</label>
                    <label  class="mt-3 mb-2">{{$data_penempatan->nisn}}</label>
                    <input type="hidden" value="{{$data_penempatan->nisn}}" name="nisn"/>

                    @error('nisn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-3">
                    <label for="name" class="mt-3 mb-2">Nama Siswa:</label>
                    <label for="name" class="mt-3 mb-2">{{$data_penempatan->nama}}</label>
                </div>

                <div class="mb-3">
                    <label for="id_kelas" class="mt-3 mb-2">Pilih Kelas</label>
                    <select class="form-control @error('id_kelas') is-invalid @enderror" name="id_kelas" id="id_kelas">
                       @foreach ($data_kelas as $kelas)
                         <option value="{{$kelas->id_kelas}}" {{$kelas->id_kelas==$kelas->id_kelas ? 'selected' : ''}}>{{$kelas->kelas}}</option>
                       @endforeach

                       @error('id_kelas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </select>
                </div>

                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Update Penempatan Siswa" style="border-radius:100px">
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
