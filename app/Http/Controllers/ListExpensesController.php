<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use App\Dailyexpenses;
use App\Monthlyexpense;
use App\Listsale;
use App\Profitsharing;
use DB;

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class ListExpensesController extends Controller
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
        $daily = Dailyexpenses::find($id);
        $daily->delete();

        return redirect('periode');
    }

    public function hapusmonthlylist($id)
    {
        $monthly = Monthlyexpense::find($id);
        $monthly->delete();

        return redirect('periode');
    }

     public function hapussaleslist($id)
    {
        $sales = Listsale::find($id);
        $sales->delete();

        return redirect('periode');
    }

    public function hapusprofitsharing($id)
    {
        $profit = Profitsharing::find($id);
        $profit->delete();

        return redirect('periode');
    }

    public function halamaneditlistprofitsharing($id)
    {
        $listprofitsharing =  DB::table('profitsharings')->where('id_profitsharings','=', $id )->get();
        $idprofitsharing = $id;
        $pihak = "";
        $persentase = 0;
        foreach ( $listprofitsharing as $value) {
            $pihak = $value->pihak;
            $persentase = $value->persentase;
        }

       
        return view('list.editlistprofitsharing', compact('pihak' , 'persentase' , 'idprofitsharing'));
    }

    public function halamaneditlistsales($id)
    {
        $listsaless =  DB::table('listsales')->where('id_listsales','=', $id )->get();
        $idlistsales = $id;
        $idjenissaless=0;
        $tanggallist='';
        $totalawal=0;
        foreach ($listsaless as $value) {
            $totalawal = $value->total;
            $idjenissaless= $value->id_jenissales;
            $tanggallist = $value->tanggal;
        }

        $datajenissaless = DB::table('jenissales')->where('id_jenissales','=', $idjenissaless )->get();
        $jenissaless = '';
        foreach ($datajenissaless as $value) {
            $jenissaless = $value->nama;
        }

        $flagsales = 0;
        return view('list.editlistsales', compact('totalawal', 'jenissaless', 'tanggallist', 'idlistsales', 'flagsales', 'idjenissaless'));
    }

    public function halamaneditlistdaily($id)
    {
        $listdaily =  DB::table('dailyexpenses')->where('id_dailyexpense','=', $id )->get();
        $idlistdaily = $id;
        $tanggaldaily='';
        $nilaimasukdaily=0;
        $deskripsimasukdaily='';
        $deskripsi='';
        $nilaikeluardaily=0;
        $balancedaily=0;
        foreach ($listdaily as $value) {
            $tanggaldaily = $value->tanggal;
            //$nilaimasukdaily= $value->nilai_masuk;
            //$deskripsimasukdaily = $value->deskripsi_masuk;
            $deskripsi = $value->deskripsi;
            $nilaikeluardaily = $value->nilai_keluar;
            $balancedaily = $value->balance;
        }

        return view('list.editlistdaily', compact('tanggaldaily', 'nilaimasukdaily', 'deskripsimasukdaily', 'deskripsi', 'nilaikeluardaily', 'balancedaily', 'idlistdaily'));
    }

    public function halamaneditlistmonthly($id)
    {
        $listmonthly =  DB::table('monthlyexpenses')->where('id_monthlyexpense','=', $id )->get();
        $idlistmonthly = $id;
        $deskripsi='';
        $tanggalmonthly='';
        $hargasatuan=0;
        $total=0;
        $subtotal=0;
        foreach ($listmonthly as $value) {
            $deskripsi= $value->deskripsi;
            $tanggalmonthly = $value->tanggal;
            $hargasatuan = $value->harga_satuan;
            $total = $value->total;
            $subtotal = $value->subtotal;
        }

        return view('list.editlistmonthly', compact('deskripsi', 'tanggalmonthly', 'hargasatuan', 'total', 'subtotal', 'idlistmonthly'));
    }

    public function editlistprofitsharing(Request $request, $id)
    {
        $profitsharingss = Profitsharing::find($id);
        $profitsharingss->pihak = $request->get('pihak');
        $profitsharingss->persentase = $request->get('persentase');
        $profitsharingss->save();

        return redirect('tohalamanlistprofitsharing');
    }

    public function editlistsales(Request $request, $idlistsales)
    {
        $listsaless = Listsale::find($idlistsales);
        $listsaless->tanggal = $request->get('tanggal');
        $listsaless->total = $request->get('total');
        $listsaless->komisi = $request->get('komisi');
        $listsaless->akhir = $request->get('totalakhir');
        $listsaless->save();

        return redirect('tolistjenissales');
    }
     public function editlistsaleshitung(Request $request, $idjenissaless, $idlistsales2)
    {
        $jenissaless2 = '';
        $persentases =0;
        $idjenissales2=$idjenissaless;
        $listsaless =  DB::table('jenissales')->where('id_jenissales','=', $idjenissales2 )->get();
        foreach ($listsaless as $value) {
            $persentases = $value->persentase;
            $jenissaless2 = $value->nama;
        }

        $totalhargaawal = $request->get('total');
        $tanggallist2 = $request->get('tanggal');
        $nilaipersentase = $persentases/100;
        $komisisales =  $totalhargaawal * $nilaipersentase;
        $totalakhir = $totalhargaawal - $komisisales;
        $flagsales =1;

        return view('list.editlistsales', compact('totalhargaawal', 'jenissaless2', 'tanggallist2', 'idlistsales2', 'flagsales', 'komisisales', 'totalakhir'));
    }

    public function editlistdaily(Request $request, $idlistdaily)
    {
        $listdailys = Dailyexpenses::find($idlistdaily);
        $listdailys->tanggal = $request->get('tanggal');
        // $listdailys->nilai_masuk = $request->get('nilaimasuk');
        // $listdailys->deskripsi_masuk = $request->get('deskripsimasuk');
        $listdailys->deskripsi = $request->get('deskripsi');
        $listdailys->nilai_keluar = $request->get('nilaikeluar');
        $listdailys->balance = $request->get('balance');
        $listdailys->save();

        return redirect('tolistdaily');
    }

    public function editlistmonthly(Request $request, $idlistmonthly)
    {
        $listmonthlys = Monthlyexpense::find($idlistmonthly);
        $listmonthlys->deskripsi = $request->get('deskripsi');
        $listmonthlys->tanggal = $request->get('tanggal');
        $listmonthlys->harga_satuan = $request->get('hargasatuan');
        $listmonthlys->total = $request->get('total');
        $listmonthlys->subtotal = $request->get('subtotal');
        $listmonthlys->save();

        return redirect('tolistmonthly');
    }
}
