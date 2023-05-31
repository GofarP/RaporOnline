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
            <h6 class="m-0 font-weight-bold text-primary"> Tambah Data Mata Pelajaran</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="#">
                @csrf



                <div class="mb-3">
                    <label for="nama" class="mt-3 mb-2">Nama Mata Pelajaran:</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Mata Pelajaran"  data-parsley-required="true"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Data Siswa" style="border-radius:100px">
                </div>

                </div>

            </form>


        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')



</body>
</html>
