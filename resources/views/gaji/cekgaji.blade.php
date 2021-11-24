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
          <li class="nav-item">
            <a class="nav-link" href="{{route('cashflow.index')}}">
              <i class="material-icons">assessment</i>
              <p>CASHFLOW</p>
            </a>
          </li>
          <li class="nav-item active">
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
            <a class="navbar-brand" href="#pablo">PAYROLL</a>
          </div>
          @endsection

      @section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h3 class="card-title">PEGAWAI</h3>
              <p class="card-category">Fitur ini untuk menghitung gaji akhir pegawai
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            @if($flaggaji == 1) 
            <div class="col-md-16" style="position: relative; left: 850px;">
              <a href="{{URL::to('cetak_gaji')}}" class="btn btn-info" target="_blank">
                <i class="material-icons">print</i>
                &nbsp CETAK PDF
              </a>
              <!-- <a href="{{URL::to('cetak_pdf')}}" class="btn btn-danger" target="_blank">CETAK PDF</a> -->
            </div>
            @endif

            <!-- lihat sini -->
            <form method="GET" action="{{url('simpangajipegawai/'.$kodeidpegawai)}}">
              {{ csrf_field() }}
            <div class="card-body">
                <table style="width:100%; margin-left: 30px;">

                  <tr>
                    <th>Tepat Waktu</th>
                    <th>Lembur</th>
                    <th>Bonus Bulanan</th>
                    <th>Bonus On Time</th>
                  </tr>
                  
                    <tr>
                      <td>Rp <input type="text" name="tepatwaktu" value="{{ $gajitepatwaktu }}" readonly></td>
                      <td>Rp <input type="text" name="lembur" value="{{ $gajilembur }}" readonly></td>
                      <td>Rp <input type="text" name="bonusbulanan" value="{{ $gajibonusbulanan }}" readonly></td>
                      <td>Rp <input type="text" name="bonusontime" value="{{ $gajiontime }}" readonly></td>
                    </tr>

                    <!-- <tr>
                      <td>Rp <input type="text" name="tepatwaktu" value="{{ number_format($gajitepatwaktu, 2) }}" readonly></td>
                      <td>Rp <input type="text" name="lembur" value="{{ number_format($gajilembur, 2) }}" readonly></td>
                      <td>Rp <input type="text" name="bonusbulanan" value="{{ number_format($gajibonusbulanan, 2) }}" readonly></td>
                      <td>Rp <input type="text" name="bonusontime" value="{{ number_format($gajiontime, 2) }}" readonly></td>
                    </tr> -->
                </table>
                <br>
                <center><h4><b>Gaji Akhir: &nbsp &nbsp Rp <input type="text" name="totalgaji" value="{{ $hasilgajiakhir }}" readonly></b></h4></center>
            </div>

            <!-- lihat sini -->
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>
                      @if($flaggaji == 0)
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Simpan</button>
                      </div>
                      @elseif($flaggaji == 1)
                      <div class="col-md-4">
                        <h4>SUDAH TERSIMPAN</h4>
                        <!-- <center><a href="{{URL::to('cetak_gaji')}}" class="btn btn-primary" target="_blank">CETAK PDF</a></center> -->
                      </div>
                      @elseif($flaggaji == 2)
                      <div class="col-md-4">
                        <td><a class="btn btn-primary" href="{{URL::to('updatelisttotalgaji/'.$gajitepatwaktu.'/'.$gajilembur.'/'.$gajibonusbulanan.'/'.$gajiontime.'/'.$hasilgajiakhir.'/'.$idlistgajipegawai.'/'.$idtotalgaji)}}">UPDATE</a></td>
                      </div>
                      @endif
                      
                      <div class="col-md-4">
                        
                      </div>
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