<!DOCTYPE html>
<html>
<head>
  <title>Sertifikat</title>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    @media (orientation: landscape) {
      body {
        transform-origin: center;
      }
    }

    @media print {
    html, body {
        height: 99%;
    }
}
  </style>
</head>
<body>
  <div style="width:1000px; height:600px; padding:20px; text-align:center; border: 10px solid #787878">
    <div style="width:950px; height:550px; padding:20px; text-align:center; border: 5px solid #787878">
      <span style="font-size:50px; font-weight:bold">Sertifikat Juara Kelas</span>
      <br><br>
      <span style="font-size:25px"><i>Dengan ini Sah Bahwa</i></span>
      <br><br>
      <span style="font-size:30px"><b>{{$data_ranking['nama']}}</b></span><br/><br/>
      <span style="font-size:25px"><i>Telah Menjadi Juara Kelas Urutan Ke-{{$data_ranking['ranking']}} </i></span> <br/><br/>
      <span style="font-size:30px">Kelas: {{$data_ranking['kelas']}}</span> <br/><br/>
      <span style="font-size:20px">Tahun Ajaran: <br><b>{{$data_ranking['tahun_ajaran']}}</b></span> <br/><br/>
      <span style="font-size:25px"><i>Tanggal</i></span><br><br>
      <span style="font-size:20px;"><b>{{date('d-m-Y')}}<b></span><br>
      <p style="font-size:25px; margin-top: 20px;"><i>Wali Kelas</i></p>
      <p style="font-size:30px; margin-top: 7%;"><b>{{$data_ranking['wali_kelas']}}</b></p>
    </div>
  </div>
</body>
</html>
