<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Jenissale;
use App\Listsale;
use DB;
use Auth;

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class ListSalesController extends Controller
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
            'tanggalsales' => 'required'
        ],
        [
            'tanggalsales.required' => 'Field tanggal tidak boleh dikosongi'
        ]);

        $listsales = new Listsale();
        $listsales->id_jenissales = $request->get('jenissales');
        $listsales->id_periode =$_SESSION["idperiode"];
        $listsales->id_users =$_SESSION["iduser"];
        $listsales->tanggal = $request->get('tanggalsales');
        $listsales->total = $request->get('total');
        $listsales->komisi = $request->get('komisi');
        $listsales->akhir = $request->get('totalakhir');
        $listsales->save();
        return redirect('halamanparsinglistsales');
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
        //
    }

    public function listsales2(Request $request)
    {
        $data = request()->validate([
            'totalsales' => 'required'
        // ],
        // [
        //     'totalsales.required' => 'Field tanggal tidak boleh dikosongi'
        ]);

        $persentases =0;
        $idjenissales=$request->get('jenissaless');
        $listsaless =  DB::table('jenissales')->where('id_jenissales','=', $idjenissales )->get();
        foreach ($listsaless as $value) {
            $persentases = $value->persentase;
        }

        $totalharga = $request->get('totalsales');
        $nilaipersentase = $persentases/100;
        $komisisales =  $totalharga * $nilaipersentase;
        $totalakhir = $totalharga - $komisisales;
        $flagsales =1;
        $listpersentasekaskecil = DB::table('persentasekaskecils')->where('id_periode','=', $_SESSION["idperiode"] )->get();
        $listpersentaseoverhead = DB::table('persentaseoverheads')->where('id_periode','=', $_SESSION["idperiode"] )->get();

        $flag=0;
        $idpersentasekas=0;
        $idpersentaseover=0;
        $persentasekas=0;
        $persentaseover=0;
        
        if( count($listpersentasekaskecil) == 0)
        {
            $flag =0;
        }
        else
        {
            $flag =1;
            foreach ($listpersentasekaskecil as $valuekas) {
                foreach ($listpersentaseoverhead as $valueover) {
                    $idpersentasekas= $valuekas->id_persentase_kas_kecil;
                    $idpersentaseover = $valueover->id_persentase_overhead;
                    $persentasekas = $valuekas->persentase;
                    $persentaseover = $valueover->persentase;
                }
            }
        }

        $periodess = Periode::whereId_periode($_SESSION["idperiode"]) -> firstOrFail();
        $jenissaless =  DB::table('Jenissales')->where('id_periode','=', $_SESSION["idperiode"])->where('id_users','=',  $_SESSION["iduser"])->get();
        $tampilpersentase=0.0;
        foreach ($jenissaless as $value) {
            if ($value->id_jenissales == $idjenissales) {
                $tampilpersentase = $value->persentase;
            }
        }
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

        return view('sales.createlistsales',compact('periodess', 'jenissaless', 'flag', 'idpersentasekas', 'idpersentaseover', 'persentasekas', 'persentaseover', 'idjenissales', 'totalharga', 'komisisales', 'totalakhir', 'flagsales', 'tahuns', 'kodebulan', 'tampilpersentase') );
    }
}
