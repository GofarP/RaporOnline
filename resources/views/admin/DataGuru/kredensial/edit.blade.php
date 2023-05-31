<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Edit Kredensial Guru
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Kredensial guru</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('update_kredensial_guru',$user->id_users)}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="email" class="mt-3 mb-2">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Masukkan Email Kredensial Guru"  data-parsley-required="true"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email',$user->email) }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="mt-3 mb-2">Nama:</label>
                    <input type="text" name="name" id="name" placeholder="Masukkan Nama Guru"  data-parsley-required="true"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$user->name) }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="mt-3 mb-2">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password"  data-parsley-required="true"
                        class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="mt-3 mb-2">Konfirmasi Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Masukkan Konfirmasi Password"  data-parsley-required="true"
                    class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                </div>


                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Update Kredensial Guru" style="border-radius:100px">
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
