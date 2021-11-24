<!DOCTYPE html>

<html>

<head>
<style>
div.a {
  font-size: 10px;
}


</style>
<title>CETAK GAJI PEGAWAI</title>

</head>

<body>
    <div align="CENTER"><H4>RINCIAN GAJI PEGAWAI</H4></div>
              @foreach($pegawai as $pegawais)
              <h3><div>Nama : {{$pegawais->nama_pegawai}}</div></h3>
              @endforeach
    <div class="card-body">
                  <table class="table-hover" style="width:100%; margin-left: 40px;">

                  <tr>
                    <th>Tanggal</th>
                    <th>Tepat Waktu</th>
                    <th>Lembur</th>
                    <th>Jumlah Cup</th>
                    <th>Bonus Time</th>
                  </tr>
                  
                  @foreach($kriterias2 as $kriteria)
                    <tr>
                      <td>{{ $kriteria->tanggal }}</td>
                      <td>{{ $kriteria->tepat_waktus }}</td>
                      <td>{{ $kriteria->lemburs }}</td>
                      <td>{{ number_format($kriteria->jumlah_cup) }}</td>
                      <td>{{ $kriteria->bonus_times }}</td>
                    </tr>
                  @endforeach
                </table>
            </div>
            <br>
            <div class="card-body">
                <table class="table-hover" style="width:100%; margin-left: 40px;">

                  <tr>
                    <th>Tepat Waktu</th>
                    <th>Lembur</th>
                    <th>Bonus Bulanan</th>
                    <th>Bonus On Time</th>
                  </tr>
                  
                    <tr>
                      <td>Rp {{ $gajitepatwaktu }}</td>
                      <td>Rp {{ $gajilembur }}</td>
                      <td>Rp {{ $gajibonusbulanan }}</td>
                      <td>Rp {{ $gajiontime }}</td>
                    </tr>

                    <!-- <tr>
                      <td>Rp <input type="text" name="tepatwaktu" value="{{ number_format($gajitepatwaktu, 2) }}" readonly></td>
                      <td>Rp <input type="text" name="lembur" value="{{ number_format($gajilembur, 2) }}" readonly></td>
                      <td>Rp <input type="text" name="bonusbulanan" value="{{ number_format($gajibonusbulanan, 2) }}" readonly></td>
                      <td>Rp <input type="text" name="bonusontime" value="{{ number_format($gajiontime, 2) }}" readonly></td>
                    </tr> -->
                </table>
                <br>
                <center><h3><b>Gaji Akhir: Rp {{ $hasilgajiakhir }}</b></h3></center>
            </div>
</body>

</html>