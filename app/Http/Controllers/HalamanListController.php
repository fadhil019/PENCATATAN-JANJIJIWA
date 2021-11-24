<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;
use App\Listsale;
use App\Monthlyexpense;
use App\Dailyexpenses;
use App\Jenissale;
use App\Profitsharing;
use DB;
use PDF;
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class HalamanListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodes = DB::table('periodes')->where('id_users','=', $_SESSION["iduser"] )->get();
        return view('list.index', ['periodes'=>$periodes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idjenissaless =$id;
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];

        $idjenissales = $idjenissaless;
        $idperiodelists = $idperiodelistcashflow;
        $listsaless = DB::table('listsales')->where('id_periode','=', $idperiodelists)->where('id_jenissales','=', $idjenissales)->get();
        $jenissaless = DB::table('jenissales')->where('id_jenissales','=', $idjenissales)->get();
        $jumlahpenjualansales = DB::table('penjualansales')->where('id_jenissales','=', $idjenissales)->where('id_periode','=', $idperiodelists)->get();

        $jumlah=0;
        $namajenis="";
        foreach ($listsaless as $value) {
            $jumlah= $jumlah + $value->akhir;
        }
        foreach ($jenissaless as $value) {
            $namajenis= $value->nama;
        }

        return view('cashflow.listlengkapsales', compact('listsaless','namajenis','jumlahpenjualansales','jumlah'));
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

    public function tohalamanlistpilihan(Request $request)
    {
        $_SESSION["idperiodelist"] = $request->get('idperiodelist');
         return view('list.listpilihan');
    }

    public function tohalamanlistsales(Request $request)
    {


        // DB::table('nama_tabel')
        //     ->where('ddd','=', 'adda')
        //     ->orwhere('ddd','=', 'adda')
        //     ->get();

        $_SESSION["idjenissales"] = $request->get('idjenissales');
        $idjenissales = $_SESSION["idjenissales"];
        $idperiodelists = $_SESSION["idperiodelist"];
        $listsaless = DB::table('listsales')->where('id_periode','=', $idperiodelists)->where('id_jenissales','=', $idjenissales)->orderBy('tanggal', 'asc')->get();
        return view('list.listsales', ['listsaless'=>$listsaless] , ['idperiodelists'=>$idperiodelists]);
    }

    public function tohalamanlistdaily()
    {
        $idperiodelists = $_SESSION["idperiodelist"];
        $listdailys = Dailyexpenses::whereId_periode($idperiodelists)->orderBy('tanggal', 'asc')->get();
        return view('list.listdaily', ['listdailys'=>$listdailys] , ['idperiodelists'=>$idperiodelists]);
    }

    public function tohalamanlistmonthly()
    {
        $idperiodelists = $_SESSION["idperiodelist"];
        $listmonthlys = Monthlyexpense::whereId_periode($idperiodelists)->orderBy('tanggal', 'asc')->get();
        return view('list.listmonthly', ['listmonthlys'=>$listmonthlys] , ['idperiodelists'=>$idperiodelists]);
    }

     public function tohalamanlistjenissales()
    {
        $listjenissaless = DB::table('Jenissales')->where('id_periode','=', $_SESSION["idperiodelist"])->where('id_users','=',  $_SESSION["iduser"])->get();
        return view('list.listjenissales', ['listjenissaless'=>$listjenissaless]);
    }

     public function tohalamanlistprofitsharing()
    {
        $idperiodelists = $_SESSION["idperiodelist"];
        $listprofitsharings = Profitsharing::whereId_periode($idperiodelists)->orderBy('persentase', 'desc')->get();
        return view('list.listprofitsharing', compact('idperiodelists' , 'listprofitsharings') );
    }

    public function tolistlengkapsales($id)
    {
        $idjenissaless =$id;
        $_SESSION["idlistjenissales"] = $idjenissaless;
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];

        $idjenissales = $idjenissaless;
        $idperiodelists = $idperiodelistcashflow;
        $listsaless = DB::table('listsales')->where('id_periode','=', $idperiodelists)->where('id_jenissales','=', $idjenissales)->orderBy('tanggal', 'asc')->get();
        $jenissaless = DB::table('jenissales')->where('id_jenissales','=', $idjenissales)->get();
        $jumlahpenjualansales = DB::table('penjualansales')->where('id_jenissales','=', $idjenissales)->where('id_periode','=', $idperiodelists)->get();

        $jumlah=0;
        $namajenis="";
        foreach ($listsaless as $value) {
            $jumlah= $jumlah + $value->akhir;
        }
        foreach ($jenissaless as $value) {
            $namajenis= $value->nama;
        }

        return view('cashflow.listlengkapsales', compact('listsaless','namajenis','jumlahpenjualansales','jumlah'));

    }
     public function cetaklistsales()
    {
        $idjenissaless =$_SESSION["idlistjenissales"];
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];

        $idperiode = $_SESSION["idperiodecashflow"];
        $periodess = DB::table('periodes')->where('id_periode','=', $idperiode)->get();
        $idjenissales = $idjenissaless;
        $idperiodelists = $idperiodelistcashflow;
        $listsaless = DB::table('listsales')->where('id_periode','=', $idperiodelists)->where('id_jenissales','=', $idjenissales)->orderBy('tanggal', 'asc')->get();
        $jenissaless = DB::table('jenissales')->where('id_jenissales','=', $idjenissales)->get();
        $jumlahpenjualansales = DB::table('penjualansales')->where('id_jenissales','=', $idjenissales)->where('id_periode','=', $idperiodelists)->get();

        $jumlah=0;
        $namajenis="";
        foreach ($listsaless as $value) {
            $jumlah= $jumlah + $value->akhir;
        }
        foreach ($jenissaless as $value) {
            $namajenis= $value->nama;
        }

        $pdf = PDF::loadView('cashflow.cetaklistsales', compact('listsaless','namajenis','jumlahpenjualansales','jumlah','periodess'));


        return $pdf->stream();

    }

    public function tolistlengkapdaily()
    {
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];

        $idperiodelists = $idperiodelistcashflow;        
        $listdailys = Dailyexpenses::whereId_periode($idperiodelists)->orderBy('tanggal', 'asc')->get();
        
        $jumlah=0;
        foreach ($listdailys as $value) {
            $jumlah= $jumlah + $value->balance;
        }

        return view('cashflow.listlengkapdaily', compact('listdailys','jumlah'));

    }

    public function cetaklistdaily()
    {
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];

        $idperiodelists = $idperiodelistcashflow;        
        $listdailys = Dailyexpenses::whereId_periode($idperiodelists)->orderBy('tanggal', 'asc')->get();
        $idperiode = $_SESSION["idperiodecashflow"];
        $periodess = DB::table('periodes')->where('id_periode','=', $idperiode)->get();
        $jumlah=0;
        foreach ($listdailys as $value) {
            $jumlah= $jumlah + $value->balance;
        }

        $pdf = PDF::loadView('cashflow.cetaklistdaily', compact('listdailys','jumlah','periodess'));


        return $pdf->stream();

    }

    public function tolistlengkapmonthly()
    {
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];

        $idperiodelists = $idperiodelistcashflow;        
        $listmonthlys = Monthlyexpense::whereId_periode($idperiodelists)->orderBy('tanggal', 'asc')->get();

        $jumlah=0;
        foreach ($listmonthlys as $value) {
            $jumlah= $jumlah + $value->subtotal;
        }

        return view('cashflow.listlengkapmonthly', compact('listmonthlys','jumlah'));

    }

    public function cetaklistmonthly()
    {
        $idperiodelistcashflow = $_SESSION["idperiodecashflow"];
        $periodess = DB::table('periodes')->where('id_periode','=', $idperiodelistcashflow)->get();

        $idperiodelists = $idperiodelistcashflow;        
        $listmonthlys = Monthlyexpense::whereId_periode($idperiodelists)->orderBy('tanggal', 'asc')->get();

        $jumlah=0;
        foreach ($listmonthlys as $value) {
            $jumlah= $jumlah + $value->subtotal;
        }

        $pdf = PDF::loadView('cashflow.cetaklistmonthly', compact('listmonthlys','jumlah','periodess'));


        return $pdf->stream();

    }
}
