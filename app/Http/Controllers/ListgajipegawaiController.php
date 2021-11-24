<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kriteriagajipegawai;
use App\Listgajipegawai;
use App\Totalgajipegawai;
use DB;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class ListgajipegawaiController extends Controller
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
    public function create(Request $request, $kodeidpegawai)
    {
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

        return view('gaji.cekgaji', compact('gajilembur','gajitepatwaktu', 'gajiontime', 'gajibonusbulanan', 'hasilgajiakhir', 'kodeidpegawai', 'flaggaji', 'idlistgajipegawai', 'idtotalgaji' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $kodeidpegawai)
    {
        $listgaji = new Listgajipegawai();
        $listgaji->id_pegawais = $kodeidpegawai;
        $listgaji->id_periode = $_SESSION["idperiodepegawai"];
        $listgaji->tepat_waktu = $request->get('tepatwaktu');
        $listgaji->lembur = $request->get('lembur');
        $listgaji->bonus_bulanan = $request->get('bonusbulanan');
        $listgaji->bonus_ontime = $request->get('bonusontime');
        $listgaji->save();

        $idtotalgaji = $listgaji->id_listgajipegawais ;

        $totalgaji = new Totalgajipegawai();
        $totalgaji->id_listgajipegawais = $idtotalgaji;
        $totalgaji->total = $request->get('totalgaji');
        $totalgaji->save();

        return redirect('periode');        
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
    public function update(Request $request, $tepatwaktu,$lembur,$bonusbulanan,$bonusontime,$totalgaji,$idlistgaji,$idtotalgaji)
    {
        $listgaji = Listgajipegawai::find($idlistgaji);
        $listgaji->tepat_waktu = $tepatwaktu;
        $listgaji->lembur = $lembur;
        $listgaji->bonus_bulanan = $bonusbulanan;
        $listgaji->bonus_ontime = $bonusontime;
        $listgaji->save();

        $totalgajis = Totalgajipegawai::find($idtotalgaji);
        $totalgajis->total = $totalgaji;
        $totalgajis->save();
        return redirect('backkriteriagaji');    

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
}
