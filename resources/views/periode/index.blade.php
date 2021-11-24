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
            <!-- <a class="navbar-brand" href="" style="color:white;">INPUT</a> -->
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
            <div class="col-md-12">
              <div class="places-buttons">
               
                <div class="row">
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      <div class="col-md-4">
                        <button class="btn btn-primary btn-block" onclick="location.href='{{route('tambahperiode')}}'">New Periode</button>
                      </div>
                      <div class="col-md-4">
                        
                      </div>
                      <div class="col-md-4">
                        <button class="btn btn-primary btn-block" onclick="location.href='{{route('periodeexists')}}'">Exists Periode</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      @endsection