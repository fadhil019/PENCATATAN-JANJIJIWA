<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dailyexpenses;
use App\Totaldailyexpenses;
use App\Monthlyexpense;
use App\Totalmonthlyexpenses;
use App\Totalsales;
use App\Penjualansales;
use DB;
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class TotalDailyExpensesController extends Controller
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
    public function store(Request $request, $flag,$id,$jumlah)
    {   
        if($flag == 2)
        {
            $totaldaily = Totaldailyexpenses::find($id);
            $totaldaily->total_daily_expense = $jumlah;
            $totaldaily->save();          
        }
        else{
            $totaldaily = new Totaldailyexpenses();
            $totaldaily->id_periode = $_SESSION["idperiodelist"];
            $totaldaily->id_users = $_SESSION["iduser"];
            $totaldaily->total_daily_expense = $request->get('totaldaily');
            $totaldaily->save();              
        }
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

    public function perhitungandaily()
    {
        $idperiodelists = $_SESSION["idperiodelist"];        
        $idusers = $_SESSION["iduser"];
        $listdailys = Dailyexpenses::whereId_periode($idperiodelists)->get();
        $jumlahs=0;
        foreach ($listdailys as $value) {
            $jumlahs= $jumlahs + $value->balance;
        }

        $datajumlahdaily = DB::table('totaldailyexpenses')->where('id_periode','=', $idperiodelists)->where('id_users','=', $idusers)->get();
        $flagjumlahdaily=0;
        $idjumlahdaily=0;
        if( count($datajumlahdaily) == 0)
        {
            $flagjumlahdaily =0;
        }
        else
        {
            foreach ($datajumlahdaily as $value) {
                if( $jumlahs == $value->total_daily_expense)
                {
                    $flagjumlahdaily = 1;
                }
                else
                {
                    $flagjumlahdaily =2;
                    $idjumlahdaily = $value->id_totaldailyexpense;
                }
            }
        }
        //$listdailys[0]->balance;
        return view('list.jumlahdaily', compact('jumlahs','flagjumlahdaily', 'idjumlahdaily'));
    }

    public function perhitunganmonthly()
    {
        $idperiodelists = $_SESSION["idperiodelist"];
        $idusers = $_SESSION["iduser"];
        $listmonthlys = Monthlyexpense::whereId_periode($idperiodelists)->get();
        $jumlahs=0;
        foreach ($listmonthlys as $value) {
            $jumlahs= $jumlahs + $value->subtotal;
        }

        $datajumlahmonthly = DB::table('totalmonthlyexpenses')->where('id_periode','=', $idperiodelists)->where('id_users','=', $idusers)->get();
        $flagjumlahmonthly=0;
        $idjumlahmonthly=0;
        if( count($datajumlahmonthly) == 0)
        {
            $flagjumlahmonthly =0;
        }
        else
        {
            foreach ($datajumlahmonthly as $value) {
                if( $jumlahs == $value->total_monthly_expense)
                {
                    $flagjumlahmonthly = 1;
                }
                else
                {
                    $flagjumlahmonthly =2;
                    $idjumlahmonthly = $value->id_totalmonthlyexpense;
                }
            }
        }
        //$listdailys[0]->balance;
        return view('list.jumlahmonthly', compact('jumlahs','flagjumlahmonthly', 'idjumlahmonthly'));
    }

    public function simpantotalmonthly(Request $request, $flag,$id,$jumlah)
    {   

        if($flag == 0)
        {
            $totalmonthly = new Totalmonthlyexpenses();
            $totalmonthly->id_periode = $_SESSION["idperiodelist"];
            $totalmonthly->id_users = $_SESSION["iduser"];
            $totalmonthly->total_monthly_expense = $request->get('totalmonthly');
            $totalmonthly->save();
        }
        elseif ($flag ==2) {
            $totalmonthly = Totalmonthlyexpenses::find($id);
            $totalmonthly->total_monthly_expense =$jumlah;
            $totalmonthly->save();
        }
        return redirect('periode');
    }

    public function perhitungansales()
    {
        $idjenissales = $_SESSION["idjenissales"];
        $idperiodelists = $_SESSION["idperiodelist"];
        $idusers = $_SESSION["iduser"];
        $listsaless = DB::table('listsales')->where('id_periode','=', $idperiodelists)->where('id_jenissales','=', $idjenissales)->get();
        $jenissaless = DB::table('jenissales')->where('id_jenissales','=', $idjenissales)->get();

        $jumlahs=0;
        $jenissales="";
        // $jmlakhirss = 0;
        foreach ($listsaless as $value) {
            $jumlahs= $jumlahs + $value->akhir;
            // $jmlakhirss = number_format($jumlahs, 2);
        }
        foreach ($jenissaless as $value) {
            $jenissales= $value->nama;
        }
        $datajumlahsales = DB::table('Penjualansales')->where('id_periode','=', $idperiodelists)->where('id_jenissales','=', $idjenissales)->where('id_users','=', $idusers)->get();
        $flagjumlahsales=0;
        $idjumlahsales=0;
        if( count($datajumlahsales) == 0)
        {
            $flagjumlahsales =0;
        }
        else
        {
            foreach ($datajumlahsales as $value) {
                if( $jumlahs == $value->jumlah)
                {
                    $flagjumlahsales = 1;
                }
                else
                {
                    $flagjumlahsales =2;
                    $idjumlahsales = $value->id_penjualansales;
                }
            }
        }


        //$listdailys[0]->balance;
        return view('list.jumlahsales', compact('jenissales','jumlahs','flagjumlahsales','idjumlahsales') );
    }

    public function simpantotalsales(Request $request, $flag,$id,$jumlah)
    {   

        if($flag == 0)
        {
            $totalsales = new Penjualansales();
            $totalsales->id_periode = $_SESSION["idperiodelist"];
            $totalsales->id_users = $_SESSION["iduser"];
            $totalsales->id_jenissales = $_SESSION["idjenissales"];
            $totalsales->jumlah = $request->get('totalsales');
            $totalsales->save();
        }
        elseif ($flag ==2) {
            $psales = Penjualansales::find($id);
            $psales->jumlah = $jumlah;
            $psales->save();
        }
        
        return redirect('periode');
    }
    

}
