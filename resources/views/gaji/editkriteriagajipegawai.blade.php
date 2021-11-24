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
              <h3 class="card-title">Pegawai</h3>
              <p class="card-category">Fitur ini untuk mengedit data kehadiran dan jumlah cup yang berhasil dijual oleh setiap pegawai
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

          <form method="GET" action="{{url('editkriteriagaji/'.$id)}}">
            <center>
              @foreach($pegawai as $pegawais)
              <h3><div>{{$pegawais->nama_pegawai}}</div></h3>
              @endforeach
            </center>
              {{ csrf_field() }}
            <div class="card-body">
                  <table>  

                  <tr>
                    <th>Tanggal</th>
                    <td><input type="date" name="tanggal" value="{{ $tanggalkriteria }}"></td>
                  </tr>

                  <tr>
                    <th>Tepat waktu : </th>
                    <td>
                      <select name="tepatwaktu">
                        @foreach($listtepatwaktu as $listtepatwaktus => $value)
                        @if( $tepatwaktu == $value)
                        <option value="{{$value}}" selected>
                          {{$value}}
                        </option>
                        @else
                        <option value="{{$value}}">
                          {{$value}}
                        </option>
                        @endif
                        @endforeach
                      </select>
                    </td>
                  </tr>

                  <tr>
                    <th>Lembur : </th>
                    <td>
                      <select name="lembur">
                        @foreach($listlembur as $listlemburs => $value)
                        @if( $lembur == $value)
                        <option value="{{$value}}" selected>
                          {{$value}}
                        </option>
                        @else
                        <option value="{{$value}}">
                          {{$value}}
                        </option>
                        @endif
                        @endforeach
                      </select>
                    </td>
                  </tr>

                  <tr>
                    <th>Jumlah Cup : </th>
                    <td>
                      <input type="number" name="jumlahcup" value="{{ $jumlahcup }}">
                    </td>
                  </tr>

                  <tr>
                    <th>Bonus On Time : </th>
                    <td>
                      <select name="bonusontime">
                        @foreach($listbonusontime as $listbonusontimes => $value)
                        @if($bonustime == $value)
                        <option value="{{$value}}" selected>
                          {{$value}}
                        </option>
                        @else
                        <option value="{{$value}}">
                          {{$value}}
                        </option>
                        @endif
                        @endforeach
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

                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Update</button>
                      </div>
                      
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