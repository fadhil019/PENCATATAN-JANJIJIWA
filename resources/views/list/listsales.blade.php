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
              <label class="card-category">Fitur ini untuk melihat list sales
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </label>
              <a class="btn btn-info btn-sm" href="{{ URL::to('/exists') }}" style="float: right; vertical-align: middle;">Tambah Data</a>
            </div>
            <!-- lihat sini -->
            <form method="POST" action="{{url('perhitungansales')}}">
              {{ csrf_field() }}
            <div class="card-body">
              <table class="table-hover" style="width:100%; text-align: center;">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Komisi</th>
                    <th>Akhir</th>
                    <th>Action</th>
                  </tr>  
                </thead>
                  
                <tbody>
                  @foreach($listsaless as $listsales)
                    <tr>
                      <td>{{ $listsales->tanggal }}</td>
                      <td>Rp {{ number_format($listsales->total, 2) }}</td>
                      <td>Rp {{ number_format($listsales->komisi, 2) }}</td>
                      <td>Rp {{ number_format($listsales->akhir, 2) }}</td>
                      <td>
                        <a class="btn btn-success btn-sm" href="{{URL::to('/saleslist/halamanedit/'.$listsales->id_listsales)}} ">EDIT</a>
                        <a class="btn btn-danger btn-sm" href="{{URL::to('/saleslist/destroy/'.$listsales->id_listsales)}} ">HAPUS</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
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