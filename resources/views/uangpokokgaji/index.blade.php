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
              <h3 class="card-title">BASIC PAYROLL</h3>
              <p class="card-category">Fitur ini untuk mengatur nilai gaji dan bonus dasar
              </p>
            </div>
            <!-- lihat sini -->
            @if($flag == 0)
            <form method="GET" action="{{url('isigajipokok')}}">
              {{ csrf_field() }}
            <div class="card-body">
               
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 30px; margin-right: 550px;">
                  <tr>
                    <th>Gaji Tepat Waktu (Full)</th>
                    <td><input type="number" name="gajitepatwaktu" id="inputgajitepatwaktu" placeholder="0"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('gajitepatwaktu') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Gaji Tidak Tepat Waktu (Not Full)</th>
                    <td><input type="number" name="gajitidaktepatwaktu" id="inputgajitidaktepatwaktu" placeholder="0"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('gajitidaktepatwaktu') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Bonus Jumlah Cup</th>
                    <td><input type="number" name="gajijumlahcup" id="inputgajijumlahcup" placeholder="0"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('gajijumlahcup') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Jumlah Cup</th>
                    <td><input type="number" name="jumlahcup" id="inputjumlahcup" placeholder="0"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('jumlahcup') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Bonus Lembur</th>
                    <td><input type="number" name="gajilembur" id="inputgajilembur" placeholder="0"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('gajilembur') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Bonus On Time</th>
                    <td><input type="number" name="gajiontime" id="inputgajiontime" placeholder="0"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('gajiontime') {{$message}} @enderror</td>
                  </tr>
                </table>
              </div>
            </div>

            <!-- lihat sini -->
            <!-- <div class="col-md-12">
              <div class="places-buttons">
                
                <div class="row">
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">LANJUT</button>
                      </div>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div> -->

            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      <div class="col-md-4">
                        
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Lanjut & Simpan</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>
                    </div>
                  </div>
              </center>
              </div>
            </div>

          </form>

          @elseif($flag == 1)
          <form method="GET" action="">
              {{ csrf_field() }}
            <div class="card-body">
              <div class="row">
                <table style="width:100%; margin-left: 30px; margin-right: 550px;">
                  <tr>
                    <th>Gaji Tepat Waktu (Full)</th>
                    <td><input type="text" name="gajitepatwaktu" value="{{ number_format($gajitepatwaktuss) }}" readonly></td>
                  </tr>
                  <tr>
                    <th>Gaji Tidak Tepat Waktu (Not Full)</th>
                    <td><input type="text" name="gajitidaktepatwaktu" value="{{ number_format($gajitidaktepatwaktuss) }}" readonly></td>
                   </tr>
                  <tr>
                    <th>Bonus Jumlah Cup</th>
                    <td><input type="text" name="gajijumlahcup" value="{{ number_format($gajibulanancupss) }}" readonly></td>
                   </tr>
                  <tr>
                    <th>Jumlah Cup</th>
                    <td><input type="text" name="jumlahcup" value="{{ number_format($jumlahcupss) }}" readonly></td>
                  </tr>
                  <tr>
                    <th>Bonus Lembur</th>
                    <td><input type="text" name="gajilembur" value="{{ number_format($gajilemburss) }}" readonly></td>
                  </tr>
                   <tr>
                     <th>Bonus On Time</th>
                     <td><input type="text" name="gajiontime" value="{{ number_format($gajiontimess) }}" readonly></td>
                  </tr>
                </table>
              </div>

              <div class="row">
                <div style="margin-left: 25px;"><h3>Data sudah ada, anda dapat <a class="btn btn-outline-info btn-sm" href="{{URL::to('indexeditgajipokok')}}">EDIT</a> data</h3></div>
              </div>
            </div>
          </form>

          @elseif($flag == 2)
          <form method="GET" action="{{url('updategajipokok/'.$idgajitepatwaktu.'/'.$idgajibulanancup.'/'.$idgajilembur.'/'.$idgajiontime)}}">
              {{ csrf_field() }}
            <div class="card-body">
               
              <div class="row">
                <table style="width:100%; margin-left: 30px; margin-right: 550px;">
                <tr>
                  <th>Gaji Tepat Waktu (Full)</th>
                  <td><input type="number" name="gajitepatwaktu" value="{{ $gajitepatwaktuss }}"></td>
                </tr>
                <tr>
                  <th>Gaji Tidak Tepat Waktu (Not Full)</th>
                  <td><input type="number" name="gajitidaktepatwaktu" value="{{ $gajitidaktepatwaktuss }}"></td>
                 </tr>
                <tr>
                  <th>Bonus Jumlah Cup</th>
                  <td><input type="number" name="gajijumlahcup" value="{{ $gajibulanancupss }}"></td>
                 </tr>
                <tr>
                  <th>Jumlah Cup</th>
                  <td><input type="number" name="jumlahcup" value="{{ $jumlahcupss }}"></td>
                </tr>
                <tr>
                  <th>Bonus Lembur</th>
                  <td><input type="number" name="gajilembur" value="{{ $gajilemburss }}"></td>
                </tr>
                 <tr>
                   <th>Bonus On Time</th>
                   <td><input type="number" name="gajiontime" value="{{ $gajiontimess }}"></td>
                </tr>
              </table>
              </div>
            </div>

            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      <div class="col-md-4">
                        
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">UPDATE</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>
                    </div>
                  </div>
              </center>
              </div>
            </div>

          </form>
          @endif

           @if($flag == 1 || $flag == 2)
          <form method="GET" action="{{url('buatpegawai')}}">
            <!-- lihat sini -->
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      <div class="col-md-4">
                        
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Lewati</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>
                    </div>
                  </div>
              </center>
              </div>
            </div>
          </form>
          @elseif($flag == 0)
          @endif

          </div>
        </div>
      </div>
      @endsection