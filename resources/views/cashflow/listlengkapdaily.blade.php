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
            <a class="navbar-brand" href="#pablo">CASHFLOW</a>
          </div>
          @endsection

      @section('content')
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h3 class="card-title">LIST DAILY EXPENSES</h3>
              <p class="card-category">
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            <div class="col-md-16" style="position: relative; left: 850px;">
              <a href="{{URL::to('cetak_listdaily')}}" class="btn btn-info" target="_blank">
                <i class="material-icons">print</i>
                &nbsp CETAK PDF
              </a>
            </div>

            <!-- lihat sini -->
            <form method="POST" action="{{url('perhitungansales')}}">
              {{ csrf_field() }}
            <div class="card-body">
              <table class="table-hover" style="width:100%; margin-left: 60px;">
                  <tr>
                    <th>Tanggal</th>
                    <!-- <th>Nilai Masuk</th>
                    <th>Deskripsi Nilai Masuk</th> -->
                    <th>Deskripsi</th>
                    <th>Nilai Keluar</th>
                    <th>Balance</th>
                  </tr>
                  
                  @foreach($listdailys as $listdaily)
                    <tr>
                      <td>{{ $listdaily->tanggal }}</td>
                     <!--  <td>{{ $listdaily->nilai_masuk }}</td>
                      <td>{{ $listdaily->deskripsi_masuk }}</td> -->
                      <td>{{ $listdaily->deskripsi }}</td>
                      <td>{{ number_format($listdaily->nilai_keluar, 2) }}</td>
                      <td>{{ number_format($listdaily->balance, 2) }}</td>
                    </tr>
                  @endforeach
              </table>
            </div>

            <!-- lihat sini -->
            <div align="right">
              <div class="col-md-5">
                <table style="width:100%; margin-bottom: 30px;">
                  <tr>
                    <td></td>
                    <th>Total Daily Expenses</th>
                    <td><input type="text" name="totaldaily" value="{{ number_format($jumlah, 2) }}" readonly></td>
                  </tr>
                </table>
              </div>
               <!-- <center><a href="{{URL::to('cetak_listdaily')}}" class="btn btn-primary" target="_blank">CETAK PDF</a></center> -->
            </div>
           </form> 
          </div>
        </div>
      </div>
      @endsection