<!DOCTYPE html>

<html>

<head>
<style>
div.a {
  font-size: 10px;
}


</style>
<title>CETAK MONTHLY EXPENSES</title>

</head>

  <body>
    @foreach($periodess as $periodes)
    <div align="CENTER">
      <h4>List Monthly Expenses pada Periode {{$periodes->bulan}} - {{$periodes->tahun}}</h4>
    </div>
    @endforeach
      <div class="card-body">
               <table class="table-hover" style="width:100%; margin-left: 40px;">
                   <tr>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>Subtotal</th>
                  </tr>
                  
                  @foreach($listmonthlys as $listmonthly)
                    <tr>
                      <td>{{ $listmonthly->deskripsi }}</td>
                      <td>{{ $listmonthly->tanggal }}</td>
                      <td>{{ number_format($listmonthly->harga_satuan, 2) }}</td>
                      <td>{{ number_format($listmonthly->total) }}</td>
                      <td>{{ number_format($listmonthly->subtotal, 2) }}</td>
                    </tr>
                  @endforeach
              </table>
            </div>

            <!-- lihat sini -->
            <div>
              <div class="col-md-5">
                <table class="table-hover" style="width:100%; margin-left: 240px;">
                  <tr>
                    <!-- <td></td> -->
                    <th colspan="2">Total Monthly Expenses</th>
                    <td>{{ number_format($jumlah, 2) }}</td>
                    <!-- <td><input type="text" name="totaldaily" value="{{ number_format($jumlah, 2) }}" readonly></td> -->
                  </tr>
                </table>
              </div>
            </div>
</body>

</html>