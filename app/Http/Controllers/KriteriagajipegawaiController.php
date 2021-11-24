<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteriagajipegawai;
use App\Pegawai;
use DB;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class KriteriagajipegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'tanggal' => 'required',
            // 'jumlahcup' => 'required'
        ],
        [
            'tanggal.required' => 'Field tanggal tidak boleh dikosongi',
            // 'jumlahcup.required' => 'Field jumlah cup tidak boleh dikosongi'
        ]);

        $kriteria = new Kriteriagajipegawai();
        $kriteria->id_pegawais = $request->get('idpegawai');
        $kriteria->id_periode = $_SESSION["idperiodepegawai"];
        $kriteria->tanggal = $request->get('tanggal');
        $kriteria->tepat_waktus = $request->get('tepatwaktu');
        $kriteria->lemburs = $request->get('lembur');
        $kriteria->jumlah_cup = $request->get('jumlahcup');
        $kriteria->bonus_times = $request->get('bonusontime');
        $kriteria->save();
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
        //
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
        $kriterias = Kriteriagajipegawai::find($id);
        $kriterias->delete();
        return redirect('backkriteriagaji');
    }

    public function backkriteriagaji()
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

    public function indexeditkriteriagaji($id)
    {
        $tanggalkriteria='';
        $tepatwaktu='';
        $lembur = '';
        $jumlahcup = 0;
        $bonustime = '';
        $kriterias = DB::table('kriteriagajipegawais')->where('id_kriteriagajipegawais','=', $id)->get();
        foreach ($kriterias as $value) {
            $tanggalkriteria = $value->tanggal;
            $tepatwaktu = $value->tepat_waktus;
            $lembur = $value->lemburs;
            $jumlahcup = $value->jumlah_cup;
            $bonustime = $value->bonus_times;
        }

        $kodeidpegawai = $_SESSION["idpegawai"];
        $pegawai = DB::table('pegawais')->where('id_pegawais','=', $kodeidpegawai)->get();
        $listtepatwaktu =array('masuk','absen');
        $listlembur =array('masuk','absen');
        $listbonusontime =array('masuk','absen');
        return view('gaji.editkriteriagajipegawai', compact('pegawai', 'tanggalkriteria', 'tepatwaktu', 'lembur', 'jumlahcup', 'bonustime', 'listtepatwaktu', 'listlembur', 'listbonusontime', 'id') );
    }

    public function editkriteriagaji(Request $request, $id)
    {
        $kodeperiode = $_SESSION["idperiodepegawai"];
        $kriteriagajipegawaiss = Kriteriagajipegawai::find($id);
        $kriteriagajipegawaiss->tanggal= $request->get('tanggal');
        $kriteriagajipegawaiss->tepat_waktus= $request->get('tepatwaktu');
        $kriteriagajipegawaiss->lemburs= $request->get('lembur');
        $kriteriagajipegawaiss->jumlah_cup= $request->get('jumlahcup');
        $kriteriagajipegawaiss->bonus_times= $request->get('bonusontime');
        $kriteriagajipegawaiss->save();

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
