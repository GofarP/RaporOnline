<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Tambah Data Siswa
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Data Siswa</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('update_data_siswa',$siswa->nisn)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nisn" class="mt-3 mb-2">NISN Siswa:</label>
                    <input type="number" name="nisn" id="nisn" placeholder="Masukkan NISN Siswa"  data-parsley-required="true"
                        class="form-control @error('nisn') is-invalid @enderror" value="{{ old('nisn',$siswa->nisn) }}">
                        @error('nisn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="nama" class="mt-3 mb-2">Nama Siswa:</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Siswa"  data-parsley-required="true"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$siswa->nama) }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="agama" class="mt-3 mb-2">Agama Siswa:</label>
                    <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama">
                        <option value="Islam" {{$siswa->agama=='Islam' ? 'selected' : ''}}>Islam</option>
                        <option value="Protestan" {{$siswa->agama=='Protestan' ? 'selected' : ''}}>Protestan</option>
                        <option value="Katholik" {{$siswa->agama=='Katholik' ? 'selected' : ''}}>Katolik</option>
                        <option value="Hindu" {{$siswa->agama=='Hindu' ? 'selected' : ''}}>Hindu</option>
                        <option value="Buddha" {{$siswa->agama=='Buddha' ? 'selected' : ''}}>Buddha</option>
                        <option value="Konghucu" {{$siswa->agama=='Konghucu' ? 'selected' : ''}}>Konghucu</option>

                    </select>
                        @error('agama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="mt-3 mb-2">Jenis Kelamin:</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                        <option value="Pria" {{$siswa->jenis_kelamin=="Pria" ? 'selected' : ''}}>Pria</option>
                        <option value="Wanita" {{$siswa->jenis_kelamin=="Wanita" ? 'selected' : ''}}>Wanita</option>
                    </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="alamat" class="mt-3 mb-2">Alamat Siswa:</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat Siswa"  data-parsley-required="true"
                        class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat',$siswa->alamat) }}">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="tempat_lahir" class="mt-3 mb-2">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir Siswa"  data-parsley-required="true"
                        class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir',$siswa->tempat_lahir) }}">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">

                    <label for="tanggal_lahir" class="mt-3 mb-2">Tanggal Lahir:</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                    value="{{old('tanggal_lahir',$siswa->tanggal_lahir)}}" placeholder="Tanggal-Bulan-Tahun" readOnly="true">
                    <span class="input-group-append">
                        <span class="input-group-text text-white bg-success d-block" id="btn_tanggal_lahir">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </span>
                    @error('tanggal_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">
                        <label for="alamat" class="mt-3 mb-2">Foto Siswa:</label>
                        <input type="file" name="foto" id="foto"
                        class="form-control-file @error('foto') is-invalid @enderror" onchange="previewImage()">
                        <br>
                        @if($siswa->foto)
                            <img src="{{ asset('storage/' . $siswa->foto) }}"
                            class="img-preview img-fluid mt-3 mb-3 col-sm-5 " style="width:25%;height:25%">
                        @else
                            <img class="img-preview img-fluid mt-3 mb-3 col-sm-5" style="width:25%;height:25%">
                        @endif

                    @error('foto')
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


    <script>


        $(function() {
            $('#tanggal_lahir').datepicker({
                format: 'dd-mm-yyyy'
            });
        });

        function previewImage()
            {
                    const image = document.querySelector('#foto');
                    const imgPreview = document.querySelector('.img-preview');

                    imgPreview.style.display = "block";

                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);

                    oFReader.onload = function(oFREvent) {
                        imgPreview.src = oFREvent.target.result;
                    }
            }

    </script>

</body>
</html>
