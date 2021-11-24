<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Jenissale;
use DB;
use Auth;

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $_SESSION["iduser"] = Auth::id();
        // dd($_SESSION['iduser']);
        return view('periode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('periode.new');
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
            'bulan' => 'required',
            'tahun' => 'required|digits:4'
        ]);

        // $message = array(
        //     'required' => ''
        // );

        $periode = new Periode();
        $periode->id_users = $_SESSION["iduser"];
        // dd($_SESSION['iduser']);
        $periode->bulan = strtolower($request-> get('bulan'));
        $periode->tahun = $request-> get('tahun');
        $periode->save();
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

    public function tambahperiode()
    {
        return view('periode.new');
    }

    public function periodeexists()
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
        return view('periode.exists', compact('periodes','flag') );
    }

    public function halamanlistsales(Request $request)
    {
        // $flagaktif=0;
        // $periodecek = DB::table('periodes')->get();
        // if(count($periodecek) == 0)
        // {
        //     $flagaktif =0;
        // }
        // else
        // {

        // }
        $_SESSION["idperiode"] = $request->get('idperiode');
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
        $flagsales =0;
        $periodess = Periode::whereId_periode($_SESSION["idperiode"]) -> firstOrFail();
        //$jenissaless = Jenissale::all();
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

        return view('sales.createlistsales',compact('periodess', 'jenissaless', 'flag', 'idpersentasekas', 'idpersentaseover', 'persentasekas', 'persentaseover', 'flagsales', 'tahuns', 'kodebulan') );
    }

    public function halamanparsinglistsales()
    {
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
        $flagsales =0;

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

        return view('sales.createlistsales',compact('periodess', 'jenissaless', 'flag', 'idpersentasekas', 'idpersentaseover', 'persentasekas', 'persentaseover', 'flagsales', 'tahuns', 'kodebulan') );
    }
}
