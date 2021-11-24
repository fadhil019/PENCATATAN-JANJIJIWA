<!DOCTYPE html>

<html>

<head>
<style>
div.a {
  font-size: 10px;
}


</style>
<title>CETAK LIST SALES</title>

</head>

<body>
  @foreach($periodess as $periodes)
    <div align="CENTER">
      <H4>Data List Sales {{ $namajenis }} pada Periode {{$periodes->bulan}} - {{$periodes->tahun}}</H4>
    </div>
  @endforeach

  <div class="card-body">
    <table class="table-hover" style="width:100%; margin-left: 40px;">
      <tr>
        <th>Tanggal</th>
        <th>Total</th>
        <th>Komisi</th>
        <th>Akhir</th>
      </tr>
                  
    @foreach($listsaless as $listsales)
      <tr>
        <td>{{ $listsales->tanggal }}</td>
        <td>{{ number_format($listsales->total, 2) }}</td>
        <td>{{ number_format($listsales->komisi, 2) }}</td>
        <td>{{ number_format($listsales->akhir, 2) }}</td>
      </tr>
    @endforeach
    </table>
  </div>

  <!-- lihat sini -->
  <div>
    <table class="table-hover" style="width:100%; margin-left: 240px;">
      <tr>
       <!--  <td></td>
        <td></td> -->
        <th>Total Sales {{ $namajenis }}</th>
        <td>{{ number_format($jumlah, 2) }}</td>
        <!-- <td><input type="text" name="totalsales" value="{{ number_format($jumlah, 2) }}" readonly></td> -->
      </tr>
    </table>
  </div>
</body>

</html>