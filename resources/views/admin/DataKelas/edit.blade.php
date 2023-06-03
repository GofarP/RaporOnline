<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
       Edit Kelas
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Kelas</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('update_data_kelas',$data_kelas->id_kelas)}}">
                @csrf
                @method('PUT')


                <div class="mb-3">
                    <label for="kelas" class="mt-3 mb-2">Nama Kelas:</label>
                    <input type="text" name="kelas" id="Kelas" placeholder="Masukkan Kelas"  data-parsley-required="true"
                        class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas',$data_kelas->kelas) }}">
                        @error('kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Update Data Siswa" style="border-radius:100px">
                </div>

                </div>

            </form>


        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')


</body>
</html>
