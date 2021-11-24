<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profitsharing;
use DB;

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class ProfitSharingController extends Controller
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
            'pihak' => 'required',
            'persentase' => 'required'
        ],
        [
            'pihak.required' => 'Field pihak tidak boleh dikosongi',
            'persentase.required' => 'Field persentase tidak boleh dikosongi'
        ]);
        
        $profitsharings = new Profitsharing();
        $profitsharings->id_periode = $_SESSION["idperiode"];
        $profitsharings->id_users = $_SESSION["iduser"];
        $profitsharings->pihak = $request-> get('pihak');
        $profitsharings->persentase = $request-> get('persentase');
        $profitsharings->save();
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
