<!DOCTYPE html>
<html lang="en">

<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Admin|Data Nilai Siswa
    @endsection

    <script src="{{ url('/bs/js/jquery.min.js') }}"></script>
</head>

<body>
    @extends('partials.sidebar.sidebar')

    @section('content')
        <div class="card shadow mb-4 w-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> Tambah Data NIlai Siswa</h6>
            </div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin_store_data_nilai_siswa')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="mt-3 mb-2">NISN:</label>
                        <label for="name" class="mt-3 mb-2">{{ $data_siswa->nisn }}</label>
                        <input type="hidden" value="{{ $data_siswa->nisn }}" name="nisn" />

                        @error('nisn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="mb-3">
                        <label for="name" class="mt-3 mb-2">Nama Siswa:</label>
                        <label for="name" class="mt-3 mb-2">{{ $data_siswa->nama }}</label>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="mt-3 mb-2">Tahun Ajaran:</label>
                        <label for="name" class="mt-3 mb-2">{{ $data_tahun_ajaran->tahunajaran->tahun_ajaran }}</label>
                    </div>

                    <div class="mb-3">
                        <label for="semeter" class="mt-3 mb-2">Semester:</label>
                        <label for="semester" class="mt-3 mb-2">{{ $data_tahun_ajaran->semester }}</label>
                    </div>

                    <div class="mb-3">
                        <label for="id_mapel" class="mt-3 mb-2">Pilih Mata Pelajaran</label>
                        <select class="form-control @error('id_mapel') is-invalid @enderror" name="id_mapel"
                            id="selectMapel" onchange="getMapel()">
                            @foreach ($data_mapel as $mapel)
                                <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama }}</option>
                            @endforeach

                            @error('id_mapel')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="nip" class="mt-3 mb-2">Pilih Guru</label>
                        <select class="form-control @error('nip') is-invalid @enderror" name="nip"
                            id="selectGuru">

                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nilai">Nilai Siswa:</label>
                        <input type="number" class="form-control" name="nilai" id="nilai">

                        @error('nip')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <input type="submit" class="form-control btn btn-success mt-3" value="Tambah Nilai Siswa"
                            style="border-radius:100px">
                    </div>

            </div>

            </form>


        </div>
        </div>
    @endsection


    @extends('partials.footer.javascript')

    <script>

        window.onload=function(){
            getMapel();
        }

        function getMapel() {

            var idMapel = document.getElementById("selectMapel").value;
            const selectGuru = document.getElementById('selectGuru');
            let options = selectGuru.getElementsByTagName('option');
            const url = "/admin/nilaisiswa/dataguru/" + idMapel;

            for(var i=selectGuru.length;i--;) {
                selectGuru.removeChild(selectGuru[i]);
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {

                    data.forEach(guru => {
                        const option = document.createElement('option');
                        option.value = guru.nip;
                        option.textContent = guru.nama;
                        selectGuru.appendChild(option);
                    });
                })
                .catch(error => {
                    // Tangani kesalahan jika terjadi
                    console.error('Terjadi kesalahan:', error);
                });

        }


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
