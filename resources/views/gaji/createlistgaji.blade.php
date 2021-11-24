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
              <p class="card-category">Fitur ini untuk mengisi data kehadiran dan jumlah cup yang berhasil dijual oleh setiap pegawai
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            <!-- lihat sini -->
            <form method="GET" action="{{url('createlistkriteriapegawai')}}">
              {{ csrf_field() }}
            <div class="card-body">
              <table style="margin-left: 20px;">  
                  <tr>
                  <th>Nama Pegawai</th>
                  <td>                
                   : &nbsp <select name="idpegawai" id="idpegawai">
                      @foreach($pegawais as $pegawai)
                      <option value="{{ $pegawai->id_pegawais }}">
                        {{ $pegawai->nama_pegawai }}
                      </option>
                      @endforeach
                    </select>
                  </td>
                 @if($flagpegawai == 0)
                     <td></td>
                  @else
                  <td><div id="solTitle"><a href="" id="w3s">[CEK LIST]</a></div></td>
                  @endif

                  </tr>

                  <tr>
                    <th>Tanggal</th>
                    <td>
                    : &nbsp <input type="date" name="tanggal" min=<?php $dd = $tahuns; $kodebulans = $kodebulan; echo date(''.$dd.'-'.$kodebulans.'-01'); ?> max=<?php $kodebulans=$kodebulan; $d=cal_days_in_month(CAL_GREGORIAN,$kodebulans,$tahuns); $dd = $tahuns; echo date(''.$dd.'-'.$kodebulans.'-'.$d.''); ?>></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('tanggal') {{$message}} @enderror</td>
                  </tr>

                  <tr>
                    <th>Tepat waktu</th>
                    <td>
                      : &nbsp <select name="tepatwaktu">
                        <option value="masuk">
                          Masuk
                        </option>
                        <option value="absen">
                          Absen
                        </option>
                      </select>
                    </td>
                  </tr>

                  <tr>
                    <th>Lembur</th>
                    <td>
                      : &nbsp <select name="lembur">
                        <option value="masuk">
                          Masuk
                        </option>
                        <option value="absen">
                          Absen
                        </option>
                      </select>
                    </td>
                  </tr>

                  <tr>
                    <th>Jumlah Cup</th>
                    <td>
                      : &nbsp <input type="number" name="jumlahcup" value="0">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('jumlahcup') {{$message}} @enderror</td>
                  </tr>
                  
                  <tr>
                    <th>Bonus On Time</th>
                    <td>
                      : &nbsp <select name="bonusontime">
                        <option value="masuk">
                          Masuk
                        </option>
                        <option value="absen">
                          Absen
                        </option>
                      </select>
                    </td>
                  </tr>

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

                        @if($flagpegawai == 0)
                        <div></div>
                        @else
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Simpan</button>
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

          <form method="GET" action="{{url('createpegawai')}}">
            <center>
              <div class="col-md-4" style="margin-bottom: 30px;">
                <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Buat Pegawai</button>
              </div>   
            </center> 
          </form>
         </div>
        </div>
      </div>
      @endsection

      <script>
        
      @section('script')
      $("#solTitle a").click(function() {
        // alert($('#idpegawai').val());
        var cob =$('#idpegawai').val();
        var h =10;
        var alamat = "{!!URL::to('listkriteriapegawai/"+cob+"')!!}";
        //alert("Saya"+cob);
        $("#w3s").attr("href", alamat);
        
      });
      @endsection


      // $('a[href^=""]').each(function(){ 
      //       var oldUrl = $(this).attr("href"); // Get current url
      //       var newUrl = oldUrl.replace("URL::to('listkriteriapegawai/'.$('#idpegawai').val() )"); // Create new url
      //       $(this).attr("href", newUrl); // Set herf value
      //   });
      </script>