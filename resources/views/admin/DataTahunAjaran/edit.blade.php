<!DOCTYPE html>
<html lang="en">
<head>
    @extends('partials.header.cssheader')

    @section('page-title')
        Edit Data Tahun Ajaran
    @endsection

    <script src="{{url('/bs/js/jquery.min.js')}}"></script>

</head>
<body>
@extends('partials.sidebar.sidebar')

    @section('content')
    <div class="card shadow mb-4 w-100" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Edit Data Tahun Ajaran</h6>
        </div>

        <div class="card-body">

            <form method="POST" action="{{route('update_data_tahun_ajaran',$tahun_ajaran->id_tahun_ajaran)}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="mb-3 mt-3">Rentang Tahun</label>
                    <div class="row justify-content-between">

                        <div class="col-4">

                          <label for="tahun_awal" class="mb-1">Tahun Awal:</label>
                          <div class="input-group date" id="datepicker_tahun_awal">

                            <input type="text" name="tahun_awal" id="tahun_awal" class="form-control @error('tahun_awal') is-invalid @enderror"
                             value="<?php echo strtok($tahun_ajaran->tahun_ajaran,'-')?>" placeholder="Tanggal-Bulan-Tahun" readOnly="true">

                             <span class="input-group-append">
                                    <span class="input-group-text text-white bg-success d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                            </span>

                            @error('tahun_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                        <div class="col-4 mb-4">
                            <label for="tahun_akhir" class="mb-1">Tahun Akhir:</label>
                          <div class="input-group date" id="datepickertahun_akhir">

                            <input type="text" name="tahun_akhir" id="tahun_akhir" class="form-control @error('tahun_akhir') is-invalid @enderror"
                             value="<?php echo substr($tahun_ajaran->tahun_ajaran, strpos($tahun_ajaran->tahun_ajaran, "-") + 1)?>" placeholder="Tanggal-Bulan-Tahun" readOnly="true">

                             <span class="input-group-append">
                                    <span class="input-group-text text-white bg-success d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                            </span>

                            @error('tahun_akhir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                    </div>
                </div>

                @if(Session::has('rentang_tahun_error'))
                <div class="text-danger">
                    <p style="font-size:12px">{{Session::get('rentang_tahun_error')}}</p>
                </div>
                @endif

                <div class="mb-3">
                    <input type="submit" class="form-control btn btn-success mt-3" value="Edit Tahun Ajaran" style="border-radius:100px">
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


            @if(Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Operasi Sukses',
                    text: '{{ Session::get("success") }}'
                })

            @elseif(Session::has('error'))
            Swal.fire({
                icon: 'error',
                title: 'Operasi Gagal',
                text: '{{ Session::get("error") }}'
                })

            @endif

        });

    </script>


</body>
</html>
