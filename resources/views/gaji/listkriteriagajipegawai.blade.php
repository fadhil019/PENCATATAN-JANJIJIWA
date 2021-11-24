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
              <p class="card-category">Fitur ini untuk melihat data kehadiran dan jumlah cup yang berhasil dijual oleh setiap pegawai
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

          <form method="GET" action="{{url('createlistgajipegawai/'.$kodeidpegawai)}}">
            <center>
              @foreach($pegawai as $pegawais)
              <h3><div>{{$pegawais->nama_pegawai}}</div></h3>
              @endforeach
            </center>
              {{ csrf_field() }}
            <div class="card-body">
                  <table class="table-hover" style="width:100%; text-align: center;">

                  <tr>
                    <th>Tanggal</th>
                    <th>Tepat Waktu</th>
                    <th>Lembur</th>
                    <th>Jumlah Cup</th>
                    <th>Bonus Time</th>
                    <th>Action</th>
                  </tr>
                  
                  @foreach($kriterias as $kriteria)
                    <tr>
                      <td>{{ $kriteria->tanggal }}</td>
                      <td>{{ $kriteria->tepat_waktus }}</td>
                      <td>{{ $kriteria->lemburs }}</td>
                      <td>{{ number_format($kriteria->jumlah_cup) }}</td>
                      <td>{{ $kriteria->bonus_times }}</td>
                      <td>
                        <a class="btn btn-success btn-sm" href="{{URL::to('/kriteriagaji/indexedit/'.$kriteria->id_kriteriagajipegawais)}} ">EDIT</a>
                        <a class="btn btn-danger btn-sm" href="{{URL::to('/kriteriagaji/destroy/'.$kriteria->id_kriteriagajipegawais)}} ">HAPUS</a>
                      </td>
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

                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Hitung</button>
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