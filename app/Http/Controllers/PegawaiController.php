<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Pegawai;
use App\Kriteriagajipegawai;
use App\Gajilembur;
use App\Gajibulanancup;
use App\Gajiontime;
use App\Gajitepatwaktu;
use DB;
use PDF;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flag =0;
        $periodes = DB::table('periodes')->where('id_users','=', $_SESSION["iduser"] )->get();
        if (count($periodes) == 0) {
            $flag =0;
        }
        else
        {
            $flag=1;
        }
        return view('gaji.index', compact('periodes' , 'flag'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gaji.createpegawai');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = request()->validate([
            'namapegawai' => 'required'
        ],
        [
            'namapegawai.required' => 'Field nama pegawai tidak boleh dikosongi'
        ]);

        $pegawais = new Pegawai();
        $pegawais->id_users = $_SESSION["iduser"];
        $pegawais->nama_pegawai = $request->get('namapegawai');
        $pegawais->save();
        return redirect('backkriteriagaji');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buatpegawai(Request $request)
    {
         $kodeperiode = $_SESSION["idperiodepegawai"];
         $periodess = DB::table('periodes')->where('id_periode','=', $kodeperiode)->get();
         $arraybulan =['januari'=>1, 'februari'=>2, 'maret'=>3, 'april'=>4, 'mei'=>5, 'juni'=>6, 'juli'=>7, 'agustus'=>8, 'september'=>9, 'oktober'=>10, 'november'=>11, 'desember'=>12];
         $tahuns=0;
         $bulans='';
         $kodebulan='';
         foreach ($periodess as $value) {
             $tahuns = $value->tahun;
             $bulans = $value->bulan;
         }
         foreach ($arraybulan as $key => $value) {
             if($key == $bulans){
                $kode = strval($value);
                if(strlen($kode) == 1)
                {
                 $kodebulan = "0".$kode;
                }
                else
                {
                    $kodebulan = $kode;
                }
             }
         }
         $pegawais = Pegawai::all();
         $flagpegawai=0;
         if(count($pegawais) == 0)
         {
            $flagpegawai=0;
         }
         else
         {
            $flagpegawai=1;
         }
         return view('gaji.createlistgaji', compact('pegawais', 'periodes', 'tahuns', 'kodebulan', 'flagpegawai'));
    }

    public function createpegawai()
    {
        return view('gaji.createpegawai');
    }

     public function listkriteriapegawai($idpegawai)
    {
        $idperiode = $_SESSION["idperiodepegawai"];
        $_SESSION["idpegawai"]= $idpegawai;
        $kodeidpegawai = $_SESSION["idpegawai"];
        $pegawai = DB::table('pegawais')->where('id_pegawais','=', $kodeidpegawai)->get();
        $kriterias = DB::table('Kriteriagajipegawais')->where('id_pegawais','=', $kodeidpegawai)->where('id_periode','=',$idperiode)->orderBy('tanggal', 'asc')-> get();
        return view('gaji.listkriteriagajipegawai', compact('kodeidpegawai','kriterias', 'pegawai') );
    }

    public function cetakgajipegawai()
    {
        $idperiode = $_SESSION["idperiodepegawai"];
        $kodeidpegawai = $_SESSION["idpegawai"];
        $pegawai = DB::table('pegawais')->where('id_pegawais','=', $kodeidpegawai)->get();
        $kriterias2 = DB::table('Kriteriagajipegawais')->where('id_pegawais','=', $kodeidpegawai)->where('id_periode','=',$idperiode)->orderBy('tanggal', 'asc')-> get();


        $idperiode = $_SESSION["idperiodepegawai"];
        $kriterias = DB::table('Kriteriagajipegawais')->where('id_pegawais','=', $kodeidpegawai)->where('id_periode','=',$idperiode)->get();   
        $uangtepatwaktu=0;
        $seluruh = count($kriterias);
        $jumlahtepatwaktu=0;
        $jumlahontime=0;
        $jumlahcup=0;

        $listgajitepatwaktu = DB::table('gajitepatwaktus')->where('id_periode','=', $idperiode)->get();
         $idgajitepatwaktu=0;
         $gajitepatwaktuss=0;
         $gajitidaktepatwaktuss=0;
         foreach ($listgajitepatwaktu as $value) {
            $idgajitepatwaktu = $value->id_gajitepatwaktus;
            $gajitepatwaktuss = $value->tepatwaktu;
            $gajitidaktepatwaktuss = $value->tidaktepatwaktu;
         }

         $listgajibulanancup = DB::table('gajibulanancups')->where('id_periode','=', $idperiode)->get();
         $idgajibulanancup=0;
         $gajibulanancupss=0;
         $jumlahcupss=0;
         foreach ($listgajibulanancup as $value) {
             $idgajibulanancup=$value->id_gajibulanancups;
             $gajibulanancupss=$value->gajibulanancup;
             $jumlahcupss=$value->jumlahcup;
         }

         $listgajilembur = DB::table('gajilemburs')->where('id_periode','=', $idperiode)->get();
         $idgajilembur=0;
         $gajilemburss=0;
         foreach ($listgajilembur as $value) {
             $idgajilembur=$value->id_gajilembur;
             $gajilemburss=$value->gajilembur;
         }

         $listgajiontime = DB::table('gajiontimes')->where('id_periode','=', $idperiode)->get();
         $idgajiontime=0;
         $gajiontimess=0;
         foreach ($listgajiontime as $value) {
             $idgajiontime=$value->id_gajiontime;
             $gajiontimess=$value->gajiontime;
         }

        //kirim
        $gajilembur=0;
        $gajitepatwaktu=0;
        $gajiontime=0;
        $gajibonusbulanan=0;
        foreach ($kriterias as $value) {
            if($value->tepat_waktus == 'masuk')
            {
                $jumlahtepatwaktu = $jumlahtepatwaktu + 1;
            }
            if ($value->bonus_times == 'masuk') {
                $jumlahontime = $jumlahontime + 1;
            }
            if ($value->lemburs == 'masuk') {
                $gajilembur = $gajilemburss + $gajilembur;
                // $gajilembur = 25000 + $gajilembur;
            }
            $jumlahcup = $value->jumlah_cup + $jumlahcup;
        }     

        if($jumlahtepatwaktu == $seluruh)
        {
            $gajitepatwaktu = $gajitepatwaktuss;
            // $gajitepatwaktu = 1500000;
        }   
        else
        {
            $gajitepatwaktu = $gajitidaktepatwaktuss;
            // $gajitepatwaktu = 1350000;
        }

        if ($jumlahontime == $seluruh) {
            $gajiontime = $gajiontimess;
            // $gajiontime = 200000;
        }
        else{
            $gajiontime=0;
        }

        // if ($jumlahcup >= 6000) {
        //     $gajibonusbulanan = 200000;
        // }
         if ($jumlahcup >= $jumlahcupss) {
            $gajibonusbulanan = $gajibulanancupss;
        }
        else
        {
            $gajibonusbulanan=0;
        }
         $hasilgajiakhir = $gajilembur + $gajibonusbulanan + $gajitepatwaktu + $gajiontime;

         $listgaji = DB::table('listgajipegawais')->where('id_pegawais','=', $kodeidpegawai)->where('id_periode','=',$idperiode)->get();
         
         $flaggaji=0;
         $idlistgajipegawai=0;
         if(count($listgaji) == 0)
         {
            $flaggaji =0;
         }
         else{
            $flaggaji =1;

            foreach ($listgaji as $value) {
                $idlistgajipegawai = $value->id_listgajipegawais;
                if($value->tepat_waktu != $gajitepatwaktu)
                {
                    $flaggaji =2;
                }
                else
                {}
                if ($value->lembur != $gajilembur) {
                    $flaggaji=2;
                }
                else
                {}
                if ($value->bonus_bulanan != $gajibonusbulanan) {
                    $flaggaji = 2;
                }
                else
                {}
                if($value->bonus_ontime != $gajiontime){
                    $flaggaji =2;
                }
                else
                {}
            }
         }
         $idtotalgaji =0;
         $listtotalgaji = DB::table('totalgajipegawais')->where('id_listgajipegawais','=', $idlistgajipegawai)->get();
         foreach ($listtotalgaji as $value) {
             $idtotalgaji = $value->id_totalgajipegawais;
         }

         $pdf = PDF::loadView('gaji.cetakgaji', compact('kriterias2', 'pegawai', 'gajilembur','gajitepatwaktu', 'gajiontime', 'gajibonusbulanan', 'hasilgajiakhir', 'kodeidpegawai', 'flaggaji', 'idlistgajipegawai', 'idtotalgaji'));


         return $pdf->stream();
    }

    public function indexgajipokok(Request $request)
    {
         $_SESSION["idperiodepegawai"] = $request->get('idperiodegaji');
         $kodeperiode = $_SESSION["idperiodepegawai"];
         $flag=0;
         $listgajitepatwaktu = DB::table('gajitepatwaktus')->where('id_periode','=', $kodeperiode)->get();
         if(count($listgajitepatwaktu)==0){
            $flag=0;
         }
         else
         {
            $flag=1;
         }

         $listgajitepatwaktu = DB::table('gajitepatwaktus')->where('id_periode','=', $kodeperiode)->get();
         $idgajitepatwaktu=0;
         $gajitepatwaktuss=0;
         $gajitidaktepatwaktuss=0;
         foreach ($listgajitepatwaktu as $value) {
            $idgajitepatwaktu = $value->id_gajitepatwaktus;
            $gajitepatwaktuss = $value->tepatwaktu;
            $gajitidaktepatwaktuss = $value->tidaktepatwaktu;
         }

         $listgajibulanancup = DB::table('gajibulanancups')->where('id_periode','=', $kodeperiode)->get();
         $idgajibulanancup=0;
         $gajibulanancupss=0;
         $jumlahcupss=0;
         foreach ($listgajibulanancup as $value) {
             $idgajibulanancup=$value->id_gajibulanancups;
             $gajibulanancupss=$value->gajibulanancup;
             $jumlahcupss=$value->jumlahcup;
         }

         $listgajilembur = DB::table('gajilemburs')->where('id_periode','=', $kodeperiode)->get();
         $idgajilembur=0;
         $gajilemburss=0;
         foreach ($listgajilembur as $value) {
             $idgajilembur=$value->id_gajilembur;
             $gajilemburss=$value->gajilembur;
         }

         $listgajiontime = DB::table('gajiontimes')->where('id_periode','=', $kodeperiode)->get();
         $idgajiontime=0;
         $gajiontimess=0;
         foreach ($listgajiontime as $value) {
             $idgajiontime=$value->id_gajiontime;
             $gajiontimess=$value->gajiontime;
         }
         
         return view('uangpokokgaji.index', compact('kodeperiode', 'flag', 'idgajitepatwaktu', 'gajitepatwaktuss', 'gajitidaktepatwaktuss', 'idgajibulanancup', 'gajibulanancupss', 'jumlahcupss', 'idgajilembur', 'gajilemburss', 'idgajiontime', 'gajiontimess'));
    }

    public function indexeditgajipokok(Request $request)
    {
         $kodeperiode = $_SESSION["idperiodepegawai"];
         $flag=0;
         $listgajitepatwaktu = DB::table('gajitepatwaktus')->where('id_periode','=', $kodeperiode)->get();
         $idgajitepatwaktu=0;
         $gajitepatwaktuss=0;
         $gajitidaktepatwaktuss=0;
         foreach ($listgajitepatwaktu as $value) {
            $idgajitepatwaktu = $value->id_gajitepatwaktus;
            $gajitepatwaktuss = $value->tepatwaktu;
            $gajitidaktepatwaktuss = $value->tidaktepatwaktu;
         }

         $listgajibulanancup = DB::table('gajibulanancups')->where('id_periode','=', $kodeperiode)->get();
         $idgajibulanancup=0;
         $gajibulanancupss=0;
         $jumlahcupss=0;
         foreach ($listgajibulanancup as $value) {
             $idgajibulanancup=$value->id_gajibulanancups;
             $gajibulanancupss=$value->gajibulanancup;
             $jumlahcupss=$value->jumlahcup;
         }

         $listgajilembur = DB::table('gajilemburs')->where('id_periode','=', $kodeperiode)->get();
         $idgajilembur=0;
         $gajilemburss=0;
         foreach ($listgajilembur as $value) {
             $idgajilembur=$value->id_gajilembur;
             $gajilemburss=$value->gajilembur;
         }

         $listgajiontime = DB::table('gajiontimes')->where('id_periode','=', $kodeperiode)->get();
         $idgajiontime=0;
         $gajiontimess=0;
         foreach ($listgajiontime as $value) {
             $idgajiontime=$value->id_gajiontime;
             $gajiontimess=$value->gajiontime;
         }
         $flag=2;
         
         return view('uangpokokgaji.index', compact('kodeperiode', 'flag', 'idgajitepatwaktu', 'gajitepatwaktuss', 'gajitidaktepatwaktuss', 'idgajibulanancup', 'gajibulanancupss', 'jumlahcupss', 'idgajilembur', 'gajilemburss', 'idgajiontime', 'gajiontimess'));
    }

    public function isigajipokok(Request $request)
    {
        $data = request()->validate([
            'gajitepatwaktu' => 'required',
            'gajitidaktepatwaktu' => 'required',
            'gajijumlahcup' => 'required',
            'jumlahcup' => 'required',
            'gajilembur' => 'required',
            'gajiontime' => 'required'
        ],
        [
            'gajitepatwaktu.required' => 'Field gaji tepat waktu (full) tidak boleh dikosongi',
            'gajitidaktepatwaktu.required' => 'Field gaji tepat waktu (not full) tidak boleh dikosongi',
            'gajijumlahcup.required' => 'Field bonus jumlah cup tidak boleh dikosongi',
            'jumlahcup.required' => 'Field jumlah cup tidak boleh dikosongi',
            'gajilembur.required' => 'Field bonus lembur tidak boleh dikosongi',
            'gajiontime.required' => 'Field bonus on time tidak boleh dikosongi'
        ]);

         $kodeperiode = $_SESSION["idperiodepegawai"];
        $gajibulanancups = new Gajibulanancup();
        $gajibulanancups->id_periode = $kodeperiode;
        $gajibulanancups->id_users =  $_SESSION["iduser"];
        $gajibulanancups->gajibulanancup = $request->get('gajijumlahcup');
        $gajibulanancups->jumlahcup = $request->get('jumlahcup');
        $gajibulanancups->save();

        $gajilemburss = new Gajilembur();
        $gajilemburss->id_periode = $kodeperiode;
        $gajilemburss->id_users =  $_SESSION["iduser"];
        $gajilemburss->gajilembur = $request->get('gajilembur');
        $gajilemburss->save();

        $gajiontimes = new Gajiontime();
        $gajiontimes->id_periode = $kodeperiode;
        $gajiontimes->id_users =  $_SESSION["iduser"];
        $gajiontimes->gajiontime =  $request->get('gajiontime');
        $gajiontimes->save();

        $gajitepatwaktus = new Gajitepatwaktu();
        $gajitepatwaktus->id_periode = $kodeperiode;
        $gajitepatwaktus->id_users =  $_SESSION["iduser"]; 
        $gajitepatwaktus->tepatwaktu = $request->get('gajitepatwaktu');
        $gajitepatwaktus->tidaktepatwaktu = $request->get('gajitidaktepatwaktu');
        $gajitepatwaktus->save();
         
         $periodess = DB::table('periodes')->where('id_periode','=', $kodeperiode)->get();
         $arraybulan =['januari'=>1, 'februari'=>2, 'maret'=>3, 'april'=>4, 'mei'=>5, 'juni'=>6, 'juli'=>7, 'agustus'=>8, 'september'=>9, 'oktober'=>10, 'november'=>11, 'desember'=>12];
         $tahuns=0;
         $bulans='';
         $kodebulan='';
         foreach ($periodess as $value) {
             $tahuns = $value->tahun;
             $bulans = $value->bulan;
         }
         foreach ($arraybulan as $key => $value) {
             if($key == $bulans){
                $kode = strval($value);
                if(strlen($kode) == 1)
                {
                 $kodebulan = "0".$kode;
                }
                else
                {
                    $kodebulan = $kode;
                }
             }
         }
         $pegawais = Pegawai::all();
         $flagpegawai=0;
         if(count($pegawais) == 0)
         {
            $flagpegawai=0;
         }
         else
         {
            $flagpegawai=1;
         }
         return view('gaji.createlistgaji', compact('pegawais', 'periodes', 'tahuns', 'kodebulan', 'flagpegawai'));
    }

    public function updategajipokok(Request $request, $idgajitepatwaktu, $idgajibulanancup, $idgajilembur, $idgajiontime)
    {
         $kodeperiode = $_SESSION["idperiodepegawai"];

         $gajitepatwaktuss = Gajitepatwaktu::find($idgajitepatwaktu);
         $gajitepatwaktuss->tepatwaktu= $request->get('gajitepatwaktu');
         $gajitepatwaktuss->tidaktepatwaktu= $request->get('gajitidaktepatwaktu');
         $gajitepatwaktuss->save();

         $gajibulanancupss = Gajibulanancup::find($idgajibulanancup);
         $gajibulanancupss->gajibulanancup= $request->get('gajijumlahcup');
         $gajibulanancupss->jumlahcup= $request->get('jumlahcup');
         $gajibulanancupss->save();

         $gajilemburss = Gajilembur::find($idgajilembur);
         $gajilemburss->gajilembur= $request->get('gajilembur');
         $gajilemburss->save();

         $gajiontimess = Gajiontime::find($idgajiontime);
         $gajiontimess->gajiontime= $request->get('gajiontime');
         $gajiontimess->save();
         
         $periodess = DB::table('periodes')->where('id_periode','=', $kodeperiode)->get();
         $arraybulan =['januari'=>1, 'februari'=>2, 'maret'=>3, 'april'=>4, 'mei'=>5, 'juni'=>6, 'juli'=>7, 'agustus'=>8, 'september'=>9, 'oktober'=>10, 'november'=>11, 'desember'=>12];
         $tahuns=0;
         $bulans='';
         $kodebulan='';
         foreach ($periodess as $value) {
             $tahuns = $value->tahun;
             $bulans = $value->bulan;
         }
         foreach ($arraybulan as $key => $value) {
             if($key == $bulans){
                $kode = strval($value);
                if(strlen($kode) == 1)
                {
                 $kodebulan = "0".$kode;
                }
                else
                {
                    $kodebulan = $kode;
                }
             }
         }
         $pegawais = Pegawai::all();
         $flagpegawai=0;
         if(count($pegawais) == 0)
         {
            $flagpegawai=0;
         }
         else
         {
            $flagpegawai=1;
         }
         return view('gaji.createlistgaji', compact('pegawais', 'periodes', 'tahuns', 'kodebulan', 'flagpegawai'));
    }
}
