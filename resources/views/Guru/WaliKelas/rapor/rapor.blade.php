<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        .double-line {
            border-top: 3px solid #000;
            position: relative;
            margin-top: 10px;
            margin-left: 7%;
            margin-right: 7%;
        }

        .double-line::before {
            content: "";
            position: absolute;
            top: -3px;
            left: 0;
            width: 11%;
            border-top: 3px solid #000;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table-no-border td,
        .table-no-border th {
            border: none;
        }

        .table-collapse td,
        .table-collapse th {
            border: collapse;
        }

        .box {
            display: flex;
            justify-content: space-between;
            bottom: 0;
            right: 0;
            left: 0;
            position: relative;
            padding: 20px;
        }

        .tanda-tangan {
            width: 50%;
        }

        .tanda-tangan.left {
            text-align: left;
            margin-left: 7%;
        }

        .tanda-tangan.right {
            text-align: right;
            margin-right: 7%;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #000000;
        }
    </style>

</head>

<body>
    <div class="row mt-4">
        <div class="col">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="image-container">
                    <img src="{{ asset('storage/assets/gambar/smpn1jemaja.jpg') }}" alt="Gambar" class="center-image"
                        style="height:100px" />
                </div>
            </div>
        </div>
        <div class="col">
            <h5 class="text-center mt-2">Dinas Pendidikan Kabupaten Anambas</h5>
            <p class="text-center" style="font-weight:bold">SMP Negeri 1 Jemaja</p>
            <p class="text-center" style="font-size:12px; font-weight:bold">Jl. Padang Melang Desa Batu Berapit
                Kecamatan Jemaja
                Telp:082288032273 email:jemaja1smpn@gmail.com
            </p>
        </div>
        <div class="col">
            <div class="col d-flex justify-content-center align-items-center">
                <div class="image-container">
                    <img src="{{ asset('storage/assets/gambar/disdik.png') }}" alt="Gambar" class="center-image"
                        style="height:100px" />
                </div>
            </div>
        </div>

    </div>

    <div class="double-line mb-4"></div>

    <p class="text-center" style="font-size:15px;font-weight:bold">LAPORAN HASIL BELAJAR PESERTA DIDIK <br> SEMESTER
        {{ $data_tahun_ajaran->semester }}
        TAHUN PELAJARAN {{ $data_tahun_ajaran->tahun_ajaran }}</p>

    <div class="table-responsive" style="margin-left:7%; margin-top:4%; width:80%">
        <table class="table table-no-border">
            <tbody>
                <tr>
                    <td style="width:25%">Nama Peserta Didik</td>
                    <td>: {{ $data_siswa->nama }}</td>
                </tr>
                <tr>
                    <td>Nomor Induk Siswa Nasional</td>
                    <td>: {{ $data_siswa->nisn }}</td>
                </tr>
                <tr>
                    <td>Kelas Siswa</td>
                    <td>: {{ $data_siswa->kelas }}</td>
                </tr>
            </tbody>
        </table>
    </div>



    <div class="row text-center">
        <div class="table-responsive" style="margin-left: 9%; margin-right: 9%;">
            <table class="table table-bordered" style="border:1px solid black; border-collapse:collapse; width:100%;">
                <thead>
                    <tr>
                        <th style="width:20%">ID Mata Pelajaran</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_nilai as $data)
                        <tr>
                            <td>{{ $data->id_mapel }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->nilai }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <div class="box">
        <div class="tanda-tangan left">
            <p>Orang Tua Siswa</p>
            <p style="margin-top:8%;">.....................................</p>
        </div>
        <div class="tanda-tangan right">
            <p>Wali Murid</p>
            <p style="margin-top:8%;">.....................................</p>
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
