<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Tambah Data Penempatan Siswa
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Tambah Data Penempatan Siswa</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="#" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="email" class="mt-3 mb-2">NISN:</label>
                    <label for="name" class="mt-3 mb-2">...</label>
                </div>

                <div class="mb-3">
                    <label for="name" class="mt-3 mb-2">Nama Siswa:</label>
                    <label for="name" class="mt-3 mb-2">...</label>
                </div>

                <div class="mb-3">
                    <label for="password" class="mt-3 mb-2">Pilih Kelas</label>
                    <select class="form-control @error('id_kelas') is-invalid @enderror" name="id_kelas" id="id_kelas">
                       <option value="">7C</option>
                    </select>
                </div>

                <div class="mb-3">

                </div>


                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Penempatan Siswa" style="border-radius:100px">
                </div>

                </div>

            </form>


        </div>
    </div>
    @endsection

    @extends('partials.footer.javascript')

</body>
</html>
