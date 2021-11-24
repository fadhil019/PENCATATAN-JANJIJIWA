<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periode;

use App\Totalsales;
use App\Listexpenses;
use App\Totalexpenses;
use App\Totalsalesexpenses;
use App\Listmiscexpenses;
use App\Totalmiscexpenses;
use App\Totalprofit;
use App\Totalprofitsharing;

use PDF;
use DB;
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class CashflowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flag=0;
        $periodes = DB::table('periodes')->where('id_users','=', $_SESSION["iduser"] )->get();
        if (count($periodes) == 0) {
            $flag =0;
        }
        else
        {
            $flag=1;
        }
        return view('cashflow.index', compact('periodes','flag'));
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
            $idperiode = $_SESSION["idperiodecashflow"];
            $iduser = $_SESSION["iduser"];

            $totalsales = new Totalsales();
            $totalsales->id_periode = $idperiode;
            $totalsales->id_users = $iduser;
            $totalsales->total_sales = $request-> get('totalsales');
            $totalsales->save();

            $listexpenses = new Listexpenses();
            $listexpenses->id_periode = $idperiode;
            $listexpenses->ppn_pemkot = $request-> get('totalppn');
            $listexpenses->total_monthly_expense = $request-> get('totalmonthly');
            $listexpenses->total_daily_expense = $request-> get('totaldaily');
            $listexpenses->save();

            $totalexpenses = new Totalexpenses();
            $totalexpenses->id_periode = $idperiode;
            $totalexpenses->id_users = $iduser;
            $totalexpenses->total_expenses = $request-> get('jumlahtotalexpenses');
            $totalexpenses->save();

            $totalsalesexpenses =  new Totalsalesexpenses();
            $totalsalesexpenses->id_periode = $idperiode;
            $totalsalesexpenses->id_users = $iduser;
            $totalsalesexpenses->total = $request-> get('totalsalesminexpenses');
            $totalsalesexpenses->save();

            $listmiscexpenses = new Listmiscexpenses();
            $listmiscexpenses->id_periode = $idperiode;
            $listmiscexpenses->overhead = $request-> get('jumlahpersentaseover');
            $listmiscexpenses->kas_kecil = $request-> get('jumlahpersentasekas');
            $listmiscexpenses->save();

            $totalmiscexpenses = new Totalmiscexpenses();
            $totalmiscexpenses->id_periode = $idperiode;
            $totalmiscexpenses->total_misc_expenses = $request-> get('jumlahtotalmisexpenses');
            $totalmiscexpenses->save();

            $totalprofit = new Totalprofit();
            $totalprofit->id_periode = $idperiode;
            $totalprofit->total_profit = $request-> get('jumlahtotalprofit');
            $totalprofit->save();

            // $jumlahprofitsharings = new Totalprofitsharing();
            // $jumlahprofitsharings->id_profitsharings =  $request-> get('idprofitsharing');
            // $jumlahprofitsharings->id_periode = $idperiode;
            // $jumlahprofitsharings->id_users = $iduser;
            // $jumlahprofitsharings->total = $request-> get('jumlahprofitsharing');

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

    public function listcashflow(Request $request)
    {
         $_SESSION["idperiodecashflow"] = $request->get('idperiodelist');
         $idperiodelists = $_SESSION["idperiodecashflow"];
         $flag=0;

         $penjualansaless = DB::table('penjualansales')->where('id_periode','=', $idperiodelists)->get();

         $totalsales=0;//pengecekan pertama
         foreach ($penjualansaless as $penjualansales) {
             $totalsales = round($totalsales +$penjualansales->jumlah, 2);
         }

         $totalppn= round(0.1 * $totalsales , 2);// cek dengan table listexpenses pada kolom ppn_pemkot  
         $jumlahdaily=0;
         $jumlahmonthly=0;

         $totaldailys = DB::table('totaldailyexpenses')->where('id_periode','=', $idperiodelists)->get();
         foreach ($totaldailys as $totaldaily) {
             $jumlahdaily = round($jumlahdaily + $totaldaily->total_daily_expense , 2);
         }

         $totalmonthlys = DB::table('totalmonthlyexpenses')->where('id_periode','=', $idperiodelists)->get();
         foreach ($totalmonthlys as $totalmonthly) {
             $jumlahmonthly = round($jumlahmonthly + $totalmonthly->total_monthly_expense , 2);
         }

            $jumlahtotalexpenses = round($totalppn + $jumlahdaily + $jumlahmonthly , 2);//ini di cek juga

            $totalsalesminexpenses = round($totalsales - $jumlahtotalexpenses , 2);///ini juga dicek juga

         $persentasekass = DB::table('persentasekaskecils')->where('id_periode','=', $idperiodelists)->get();
         $persenkc=0;
         foreach ($persentasekass as $persentasekas) {
             $persenkc = $persentasekas->persentase;
         }

         $persentaseoverheadss = DB::table('persentaseoverheads')->where('id_periode','=', $idperiodelists)->get();
         $perseno=0;
         foreach ($persentaseoverheadss as $persentaseoverheads) {
             $perseno = $persentaseoverheads->persentase;
         }

         $jumlahpersentasekas = round(($persenkc/100) * $totalsalesminexpenses , 2);
         $jumlahpersentaseover = round(($perseno/100) * $totalsalesminexpenses, 2);


            $jumlahtotalmisexpenses = round($jumlahpersentasekas + $jumlahpersentaseover , 2);

            $jumlahtotalprofit = round($totalsalesminexpenses - $jumlahtotalmisexpenses , 2);

         

         $periodess = DB::table('periodes')->where('id_periode','=', $idperiodelists)->get();

         // $jenissaless = DB::table('jenissales')->get();

         $jenissaless = DB::table('Jenissales')->where('id_periode','=', $_SESSION["idperiodecashflow"])->where('id_users','=',  $_SESSION["iduser"])->get();

         $listprofitsharings = DB::table('profitsharings')->where('id_periode','=', $idperiodelists)->get();
         $arrayprofit=[];
         $tampunghasil=0;
         $persentaseprofitsharing=0;
         foreach ($listprofitsharings as $value) {
             $tampunghasil = ($value->persentase/100) * $jumlahtotalprofit;
             $arrayprofit[$value->id_profitsharings] = $tampunghasil;
             $persentaseprofitsharing = $value->persentase;
         }
         // $listjumlahprofitsharings = DB::table('totalprofitsharings')->where('id_periode','=', $idperiodelists)->get();


         $cekpenjualansales = DB::table('totalsales')->where('id_periode','=', $idperiodelists)->get();
         $cekkppnexpenses = DB::table('listexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalexpenses = DB::table('totalexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalsalesminexpenses = DB::table('totalsalesexpenses')->where('id_periode','=', $idperiodelists)->get();
         $ceklistmiscexpenses = DB::table('listmiscexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalmiscexpenses = DB::table('totalmiscexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalprofit = DB::table('totalprofits')->where('id_periode','=', $idperiodelists)->get();

         $idtotalsales=0;
         $idlistexpenses=0;
         $idtotalexpenses=0;
         $idtotalsalesminexpenses=0;
         $idtotalmiscexpenses=0;
         $idtotalprofit=0;
         $idlistmiscexpenses=0;

         // foreach ($cekpenjualansales as $valuepenjualansales) {
         //    foreach ($cekkppnexpenses as $valueppn) {
         //        foreach ($cektotalexpenses as $valuetotalexpenses) {
         //            foreach ($cektotalsalesminexpenses as $valuetotalsalesminexpenses) {
         //                foreach ($ceklistmiscexpenses as $valuelistmiscexpenses) {
         //                    foreach ($cektotalmiscexpenses as $valuetotalmiscexpenses) {
         //                        foreach ($cektotalprofit as $valuetotalprofit) {
         //                            foreach ($listjumlahprofitsharings as $valuejumlahprofitsharing) {
                                        
         //                                 if(count($cektotalprofit) == 0)
         //                                 {
         //                                    $flag  =0;
         //                                 }
         //                                 else
         //                                 {
         //                                     if($totalsales != $valuepenjualansales->total_sales || $totalppn != $valueppn->ppn_pemkot || $jumlahdaily != $valueppn->total_daily_expense || $jumlahmonthly != $valueppn->total_monthly_expense || $jumlahtotalexpenses != $valuetotalexpenses->total_expenses || $totalsalesminexpenses != $valuetotalsalesminexpenses->total || $jumlahtotalmisexpenses != $valuetotalmiscexpenses->total_misc_expenses || $jumlahtotalprofit != $valuetotalprofit->total_profit || $jumlahpersentasekas != $valuelistmiscexpenses->kas_kecil || $jumlahpersentaseover != $valuelistmiscexpenses->overhead )
         //                                     {
         //                                        $flag =2;
         //                                        $idtotalsales = $valuepenjualansales->id_totalsales;
         //                                        $idlistexpenses = $valueppn->id_listexpenses;
         //                                        $idtotalexpenses = $valuetotalexpenses->id_totalexpenses;
         //                                        $idtotalsalesminexpenses = $valuetotalsalesminexpenses->id_totalsalesexpenses;
         //                                        $idlistmiscexpenses = $valuelistmiscexpenses->id_list_misc_expenses;
         //                                        $idtotalmiscexpenses = $valuetotalmiscexpenses->id_total_misc_expenses;
         //                                        $idtotalprofit = $valuetotalprofit->id_totalprofit;
         //                                     }
         //                                     else
         //                                     {
         //                                        $flag = 1;
         //                                     }

         //                                }
         //                            }                                  

         //                        }
         //                    }
         //                }
         //            }
         //        }
         //    }
         // }

        $vtotalsales;
        $vppn;
        $vdaily;
        $vmonthly;
        $vtexpenses;
        $vtsalesminexpenses;
        $vtmiscexpenses;
        $valuetotalprofit;
        $vjpersentasekas;
        $vpersentaseover;

        if(count($cektotalprofit) == 0)
        {
           $flag  =0;
        }
        else
        {
            foreach ($cekpenjualansales as $valuepenjualansales) {
                $vtotalsales=$valuepenjualansales->total_sales;
            }

            foreach ($cekkppnexpenses as $valueppn) {
                $vppn=$valueppn->ppn_pemkot;
                $vdaily=$valueppn->total_daily_expense;
                $vmonthly=$valueppn->total_monthly_expense;
            }

            foreach ($cektotalexpenses as $valuetotalexpenses) {
                $vtexpenses=$valuetotalexpenses->total_expenses;
            }

            foreach ($cektotalsalesminexpenses as $valuetotalsalesminexpenses) {
                $vtsalesminexpenses=$valuetotalsalesminexpenses->total;
            }

            foreach ($ceklistmiscexpenses as $valuelistmiscexpenses) {
                $vpersentasekas=$valuelistmiscexpenses->kas_kecil;
                $vpersentaseover=$valuelistmiscexpenses->overhead;
            }

            foreach ($cektotalmiscexpenses as $valuetotalmiscexpenses) {
                $vtmiscexpenses=$valuetotalmiscexpenses->total_misc_expenses;
            }

            foreach ($cektotalprofit as $valuetotalprofit) {
                $valuetotalprofit=$valuetotalprofit->total_profit;
            }

            // foreach ($listjumlahprofitsharings as $valuejumlahprofitsharing) {

            // }

            if($totalsales != $vtotalsales || $totalppn != $vppn || $jumlahdaily != $vdaily || $jumlahmonthly != $vmonthly || $jumlahtotalexpenses != $vtexpenses || $totalsalesminexpenses != $vtsalesminexpenses || $jumlahtotalmisexpenses != $vtmiscexpenses || $jumlahtotalprofit != $valuetotalprofit || $jumlahpersentasekas != $vpersentasekas || $jumlahpersentaseover != $vpersentaseover )
            {
               $flag =2;
               
            }
            else
            {
               $flag = 1;
            }
        }


        if($flag == 2)
        {
            foreach ($cekpenjualansales as $valuepenjualansales) {
                $idtotalsales = $valuepenjualansales->id_totalsales;
            }

            foreach ($cekkppnexpenses as $valueppn) {
                $idlistexpenses = $valueppn->id_listexpenses;
            }

            foreach ($cektotalexpenses as $valuetotalexpenses) {
                $idtotalexpenses = $valuetotalexpenses->id_totalexpenses;
            }

            foreach ($cektotalsalesminexpenses as $valuetotalsalesminexpenses) {
                $idtotalsalesminexpenses = $valuetotalsalesminexpenses->id_totalsalesexpenses;
            }

            foreach ($ceklistmiscexpenses as $valuelistmiscexpenses) {
                $idlistmiscexpenses = $valuelistmiscexpenses->id_list_misc_expenses;
            }

            foreach ($cektotalmiscexpenses as $valuetotalmiscexpenses) {
                $idtotalmiscexpenses = $valuetotalmiscexpenses->id_total_misc_expenses;
            }

            foreach ($cektotalprofit as $valuetotalprofit) {
                $idtotalprofit = $valuetotalprofit->id_totalprofit;
            }

            // foreach ($listjumlahprofitsharings as $valuejumlahprofitsharing) {

            // }
        }
        //foreach
        



         return view('cashflow.list', compact('penjualansaless' , 'jenissaless' , 'periodess' , 'flag' , 'totalsales' , 'totalppn' , 'jumlahdaily' , 'totaldailys' , 'jumlahmonthly' , 'totalmonthlys' , 'jumlahtotalexpenses' , 'totalsalesminexpenses' , 'jumlahpersentaseover' , 'jumlahpersentasekas' , 'jumlahtotalmisexpenses' , 'jumlahtotalprofit' , 'idtotalsales' , 'idlistexpenses' , 'idtotalexpenses', 'idtotalsalesminexpenses', 'idlistmiscexpenses' , 'idtotalmiscexpenses' , 'idtotalprofit', 'listprofitsharings', 'arrayprofit' , 'persentaseprofitsharing' ));

         // $penjualansaless = DB::table('penjualansales')->where('id_periode','=', $idperiodelists)->get();
         // $totaldailys = DB::table('totaldailyexpenses')->where('id_periode','=', $idperiodelists)->get();
         // $totalmonthlys = DB::table('totalmonthlyexpenses')->where('id_periode','=', $idperiodelists)->get();
         // $periodess = DB::table('periodes')->where('id_periode','=', $idperiodelists)->get();

         // $totalsaless = DB::table('totalsales')->where('id_periode','=', $idperiodelists)->get();
         // $listexpensess = DB::table('listexpenses')->where('id_periode','=', $idperiodelists)->get();//ppn_pemkot
         // $totalexpensess = DB::table('totalexpenses')->where('id_periode','=', $idperiodelists)->get();
         // $totalsalesexpensess = DB::table('totalsalesexpenses')->where('id_periode','=', $idperiodelists)->get();
         // $listmiscexpensess = DB::table('listmiscexpenses')->where('id_periode','=', $idperiodelists)->get();
         // $totalmiscexpensess= DB::table('totalmiscexpenses')->where('id_periode','=', $idperiodelists)->get();
         // $totalprofitss= DB::table('totalprofits')->where('id_periode','=', $idperiodelists)->get();


         //return view('cashflow.list', compact('penjualansaless', 'totaldailys', 'totalmonthlys', 'periodess','totalsaless','listexpensess','totalexpensess','totalsalesexpensess','listmiscexpensess'));
    }   

    public function updatelistcashflow(Request $request, $totalsales, $totalppn, $totaldaily , $totalmonthly, $jumlahtotalexpenses, $totalsalesminexpenses, $jumlahpersentaseover, $jumlahpersentasekas, $jumlahtotalmisexpenses, $jumlahtotalprofit, $idtotalsales,$idlistexpenses, $idtotalexpenses, $idtotalsalesminexpenses, $idlistmiscexpenses, $idtotalmiscexpenses, $idtotalprofit)
    {
            $idperiode = $_SESSION["idperiodecashflow"];
            $iduser = $_SESSION["iduser"];

            $totalsaless = Totalsales::find($idtotalsales);
            $totalsaless->total_sales = $totalsales;
            $totalsaless->save();

            $listexpensess = Listexpenses::find($idlistexpenses);
            $listexpensess->ppn_pemkot = $totalppn;
            $listexpensess->total_monthly_expense = $totalmonthly;
            $listexpensess->total_daily_expense = $totaldaily;
            $listexpensess->save();

            $totalexpensess = Totalexpenses::find($idtotalexpenses);
            $totalexpensess->total_expenses = $jumlahtotalexpenses;
            $totalexpensess->save();

            $totalsalesexpensess =  Totalsalesexpenses::find($idtotalsalesminexpenses);
            $totalsalesexpensess->total = $totalsalesminexpenses;
            $totalsalesexpensess->save();

            $listmiscexpensess = Listmiscexpenses::find($idlistmiscexpenses);
            $listmiscexpensess->overhead = $jumlahpersentaseover;
            $listmiscexpensess->kas_kecil = $jumlahpersentasekas;
            $listmiscexpensess->save();

            $totalmiscexpensess = Totalmiscexpenses::find($idtotalmiscexpenses);
            $totalmiscexpensess->total_misc_expenses = $jumlahtotalmisexpenses;
            $totalmiscexpensess->save();

            $totalprofits = Totalprofit::find($idtotalprofit);
            $totalprofits->total_profit = $jumlahtotalprofit;
            $totalprofits->save();        

        return redirect('periode');

    }

    public function cetak_pdf(){
         $idperiodelists = $_SESSION["idperiodecashflow"];
         $flag=0;

         $penjualansaless = DB::table('penjualansales')->where('id_periode','=', $idperiodelists)->get();

         $totalsales=0;//pengecekan pertama
         foreach ($penjualansaless as $penjualansales) {
             $totalsales = round($totalsales +$penjualansales->jumlah, 2);
         }

         $totalppn= round(0.1 * $totalsales , 2);// cek dengan table listexpenses pada kolom ppn_pemkot  
         $jumlahdaily=0;
         $jumlahmonthly=0;

         $totaldailys = DB::table('totaldailyexpenses')->where('id_periode','=', $idperiodelists)->get();
         foreach ($totaldailys as $totaldaily) {
             $jumlahdaily = round($jumlahdaily + $totaldaily->total_daily_expense , 2);
         }

         $totalmonthlys = DB::table('totalmonthlyexpenses')->where('id_periode','=', $idperiodelists)->get();
         foreach ($totalmonthlys as $totalmonthly) {
             $jumlahmonthly = round($jumlahmonthly + $totalmonthly->total_monthly_expense , 2);
         }

            $jumlahtotalexpenses = round($totalppn + $jumlahdaily + $jumlahmonthly , 2);//ini di cek juga

            $totalsalesminexpenses = round($totalsales - $jumlahtotalexpenses , 2);///ini juga dicek juga

         $persentasekass = DB::table('persentasekaskecils')->where('id_periode','=', $idperiodelists)->get();
         $persenkc=0;
         foreach ($persentasekass as $persentasekas) {
             $persenkc = $persentasekas->persentase;
         }

         $persentaseoverheadss = DB::table('persentaseoverheads')->where('id_periode','=', $idperiodelists)->get();
         $perseno=0;
         foreach ($persentaseoverheadss as $persentaseoverheads) {
             $perseno = $persentaseoverheads->persentase;
         }

         $jumlahpersentasekas = round(($persenkc/100) * $totalsalesminexpenses , 2);
         $jumlahpersentaseover = round(($perseno/100) * $totalsalesminexpenses, 2);


            $jumlahtotalmisexpenses = round($jumlahpersentasekas + $jumlahpersentaseover , 2);

            $jumlahtotalprofit = round($totalsalesminexpenses - $jumlahtotalmisexpenses , 2);

         

         $periodess = DB::table('periodes')->where('id_periode','=', $idperiodelists)->get();

         // $jenissaless = DB::table('jenissales')->get();

         $jenissaless = DB::table('Jenissales')->where('id_periode','=', $_SESSION["idperiodecashflow"])->where('id_users','=',  $_SESSION["iduser"])->get();

         $listprofitsharings = DB::table('profitsharings')->where('id_periode','=', $idperiodelists)->get();
         $arrayprofit=[];
         $tampunghasil=0;
         $persentaseprofitsharing=0;
         foreach ($listprofitsharings as $value) {
             $tampunghasil = ($value->persentase/100) * $jumlahtotalprofit;
             $arrayprofit[$value->id_profitsharings] = $tampunghasil;
             $persentaseprofitsharing = $value->persentase;
         }
         // $listjumlahprofitsharings = DB::table('totalprofitsharings')->where('id_periode','=', $idperiodelists)->get();


         $cekpenjualansales = DB::table('totalsales')->where('id_periode','=', $idperiodelists)->get();
         $cekkppnexpenses = DB::table('listexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalexpenses = DB::table('totalexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalsalesminexpenses = DB::table('totalsalesexpenses')->where('id_periode','=', $idperiodelists)->get();
         $ceklistmiscexpenses = DB::table('listmiscexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalmiscexpenses = DB::table('totalmiscexpenses')->where('id_periode','=', $idperiodelists)->get();
         $cektotalprofit = DB::table('totalprofits')->where('id_periode','=', $idperiodelists)->get();

         $idtotalsales=0;
         $idlistexpenses=0;
         $idtotalexpenses=0;
         $idtotalsalesminexpenses=0;
         $idtotalmiscexpenses=0;
         $idtotalprofit=0;
         $idlistmiscexpenses=0;

         // foreach ($cekpenjualansales as $valuepenjualansales) {
         //    foreach ($cekkppnexpenses as $valueppn) {
         //        foreach ($cektotalexpenses as $valuetotalexpenses) {
         //            foreach ($cektotalsalesminexpenses as $valuetotalsalesminexpenses) {
         //                foreach ($ceklistmiscexpenses as $valuelistmiscexpenses) {
         //                    foreach ($cektotalmiscexpenses as $valuetotalmiscexpenses) {
         //                        foreach ($cektotalprofit as $valuetotalprofit) {
         //                            foreach ($listjumlahprofitsharings as $valuejumlahprofitsharing) {
                                        
         //                                 if(count($cektotalprofit) == 0)
         //                                 {
         //                                    $flag  =0;
         //                                 }
         //                                 else
         //                                 {
         //                                     if($totalsales != $valuepenjualansales->total_sales || $totalppn != $valueppn->ppn_pemkot || $jumlahdaily != $valueppn->total_daily_expense || $jumlahmonthly != $valueppn->total_monthly_expense || $jumlahtotalexpenses != $valuetotalexpenses->total_expenses || $totalsalesminexpenses != $valuetotalsalesminexpenses->total || $jumlahtotalmisexpenses != $valuetotalmiscexpenses->total_misc_expenses || $jumlahtotalprofit != $valuetotalprofit->total_profit || $jumlahpersentasekas != $valuelistmiscexpenses->kas_kecil || $jumlahpersentaseover != $valuelistmiscexpenses->overhead )
         //                                     {
         //                                        $flag =2;
         //                                        $idtotalsales = $valuepenjualansales->id_totalsales;
         //                                        $idlistexpenses = $valueppn->id_listexpenses;
         //                                        $idtotalexpenses = $valuetotalexpenses->id_totalexpenses;
         //                                        $idtotalsalesminexpenses = $valuetotalsalesminexpenses->id_totalsalesexpenses;
         //                                        $idlistmiscexpenses = $valuelistmiscexpenses->id_list_misc_expenses;
         //                                        $idtotalmiscexpenses = $valuetotalmiscexpenses->id_total_misc_expenses;
         //                                        $idtotalprofit = $valuetotalprofit->id_totalprofit;
         //                                     }
         //                                     else
         //                                     {
         //                                        $flag = 1;
         //                                     }

         //                                }
         //                            }                                  

         //                        }
         //                    }
         //                }
         //            }
         //        }
         //    }
         // }

        $vtotalsales;
        $vppn;
        $vdaily;
        $vmonthly;
        $vtexpenses;
        $vtsalesminexpenses;
        $vtmiscexpenses;
        $valuetotalprofit;
        $vjpersentasekas;
        $vpersentaseover;

        if(count($cektotalprofit) == 0)
        {
           $flag  =0;
        }
        else
        {
            foreach ($cekpenjualansales as $valuepenjualansales) {
                $vtotalsales=$valuepenjualansales->total_sales;
            }

            foreach ($cekkppnexpenses as $valueppn) {
                $vppn=$valueppn->ppn_pemkot;
                $vdaily=$valueppn->total_daily_expense;
                $vmonthly=$valueppn->total_monthly_expense;
            }

            foreach ($cektotalexpenses as $valuetotalexpenses) {
                $vtexpenses=$valuetotalexpenses->total_expenses;
            }

            foreach ($cektotalsalesminexpenses as $valuetotalsalesminexpenses) {
                $vtsalesminexpenses=$valuetotalsalesminexpenses->total;
            }

            foreach ($ceklistmiscexpenses as $valuelistmiscexpenses) {
                $vpersentasekas=$valuelistmiscexpenses->kas_kecil;
                $vpersentaseover=$valuelistmiscexpenses->overhead;
            }

            foreach ($cektotalmiscexpenses as $valuetotalmiscexpenses) {
                $vtmiscexpenses=$valuetotalmiscexpenses->total_misc_expenses;
            }

            foreach ($cektotalprofit as $valuetotalprofit) {
                $valuetotalprofit=$valuetotalprofit->total_profit;
            }

            // foreach ($listjumlahprofitsharings as $valuejumlahprofitsharing) {

            // }

            if($totalsales != $vtotalsales || $totalppn != $vppn || $jumlahdaily != $vdaily || $jumlahmonthly != $vmonthly || $jumlahtotalexpenses != $vtexpenses || $totalsalesminexpenses != $vtsalesminexpenses || $jumlahtotalmisexpenses != $vtmiscexpenses || $jumlahtotalprofit != $valuetotalprofit || $jumlahpersentasekas != $vpersentasekas || $jumlahpersentaseover != $vpersentaseover )
            {
               $flag =2;
               
            }
            else
            {
               $flag = 1;
            }
        }


        if($flag == 2)
        {
            foreach ($cekpenjualansales as $valuepenjualansales) {
                $idtotalsales = $valuepenjualansales->id_totalsales;
            }

            foreach ($cekkppnexpenses as $valueppn) {
                $idlistexpenses = $valueppn->id_listexpenses;
            }

            foreach ($cektotalexpenses as $valuetotalexpenses) {
                $idtotalexpenses = $valuetotalexpenses->id_totalexpenses;
            }

            foreach ($cektotalsalesminexpenses as $valuetotalsalesminexpenses) {
                $idtotalsalesminexpenses = $valuetotalsalesminexpenses->id_totalsalesexpenses;
            }

            foreach ($ceklistmiscexpenses as $valuelistmiscexpenses) {
                $idlistmiscexpenses = $valuelistmiscexpenses->id_list_misc_expenses;
            }

            foreach ($cektotalmiscexpenses as $valuetotalmiscexpenses) {
                $idtotalmiscexpenses = $valuetotalmiscexpenses->id_total_misc_expenses;
            }

            foreach ($cektotalprofit as $valuetotalprofit) {
                $idtotalprofit = $valuetotalprofit->id_totalprofit;
            }

            // foreach ($listjumlahprofitsharings as $valuejumlahprofitsharing) {

            // }
        }

        $pdf = PDF::loadView('cashflow.cetak', compact('penjualansaless' , 'jenissaless' , 'periodess' , 'flag' , 'totalsales' , 'totalppn' , 'jumlahdaily' , 'totaldailys' , 'jumlahmonthly' , 'totalmonthlys' , 'jumlahtotalexpenses' , 'totalsalesminexpenses' , 'jumlahpersentaseover' , 'jumlahpersentasekas' , 'jumlahtotalmisexpenses' , 'jumlahtotalprofit' , 'idtotalsales' , 'idlistexpenses' , 'idtotalexpenses', 'idtotalsalesminexpenses', 'idlistmiscexpenses' , 'idtotalmiscexpenses' , 'idtotalprofit', 'listprofitsharings', 'arrayprofit' , 'persentaseprofitsharing'))->setPaper('a4', 'landscape');


    return $pdf->stream();

    }
}
