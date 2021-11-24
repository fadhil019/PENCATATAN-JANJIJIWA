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
          <div class="card">
            <div class="card-header" id="headingOne">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">List Sales</h3>
              </div>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="location.href='{{route('tolistjenissales')}}'">Lanjut</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>

                    </div>
                  </div>
              </center>
              </div>
            </div>
          </div>
        </div>

      <!-- End Navbar -->
      <div class="card">

            <div class="card-header" id="headingTwo">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">List Daily Expense</h3>
              </div>
            </div>

            <!-- lihat sini -->
          <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="location.href='{{route('tolistdaily')}}'">Lanjut</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>

                    </div>
                  </div>
              </center>
              </div>
            </div>
          </div>
      </div>

      <!-- End Navbar -->
      <div class="card">

            <div class="card-header" id="headingThree">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">List Monthly Expense</h3>
              </div>
            </div>

            <!-- lihat sini -->
          <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="location.href='{{route('tolistmonthly')}}'">Lanjut</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>

                    </div>
                  </div>
              </center>
              </div>
            </div>
          </div>
      </div>

       <!-- End Navbar -->
      <div class="card">
            <div class="card-header" id="headingFour">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">List Profit Sharing</h3>
              </div>
            </div>

            <!-- lihat sini -->
          <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
            <div class="col-md-12">
              <div class="places-buttons">
                <center>
                  <div class="col-lg-8 col-md-10 ml-auto mr-auto">
                    <div class="row">
                      
                      <div class="col-md-4">
                        
                      </div>

                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block" onclick="location.href='{{route('tohalamanlistprofitsharing')}}'">Lanjut</button>
                      </div>
                      
                      <div class="col-md-4">
                        
                      </div>

                    </div>
                  </div>
              </center>
              </div>
            </div>
          </div>
      </div>
      @endsection