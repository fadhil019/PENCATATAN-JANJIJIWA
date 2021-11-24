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
              <p class="card-category">Fitur ini untuk menghitung total daily expenses
                <!-- <a target="_blank" href="https://github.com/mouse0270">Robert McIntosh</a>. Please checkout the
                <a href="http://bootstrap-notify.remabledesigns.com/" target="_blank">full documentation.</a> -->
              </p>
            </div>

            <!-- lihat sini -->
            <form method="GET" action="{{url('simpantotaldaily/simpan/'.$flagjumlahdaily.'/'.$idjumlahdaily.'/'.$jumlahs)}}">
              {{ csrf_field() }}
            <div class="card-body">
                  <table style="width:100%; margin-left: 20px;">
                  <tr>
                  <th>Total Daily Expense</th>
                  <td>Rp &nbsp&nbsp<input type="text" name="totaldaily" value="{{ $jumlahs }}" readonly></td>
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

                      @if($flagjumlahdaily == 0)
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Simpan</button>
                      </div>
                      @elseif($flagjumlahdaily == 1)                     
                      <div class="col-md-4">
                        <h4>DATA SUDAH ADA</h4>
                      </div>
                      @elseif($flagjumlahdaily == 2)
                      <div class="col-md-4">
                        <td><a class="btn btn-primary" href="{{URL::to('simpantotaldaily/simpan/'.$flagjumlahdaily.'/'.$idjumlahdaily.'/'.$jumlahs)}} ">UPDATE</a></td>
                      </div>
                      @endif
                     
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