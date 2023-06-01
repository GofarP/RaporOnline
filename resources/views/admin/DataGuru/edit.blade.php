<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Edit Data Guru
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Data guru</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="#" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="mb-3">
                    <label for="nip" class="mt-3 mb-2">NIP Guru:</label>
                    <input type="text" name="nip" id="nip" placeholder="Masukkan NIP Guru"  data-parsley-required="true"
                        class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip',$data_guru->nip) }}">
                        @error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="nama" class="mt-3 mb-2">Nama Guru:</label>
                    <input type="text" name="nama" id="nama" placeholder="Masukkan nama Guru"  data-parsley-required="true"
                        class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$data_guru->nama) }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="agama" class="mt-3 mb-2">Agama Guru:</label>
                    <select class="form-control @error('agama') is-invalid @enderror" name="agama" id="agama">
                        <option value="{{$data_guru->agama == "Islam" ? 'selected' : ''}}">Islam</option>
                        <option value="{{$data_guru->agama == "Protestan" ? 'selected' : ''}}">Protestan</option>
                        <option value="{{$data_guru->agama == "Katolik" ? 'selected' : ''}}">Katolik</option>
                        <option value="{{$data_guru->agama == "Hindu" ? 'selected' : ''}}">Hindu</option>
                        <option value="{{$data_guru->agama == "Buddha" ? 'selected' : ''}}">Buddha</option>
                        <option value="{{$data_guru->agama == "Konghucu" ? 'selected' : ''}}">Konghucu</option>
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
                        <option value="{{$data_guru->jenis_kelamin == "Pria" ? 'selected' : ''}}">Pria</option>
                        <option value="{{$data_guru->jenis_kelamin == "Wanita" ? 'selected' : ''}}">Wanita</option>
                    </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="alamat" class="mt-3 mb-2">Alamat Guru:</label>
                    <input type="text" name="alamat" id="alamat" placeholder="Masukkan Alamat Guru"  data-parsley-required="true"
                        class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat',$data_guru->alamat) }}">
                        @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="pedidikan_terakhir" class="mt-3 mb-2">Pendidikan Terakhir:</label>
                    <input type="text" name="pendidikan_terakhir" id="alamat" placeholder="Masukkan Pendidikan Terakhir Guru"  data-parsley-required="true"
                        class="form-control @error('pendidikan_terakhir') is-invalid @enderror" value="{{ old('pendidikan_terakhir',$data_guru->pendidikan_terakhir) }}">
                        @error('pendidikan_terakhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="tempat_lahir" class="mt-3 mb-2">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Masukkan Tempat Lahir Guru"  data-parsley-required="true"
                        class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir',$data_guru->tempat_lahir) }}">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="mb-3">

                    <label for="tanggal_lahir" class="mt-3 mb-2">Tanggal Lahir:</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                    value="{{old('tanggal_lahir',$data_guru->tanggal_lahir)}}" placeholder="Tanggal-Bulan-Tahun" readOnly="true">
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
                        <label for="alamat" class="mt-3 mb-2">Foto Guru:</label>
                        <input type="file" name="foto" id="foto"
                        class="form-control-file @error('foto') is-invalid @enderror" onchange="previewImage()">
                        @if($data_guru->foto)
                            <img src="{{ asset('storage/' . $data_guru->foto) }}"
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
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Data Guru" style="border-radius:100px">
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
