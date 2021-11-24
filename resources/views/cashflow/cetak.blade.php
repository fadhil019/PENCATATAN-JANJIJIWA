<!DOCTYPE html>

<html>
  <head>
  <style>
    /*div.a {
      font-size: 12px;
    }*/
      
      td.nilai {
        text-align: center;
      }

      tr.judul{
        font-size: 18px;
      }
  </style>

  <title>CETAK CASHFLOW</title>

  </head>

  <body>
    @foreach($periodess as $periodes)
    <div align="CENTER"><u><h2>Cashflow {{$periodes->bulan}} - {{$periodes->tahun}}</h2></u></div>
    @endforeach
    <br>
    <div class="card-body">
      <table style="width:100%">
        <tr class="judul" style="text-align: center;">
          <th>Deskripsi</th>
          <th>Sales</th>
          <th>Expenses</th>
          <th>Nett Balance</th>
        </tr>

        <tr>
          <th><br></th>
        </tr>
        
        <tr>
          <th>SALES</th>
        </tr>
                    
        @foreach($penjualansaless as $penjualansales)
        <tr>
          @foreach($periodess as $periodes)
            @foreach( $jenissaless as $jenissales)
              @if( $jenissales->id_jenissales == $penjualansales->id_jenissales )
              <td>
                <div class="a">Hasil penjualan {{$periodes->bulan}} - {{$periodes->tahun}} <b>(-{{ $jenissales->nama }}-)</b>
              </td>
              <td class="nilai">{{ number_format($penjualansales->jumlah, 2) }}</td>
              <td class="nilai">-</td>
              <td class="nilai">-</td>
              @endif
            @endforeach
          @endforeach
        </tr>
        @endforeach

        <tr>
          <th>---TOTAL SALES</th>
          <td class="nilai"><b>{{ number_format($totalsales, 2) }}</b></td>
          <td class="nilai">-</td>
          <td class="nilai"><b>{{ number_format($totalsales, 2) }}</b></td>
        </tr>

        <tr>
          <th><br></th>
        </tr>

        <tr>
          <th>EXPENSES</th>
        </tr>

        <tr>
          <td>PPN pemkot (10% dari sales) </td>
          <td class="nilai">-</td>
          <td class="nilai">{{ number_format($totalppn, 2) }}</td>
          <td class="nilai">-</td>
        </tr>

        <tr>
          @foreach($periodess as $periodes)
          <td>Monthly expenses {{$periodes->bulan}} - {{$periodes->tahun}}</td>
          <td class="nilai">-</td>
            @foreach($totalmonthlys as $totalmonthly)
            <td class="nilai">{{ number_format($totalmonthly->total_monthly_expense, 2) }}</td>
            @endforeach
          <td class="nilai">-</td>
          @endforeach
        </tr>

        <tr>
          @foreach($periodess as $periodes)
          <td>Daily Expenses {{$periodes->bulan}} - {{$periodes->tahun}}</td>
          <td class="nilai">-</td>
            @foreach($totaldailys as $totaldaily)
            <td class="nilai">{{ number_format($totaldaily->total_daily_expense, 2) }}</td>
            @endforeach
          <td class="nilai">-</td>
          @endforeach
        </tr>

        <tr>
          <th>---TOTAL EXPENSES</th>
          <td class="nilai">-</td>
          <td class="nilai"><b>{{ number_format($jumlahtotalexpenses, 2) }}</b></td>
          <td class="nilai"><b>{{ number_format($jumlahtotalexpenses, 2) }}</b></td>
        </tr>

        <tr>
          <th>---TOTAL SALES-EXPENSES</th>
          <td class="nilai">-</td>
          <td class="nilai">-</td>
          <td class="nilai"><b>{{ number_format($totalsalesminexpenses, 2) }}</b></td>
        </tr>

        <tr>
          <th><br></th>
        </tr>

        <tr>
          <th>MISC. EXPENSES</th>
        </tr>

        <tr>
          <td>Overhead</td>
          <td class="nilai">-</td>
          <td class="nilai">{{ number_format($jumlahpersentaseover, 2) }}</td>
          <td class="nilai">-</td>
        </tr>

        <tr>
          <td>Kas kecil</td>
          <td class="nilai">-</td>
          <td class="nilai">{{ number_format($jumlahpersentasekas, 2) }}</td>
          <td class="nilai">-</td>
        </tr>

        <tr>
          <th>---TOTAL MISC EXPENSES</th>
          <td class="nilai">-</td>
          <td class="nilai"><b>{{ number_format($jumlahtotalmisexpenses, 2) }}</b></td>
          <td class="nilai"><b>{{ number_format($jumlahtotalmisexpenses, 2) }}</b></td>
        </tr>

        <tr>
          <th>---TOTAL PROFIT</th>
          <td></td>
          <td></td>
          <td class="nilai"><b>{{ number_format($jumlahtotalprofit, 2) }}</b></td>
        </tr>

        <tr>
          <th><br></th>
        </tr>

        <tr>
          <th>PROFIT SHARING</th>
          <td></td>
          <td></td>
          <td></td>
        </tr>

        @foreach($listprofitsharings as $listprofitsharing)
          <tr>
            @foreach( $arrayprofit as $key => $value)
              @if( $listprofitsharing->id_profitsharings == $key )
                <td> {{ $listprofitsharing->pihak }} ({{$listprofitsharing->persentase}}%) <input type="hidden" name="idprofitsharing" value="{{ $listprofitsharing->id_profitsharings }}"></td>
                <td class="nilai"><b>{{ number_format($value, 2) }}</b></td>
                <td class="nilai">-</td>
                <td class="nilai">-</td>
              @endif
            @endforeach
          </tr>
        @endforeach

      </table>
    </div>
  </body>
</html>