    @extends('layouts.layout')

      @section('sidebar')
      <div class="sidebar-wrapper">
       <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('periode.index')}}">
              <i class="material-icons">input</i>
              <p>INPUT</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('halamanlist.index')}}">
              <i class="material-icons">list</i>
              <p>LIST</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="{{route('cashflow.index')}}">
              <i class="material-icons">assessment</i>
              <p>CASHFLOW</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('pegawai.index')}}">
              <i class="material-icons">people</i>
              <p>PEGAWAI</p>
            </a>
          </li>
          <!-- <li class="nav-item active-pro ">
            <a class="nav-link" href="">
              <i class="material-icons">home</i>
              <p>Log Out</p>
            </a>
          </li> -->
        </ul>
      </div>
      @endsection

          @section('judul')
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">INPUT</a>
          </div>
          @endsection

      @section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h3 class="card-title">CASHFLOW</h3>
              <p class="card-category">Fitur ini untuk melihat semua data cashflow
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            @if($flag == 1) 
            <div class="col-md-16" style="position: relative; left: 850px;">
              <a href="{{URL::to('cetak_pdf')}}" class="btn btn-info" target="_blank">
                <i class="material-icons">print</i>
                &nbsp CETAK PDF
              </a>
              <!-- <a href="{{URL::to('cetak_pdf')}}" class="btn btn-danger" target="_blank">CETAK PDF</a> -->
            </div>
            @endif
            
            <!-- lihat sini -->
            <form method="POST" action="{{route('cashflow.store')}}">
              {{ csrf_field() }}
            <div class="card-body">
                <table style="width:100%">
                  <tr>
                    <th>Deskripsi</th>
                    <th>Sales</th>
                    <th>Expenses</th>
                    <th>Nett Balance</th>
                  </tr>

                  <tr>
                    <th>SALES</th>
                  </tr>
                  
                  @foreach($penjualansaless as $penjualansales)
                    <tr>
                    @foreach($periodess as $periodes)
                      @foreach( $jenissaless as $jenissales)
                        @if( $jenissales->id_jenissales == $penjualansales->id_jenissales )
                          <td>Hasil penjualan {{$periodes->bulan}} - {{$periodes->tahun}} <b>(-{{ $jenissales->nama }}-)</b> <a href="{{URL::to('/listlengkapsales/list/'.$jenissales->id_jenissales)}}">[Lihat lengkap]</a> </td>
                          <td><input type="text" name="jumlahpenjualansales" value="{{ number_format($penjualansales->jumlah, 2) }}" readonly></td>
                        @endif
                      @endforeach
                    @endforeach
                    </tr>
                  @endforeach

                  <tr>
                    <th>---TOTAL SALES</th>
                    
                    <td><input type="text" name="" value="{{ number_format($totalsales, 2) }}" readonly></td>
                    <td></td>
                    <td><input type="text" name="totalsales" value="{{ $totalsales }}" readonly></td>
                    
                  </tr>

                  <tr>
                    <th>EXPENSES</th>
                  </tr>

                  <tr>
                    <td>PPN pemkot (10% dari sales) </td>
                    
                    <td></td>
                    <td><input type="text" name="totalppn" value="{{ $totalppn }}" readonly></td>
                    <td></td>
                    
                  </tr>

                   <tr>
                    @foreach($periodess as $periodes)
                    <td>Monthly Expenses {{$periodes->bulan}} - {{$periodes->tahun}} <a href="{{URL::to('/listlengkapmonthly/')}}">[Lihat lengkap]</a></td>
                    <td></td>
                    @foreach($totalmonthlys as $totalmonthly)
                    <td><input type="text" name="totalmonthly" value="{{ $totalmonthly->total_monthly_expense }}" readonly></td>
                    @endforeach
                    <td></td>
                    @endforeach
                  </tr>

                  <tr>
                    @foreach($periodess as $periodes)
                    <td>Daily Expenses {{$periodes->bulan}} - {{$periodes->tahun}} <a href="{{URL::to('/listlengkapdaily/')}}">[Lihat lengkap]</a></td>
                    <td></td>
                    @foreach($totaldailys as $totaldaily)
                    <td><input type="text" name="totaldaily" value="{{ $totaldaily->total_daily_expense }}" readonly></td>
                    @endforeach
                    <td></td>
                    @endforeach
                  </tr>

                  <tr>
                    <th>---TOTAL EXPENSES</th>
                    <td></td>
                    <td><input type="text" name="" value="{{ number_format($jumlahtotalexpenses, 2) }}" readonly></td>
                    <td><input type="text" name="jumlahtotalexpenses" value="{{ $jumlahtotalexpenses }}" readonly></td>
                  </tr>

                  <tr>
                    <th>---TOTAL SALES-EXPENSES</th>
                    <td></td>
                    <td></td>
                    <td><input type="text" name="totalsalesminexpenses" value="{{ $totalsalesminexpenses }}" readonly></td>
                  </tr>

                  <tr>
                    <th>MISC. EXPENSES</th>
                  </tr>

                  <tr>
                    <td>Overhead</td>
                    <td></td>
                    <td><input type="text" name="jumlahpersentaseover" value="{{ $jumlahpersentaseover }}" readonly></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td>kas kecil</td>
                    <td></td>
                    <td><input type="text" name="jumlahpersentasekas" value="{{ $jumlahpersentasekas }}" readonly></td>
                    <td></td>
                  </tr>

                  <tr>
                    <th>TOTAL MISC EXPENSES</th>
                    <td></td>
                    <td><input type="text" name="jumlahtotalmisexpenses" value="{{ $jumlahtotalmisexpenses }}" readonly></td>
                    <td></td>
                  </tr>

                  <tr>
                    <th>TOTAL PROFIT</th>
                    <td></td>
                    <td></td>
                    <td><input type="text" name="jumlahtotalprofit" value="{{ $jumlahtotalprofit }}" readonly></td>
                  </tr>

                  <br>

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
                          <td><input type="text" name="jumlahprofitsharing" value="{{ number_format($value, 2) }}" readonly></td>
                        @endif
                      @endforeach
                    </tr>
                  @endforeach

                </table>
            </div>

            <!-- lihat sini -->
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>

                        @if( $flag == 0)
                          <div class="col-md-4">
                            <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">SIMPAN</button>
                          </div>
                        @elseif($flag == 1) 
                          <div class="col-md-12">
                            <h3>DATA SUDAH TERSIMPAN</h3>
                          </div>
                        @elseif($flag == 2)
                          <div class="col-md-4">
                            <td><a class="btn btn-primary" href="{{URL::to('updatelistcashflow/simpan/'.$totalsales.'/'.$totalppn.'/'.$jumlahdaily.'/'.$jumlahmonthly.'/'.$jumlahtotalexpenses.'/'.$totalsalesminexpenses.'/'.$jumlahpersentaseover.'/'.$jumlahpersentasekas.'/'.$jumlahtotalmisexpenses.'/'.$jumlahtotalprofit.'/'.$idtotalsales.'/'.$idlistexpenses.'/'.$idtotalexpenses.'/'.$idtotalsalesminexpenses.'/'.$idlistmiscexpenses.'/'.$idtotalmiscexpenses.'/'.$idtotalprofit)}} ">UPDATE</a></td>
                          </div>
                        @endif
                     
                    </div>
                  </div>
              </center>
              </div>
            </div>
           </form>           
           
          </div>
        </div>
      </div>
      @endsection