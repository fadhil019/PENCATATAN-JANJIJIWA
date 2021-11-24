    @extends('layouts.layout')

      @section('sidebar')
      <div class="sidebar-wrapper">
       <ul class="nav">
          <li class="nav-item active">
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
            <!-- <a class="navbar-brand" href="#pablo">INPUT</a> -->
          </div>
          @endsection

      @section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h3 class="card-title">Periode</h3>
              <p class="card-category">Untuk mengisi periode dari data keuangan
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            <!-- lihat sini -->
            <form method="POST" action="{{ url('periode') }}">
              {{ csrf_field() }}
            <div class="card-body">
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 30px; margin-right: 200px;">
                  <tr>
                    <th>Bulan</th>
                    <td><input type="text" name="bulan" autofocus></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('bulan') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Tahun</th> 
                    <td><input type="text" name="tahun"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('tahun') {{$message}} @enderror</td>
                  </tr>
                </table>
              </div>
            </div>

            <!-- lihat sini -->
            <div class="col-md-12">
              <div class="places-buttons">
                
                <div class="row">
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Simpan</button>
                      </div>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div>

           </form> 

          </div>
        </div>
      </div>
      @endsection