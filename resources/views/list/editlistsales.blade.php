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
          <li class="nav-item active">
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
            <a class="navbar-brand" href="#pablo">LIST</a>
          </div>
          @endsection
      
      @section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h3 class="card-title">LIST</h3>
              <p class="card-category">Fitur ini untuk mengedit data sales
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>
            <!-- lihat sini -->
            @if( $flagsales == 0)
            <form method="GET" action="{{url('saleslist/hitung/'.$idjenissaless.'/'.$idlistsales)}}">
              {{ csrf_field() }}
            <div class="card-body">
               
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 30px; margin-right: 350px;">
                  <tr>
                    <th>Jenis</th> 
                    <td>{{ $jenissaless }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal</th>
                    <td><input type="date" name="tanggal" value="{{ $tanggallist }}"></td>
                  </tr>
                  <tr>
                    <th>Total</th> 
                    <td><input type="number" name="total" value="{{ $totalawal }}"></td>
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
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">HITUNG</button>
                      </div>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </form>

          @elseif( $flagsales == 1 )
            <form method="GET" action="{{url('saleslist/edit/'.$idlistsales2)}}">
              {{ csrf_field() }}
            <div class="card-body">
               
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 30px; margin-right: 450px;">
                  <tr>
                    <th>Jenis</th> 
                    <td>{{ $jenissaless2 }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal</th>
                    <td><input type="date" name="tanggal" value="{{ $tanggallist2 }}"></td>
                  </tr>
                  <tr>
                    <th>Total</th> 
                    <td><input type="number" name="total" value="{{ $totalhargaawal }}"></td>
                  </tr>
                  <tr>
                    <th>Komisi</th> 
                    <td><input type="number" name="komisi" value="{{ $komisisales }}"></td>
                  </tr>
                  <tr>
                    <th>Total Akhir</th> 
                    <td><input type="number" name="totalakhir" value="{{ $totalakhir }}"></td>
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
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">UPDATE</button>
                      </div>
                      
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </form>
          @endif


          </div>
        </div>
      </div>
      @endsection