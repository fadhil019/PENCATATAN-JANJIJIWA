<!DOCTYPE html>

<html>

<head>
<style>
div.a {
  font-size: 10px;
}


</style>
<title>CETAK DAILY EXPENSES</title>

</head>

<body>
    @foreach($periodess as $periodes)
    <div align="CENTER">
      <h4>List Daily Expenses pada Periode {{$periodes->bulan}} - {{$periodes->tahun}}</h4>
    </div>
    @endforeach
<div class="card-body">
               <table class="table-hover" style="width:100%; margin-left: 40px;">
                  <tr>
                    <th>Tanggal</th>
                    <!-- <th>Nilai Masuk</th>
                    <th>Deskripsi Nilai Masuk</th> -->
                    <th>Deskripsi</th>
                    <th>Nilai Keluar</th>
                    <th>Balance</th>
                  </tr>
                  
                  @foreach($listdailys as $listdaily)
                    <tr>
                      <td>{{ $listdaily->tanggal }}</td>
                     <!--  <td>{{ $listdaily->nilai_masuk }}</td>
                      <td>{{ $listdaily->deskripsi_masuk }}</td> -->
                      <td>{{ $listdaily->deskripsi }}</td>
                      <td>{{ number_format($listdaily->nilai_keluar, 2) }}</td>
                      <td>{{ number_format($listdaily->balance, 2) }}</td>
                    </tr>
                  @endforeach
              </table>
            </div>
            <br>

            <!-- lihat sini -->
            <div>
              <div class="col-md-5">
                <table class="table-striped" style="width:100%; margin-left: 220px;">
                  <tr>
                    <!-- <td></td> -->
                    <th><h3>Total Daily Expenses</h3></th>
                    <th><h3>{{ number_format($jumlah, 2) }}</h3></th>
                    <!-- <td><input type="text" name="totaldaily" value="{{ number_format($jumlah, 2) }}" readonly></td> -->
                  </tr>
                </table>
              </div>
            </div>
</body>

</html>