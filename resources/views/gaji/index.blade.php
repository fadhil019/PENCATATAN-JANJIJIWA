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
              <p class="card-category">Fitur ini untuk menyimpan data payroll
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            <!-- lihat sini -->
            <form method="GET" action="{{url('indexgajipokok')}}">
              {{ csrf_field() }}
            <div class="card-body">
                <!-- lnnkkjhkhk -->
                <center>
                  <div><h2>Periode : </h2></div>
                <table style="width:100%">
                   <select name="idperiodegaji">
                      @foreach($periodes as $periode)
                      <option value="{{ $periode->id_periode }}">
                        {{ $periode->bulan }} - {{ $periode->tahun }}
                      </option>
                      @endforeach
                    </select>
                </table>
                </center>
            </div>

            <!-- lihat sini -->
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <center>
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>
                      @if($flag == 1)
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Lanjut</button>
                      </div>
                      @elseif($flag == 0)
                      <div class="col-md-4">
                        <h4>Mohon Untuk Mengisi Periode Terlebih Dahulu</h4>
                      </div>
                      @endif
                      
                      <div class="col-md-4">
                        
                      </div>
                    </div>
                    </center>
                  </div>
              </center>
              </div>
            </div>
           </form> 
          </div>
        </div>
      </div>
      @endsection