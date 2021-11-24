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
           <!--  <a class="navbar-brand" href="#pablo">INPUT</a> -->
          </div>
          @endsection
         
      @section('content')
      <div class="content">
          <div class="card">

            <div class="card-header" id="headingOne">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Input Sales</h3>
              </div>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">

              @if( $flagsales == 0)
            <form method="GET" action="{{ url('listsales2') }}">
              {{ csrf_field() }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <table style="width:100%; margin-left: 50px; margin-right: 500px;">
                  <tr>
                    <th>Jenis Sales</th>
                    <td>
                      <select  name="jenissaless">
                          @foreach($jenissaless as $jenissales)
                          <option value="{{ $jenissales->id_jenissales }}">
                            -- {{ $jenissales->nama }} --
                          </option>
                          @endforeach
                      </select>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Total</th> 
                    <td><input type="number" name="totalsales" id="totalsales"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('totalsales') {{$message}} @enderror</td>
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
                        <button type="submit" class="btn btn-primary btn-block" onclick="md.showNotification('bottom','center')">Hitung</button>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>

           </form> 
            <!-- lihat sini -->
            @elseif( $flagsales == 1)
            <form method="POST" action="{{ url('listsales') }}">
              {{ csrf_field() }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <table style="width:100%; margin-left: 50px; margin-right: 500px;">
                  <tr>
                    <th>Jenis Sales</th>
                    <td>
                      <select  class="jenissales" id="jenissales" name="jenissales">
                          @foreach($jenissaless as $jenissales)
                          @if($jenissales->id_jenissales == $idjenissales)
                          <option value="{{ $jenissales->id_jenissales }}">
                            -- {{ $jenissales->nama }} --
                          </option>
                          @endif
                          @endforeach
                      </select>
                    </td>
                    <td></td>
                  </tr>
                  
                  <tr>
                    <th>Tanggal</th>
                    <td><input type="date" name="tanggalsales" min=<?php $dd = $tahuns; $kodebulans = $kodebulan; echo date(''.$dd.'-'.$kodebulans.'-01'); ?> max=<?php $kodebulans=$kodebulan; $d=cal_days_in_month(CAL_GREGORIAN,$kodebulans,$tahuns); $dd = $tahuns; echo date(''.$dd.'-'.$kodebulans.'-'.$d.''); ?>></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('tanggalsales') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Total</th> 
                    <td><input type="number" name="total" id="totalsales" value="{{ $totalharga }}"></td>
                  </tr>
                  <tr>
                    <th>Komisi ({{$tampilpersentase}}%)</th> 
                    <td><input type="number" name="komisi" id="komisisales" value="{{ $komisisales }}"></td>
                  </tr>
                  <tr>
                    <th>Total Akhir</th> 
                    <td><input type="number" name="totalakhir" id="akhirsales" value="{{ $totalakhir }}"></td>
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
           @endif
           <button style="width:200px; margin-left:50px; margin-bottom: 25px; margin-top: -5px;" class="btn btn-primary btn-block" onclick="location.href='{{url('jenissales')}}'">Tambah Jenis Sales</button>
           </div>
      </div>

      <!-- End Navbar -->
          <div class="card">

            <div class="card-header" id="headingTwo">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Input Daily Expenses</h3>
              </div>
            </div>

            <!-- lihat sini -->
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <form method="POST" action="{{ url('dailyexpenses') }}">
              {{ csrf_field() }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 50px; margin-right: 550px;">
                  
                  <tr>
                    <th>Tanggal</th>
                    <td><input type="date" name="tanggaldaily" min=<?php $dd = $tahuns; $kodebulans = $kodebulan; echo date(''.$dd.'-'.$kodebulans.'-01'); ?> max=<?php $kodebulans=$kodebulan; $d=cal_days_in_month(CAL_GREGORIAN,$kodebulans,$tahuns); $dd = $tahuns; echo date(''.$dd.'-'.$kodebulans.'-'.$d.''); ?>></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('tanggaldaily') {{$message}} @enderror</td>
                  </tr>
                  <!-- <tr>
                    <th>Nilai Masuk</th> 
                    <td><input type="number" name="nilaimasuk"></td>
                  </tr>
                  <tr>
                    <th>Deskripsi Nilai Masuk</th> 
                    <td><input type="text" name="deskripsinilaimasuk"></td>
                  </tr> -->
                  <tr>
                    <th>Deskripsi Daily Expenses</th> 
                    <td><input type="text" name="deskripsidaily"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('deskripsidaily') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Nilai Keluar</th> 
                    <td><input type="number" name="nilaikeluar" id="nilaikeluar"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('nilaikeluar') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Balance</th> 
                    <td><input type="number" name="balance" id="balance"></td>
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

      <!-- End Navbar -->
          <div class="card">
            <div class="card-header" id="headingThree">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">Input Monthly Expenses</h3>
              </div>
            </div>
            
            <!-- lihat sini -->
            <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
            <form method="POST" action="{{ url('monthlyexpenses') }}">
              {{ csrf_field() }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <table style="width:100%; margin-left: 50px; margin-right: 550px;">
                  
                  <tr>
                    <th>Deskripsi Monthly Expenses</th> 
                    <td><input type="text" name="deskripsimonthly"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('deskripsimonthly') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Tanggal</th>
                    <td><input type="date" name="tanggal" min=<?php $dd = $tahuns; $kodebulans = $kodebulan; echo date(''.$dd.'-'.$kodebulans.'-01'); ?> max=<?php $kodebulans=$kodebulan; $d=cal_days_in_month(CAL_GREGORIAN,$kodebulans,$tahuns); $dd = $tahuns; echo date(''.$dd.'-'.$kodebulans.'-'.$d.''); ?>></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('tanggal') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Harga Satuan</th> 
                    <td><input type="number" name="hargasatuan" id="satuanmonthly"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('hargasatuan') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Total</th> 
                    <td><input type="number" name="total" id="totalmonthly"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('total') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Harga Total</th> 
                    <td><input type="number" name="subtotal" id="hargamonthly"></td>
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

      <!-- End Navbar -->
          <div class="card">

            <div class="card-header" id="headingFour">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">Input Persentase dari Kategori Misc Expenses</h3>
              </div>
            </div>

            <!-- lihat sini -->
             <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
             @if( $flag == 0)
              <form method="POST" action="{{route('persentase.store')}}">
              {{ csrf_field() }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 50px; margin-right: 500px;">
                  
                  <tr>
                    <th>Persentase Kas Kecil</th> 
                    <td><input type="number" name="persentasekaskecil"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('persentasekaskecil') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Persentase Overhead</th>
                    <td><input type="number" name="persentaseoverhead"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('persentaseoverhead') {{$message}} @enderror</td>
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

           @elseif($flag == 1)
            <form method="POST" action="">
              {{ csrf_field() }}
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
            <div style="text-align:center">
              <h3>
                  <span>Data persentase kas kecil {{$persentasekas}} dan overhead {{$persentaseover}} sudah terisi. Data dapat di <a class="btn btn-outline-info btn-sm" href="{{URL::to('halamanupdatepersentase')}}">UPDATE</a></span>
              </h3>     
            </div>
          </form>

            @elseif($flag == 2)

             <form method="POST" action="{{route('persentase.update', $idpersentasekas." ".$idpersentaseover)}}" role="form" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('put') }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 50px; margin-right: 500px;">
                  
                  <tr>
                    <th>Persentase Kas Kecil</th> 
                    <td><input type="number" name="persentasekaskecil" value="{{ $persentasekas }}">  </td>
                  </tr>
                  <tr>
                    <th>Persentase Overhead</th>
                    <td><input type="number" name="persentaseoverhead" value="{{ $persentaseover }}">  </td>
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
      <!-- End Navbar -->

          <div class="card">
            
            <div class="card-header" id="headingFive">
              <div class="card-header card-header-primary">
              <h3 class="card-title" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">Input Profit Sharing</h3>
              </div>
            </div>

            <!-- lihat sini -->
            <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
            <form method="POST" action="{{ route('profitsharing.store') }}">
              {{ csrf_field() }}
            <div class="card-body">
               <div style="text-align:center">
                <h2>
                  <span name="idperiode" value="{{ $periodess->id_periode }}">Periode {{ $periodess->bulan }} - {{ $periodess->tahun }}</span>
                </h2>
                </div>
              <div class="row">
                <!-- lnnkkjhkhk -->
                <table style="width:100%; margin-left: 50px; margin-right: 500px;">
                  
                  <tr>
                    <th>Pihak</th> 
                    <td><input type="text" name="pihak"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('pihak') {{$message}} @enderror</td>
                  </tr>
                  <tr>
                    <th>Persentase</th>
                    <td><input type="number" name="persentase"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="color:red;">@error('persentase') {{$message}} @enderror</td>
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
      @endsection