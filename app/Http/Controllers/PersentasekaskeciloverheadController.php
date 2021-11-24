<?php

namespace App\Http\Controllers;

use App\Persentasekaskecil;
use App\Persentaseoverhead;
use App\Periode;
use App\Jenissale;
use DB;
use Illuminate\Http\Request;

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class PersentasekaskeciloverheadController extends Controller
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
            'persentasekaskecil' => 'required',
            'persentaseoverhead' => 'required'
        ],
        [
            'persentasekaskecil.required' => 'Field persentase kas kecil tidak boleh dikosongi',
            'persentaseoverhead.required' => 'Field persentase overhead tidak boleh dikosongi'
        ]);
        
        $persentasekaskecil = new Persentasekaskecil();
        $persentasekaskecil->id_periode = $_SESSION["idperiode"];;
        $persentasekaskecil->persentase = $request->get('persentasekaskecil');
        $persentasekaskecil->save();

        $persentaseoverhead = new Persentaseoverhead();
        $persentaseoverhead->id_periode = $_SESSION["idperiode"];;
        $persentaseoverhead->persentase = $request->get('persentaseoverhead');
        $persentaseoverhead->save();

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
    public function edit()
    {
        $listpersentasekaskecil = DB::table('persentasekaskecils')->where('id_periode','=', $_SESSION["idperiode"] )->get();
        $listpersentaseoverhead = DB::table('persentaseoverheads')->where('id_periode','=', $_SESSION["idperiode"] )->get();

        $idpersentasekas=0;
        $idpersentaseover=0;
        $persentasekas=0;
        $persentaseover=0;
        foreach ($listpersentasekaskecil as $valuekas) {
            foreach ($listpersentaseoverhead as $valueover) {
                $persentasekas = $valuekas->persentase;
                $persentaseover = $valueover->persentase;
                $idpersentasekas= $valuekas->id_persentase_kas_kecil;
                $idpersentaseover = $valueover->id_persentase_overhead;
            }
        }
        $flag=2;
        $flagsales=0;
        $periodess = Periode::whereId_periode($_SESSION["idperiode"]) -> firstOrFail();
        $jenissaless = DB::table('Jenissales')->where('id_periode','=', $_SESSION["idperiode"])->where('id_users','=',  $_SESSION["iduser"])->get();        

        $periodess2 = DB::table('periodes')->where('id_periode','=', $_SESSION["idperiode"])->get();
         $arraybulan =['januari'=>1, 'februari'=>2, 'maret'=>3, 'april'=>4, 'mei'=>5, 'juni'=>6, 'juli'=>7, 'agustus'=>8, 'september'=>9, 'oktober'=>10, 'november'=>11, 'desember'=>12];
         $tahuns=0;
         $bulans='';
         $kodebulan='';
         foreach ($periodess2 as $value) {
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

        return view('sales.createlistsales',compact('periodess', 'jenissaless', 'flag', 'flagsales' , 'idpersentasekas', 'idpersentaseover', 'persentasekas', 'persentaseover', 'tahuns', 'kodebulan') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idkas)
    {
        $idkas = explode(" ", $idkas);
        $persentasekass = Persentasekaskecil::find($idkas[0]);
        $persentasekass->persentase = $request->get('persentasekaskecil');
        $persentasekass->save();

        $persentaseovers = Persentaseoverhead::find($idkas[1]);
        $persentaseovers->persentase = $request->get('persentaseoverhead');
        $persentaseovers->save();



        return redirect('periode');
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
