<!DOCTYPE html>
<html lang="en">

<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Edit Atur Mata Pelajaran
    @endsection

    <script src="{{ url('/bs/js/jquery.min.js') }}"></script>
</head>

<body>
    @extends('partials.sidebar.sidebar')

    @section('content')
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Edit Atur Mata Peljaran</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="{{route('update_atur_mata_pelajaran',$data_atur_mapel->id_atur_mata_pelajaran)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="id_mapel" class="mt-3 mb-2">ID Mata Pelajaran:</label>
                        <label class="mt-3 mb-2">{{ $data_atur_mapel->id_mata_pelajaran}}</label>
                        <input type="hidden" name="id_mata_pelajaran" value="{{ $data_atur_mapel->id_mata_pelajaran }}">
                    </div>

                    <div class="mb-3">
                        <label class="mt-3 mb-2">Nama Mata Pelajaran:</label>
                        <label class="mt-3 mb-2">{{ $data_mapel->nama}}</label>
                    </div>

                    <div class="mb-3">
                        <label class="mt-3 mb-2">Kelas:</label>
                        <select class="form-control @error('id_kelas') is-invalid @enderror" name="id_kelas" id="id_kelas">
                            @foreach ($data_kelas as $data)
                                <option value="{{ $data->id_kelas }}">{{ $data->kelas }}</option>
                            @endforeach

                            @error('id_kelas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="mt-3 mb-2">Tahun Ajaran</label>
                        <select class="form-control  @error('id_tahun_ajaran') is-invalid @enderror" name="id_tahun_ajaran"
                            id="id_tahun_ajaran">
                            @foreach ($data_tahun_ajaran as $data)
                                <option value="{{ $data->id_tahun_ajaran }}">{{ $data->tahun_ajaran }}</option>
                            @endforeach

                            @error('id_tahun_ajaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </select>
                    </div>


                    <div class="mb-3">
                        <input type="submit" class="form-control btn btn-success mt-3" value="Update Atur Mata Pelajaran"
                            style="border-radius:100px">
                    </div>

            </div>

            </form>

        </div>
        </div>
    @endsection


    <script src="{{url('/bs/js/jquery.min.js')}}"></script>
    @extends('partials.footer.javascript')

    <script>
        $(function() {

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
