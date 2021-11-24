<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dailyexpenses;
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class DailyExpensesController extends Controller
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
            'tanggaldaily' => 'required',
            'deskripsidaily' => 'required',
            'nilaikeluar' => 'required'
        ],
        [
            'tanggaldaily.required' => 'Field tanggal tidak boleh dikosongi',
            'deskripsidaily.required' => 'Field deskripsi tidak boleh dikosongi',
            'nilaikeluar.required' => 'Field nilai keluar tidak boleh dikosongi'
        ]);

        $idperiode = $_SESSION["idperiode"];
        $daily = new Dailyexpenses();
        $daily->id_periode =$_SESSION["idperiode"];
        $daily->tanggal = $request->get('tanggaldaily');
        $daily->deskripsi = $request->get('deskripsidaily');
        $daily->nilai_keluar = $request->get('nilaikeluar');
        $daily->balance = $request->get('balance');
        $daily->save();
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
}
