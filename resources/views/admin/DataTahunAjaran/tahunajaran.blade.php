<!DOCTYPE html>
<html lang="en">

<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Tetapkan Data Tahun Ajaran
    @endsection

    <script src="{{ url('/bs/js/jquery.min.js') }}"></script>

</head>

<body>
    @extends('partials.sidebar.sidebar')

    @section('content')
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Tetapkan Data Tahun Ajaran</h6>
            </div>

            <div class="card-body">

                @if ($tahun_ajaran_aktif != null)
                    <form method="POST" action="{{ route('update_tahun_ajaran_aktif', 1) }}">
                        @csrf
                        @method('PUT')
                        <h4>Ada Tahun Ajaran</h4>
                    @else
                        <form method="POST" action="{{ route('set_tahun_ajaran_aktif') }}">
                            <h4>Tiada Tahun Ajaran</h4>
                            @csrf
                @endif
                <div class="mb-3">

                    <label for="" class="mt-3 mb-2">Tetapkan Tahun Ajaran:</label>

                    <select class="form-control @error('id_tahun_ajaran') is-invalid @enderror" name="id_tahun_ajaran"
                        id="id_tahun_ajaran">
                        @foreach ($data_tahun_ajaran as $tahun_ajaran)
                            <option value="{{ $tahun_ajaran->id_tahun_ajaran }}">{{ $tahun_ajaran->tahun_ajaran }}</option>
                        @endforeach
                    </select>

                    @error('id_tahun_ajaran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="mb-3">

                    <label for="semester" class="mt-3 mb-2">Semester:</label>

                    <select class="form-control @error('semester') is-invalid @enderror" name="semester" id="semester">
                        <option value="Ganjil">Ganjil</option>
                        <option value="Genap">Genap</option>
                    </select>

                    @error('semester')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Tetapkan Tahun Ajaran"
                        style="border-radius:100px">
                </div>


            </div>

        </div>





        </div>

        </form>

        </div>
        </div>
    @endsection

    @extends('partials.footer.javascript')

    <script>
        $(function() {

            $('#datepicker_tahun_awal').datepicker({
                format: 'yyyy',
                viewMode: "years",
                minViewMode: "years"
            });

            $('#datepickertahun_akhir').datepicker({
                format: 'yyyy',
                viewMode: "years",
                minViewMode: "years"
            });

            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Operasi Sukses',
                    text: '{{ Session::get('success') }}'
                })
            @elseif (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Operasi Gagal',
                    text: '{{ Session::get('error') }}'
                })
            @endif
        });
    </script>


</body>

</html>
