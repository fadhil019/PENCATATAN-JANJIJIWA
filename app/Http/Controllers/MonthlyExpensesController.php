<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monthlyexpense;
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

class MonthlyExpensesController extends Controller
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
            'deskripsimonthly' => 'required',
            'tanggal' => 'required',
            'hargasatuan' => 'required',
            'total' => 'required'
        ],
        [
            'deskripsimonthly.required' => 'Field deskripsi tidak boleh dikosongi',
            'tanggal.required' => 'Field tanggal tidak boleh dikosongi',
            'hargasatuan.required' => 'Field harga satuan tidak boleh dikosongi',
            'total.required' => 'Field nilai total tidak boleh dikosongi'
        ]);

        $monthly = new Monthlyexpense();
        $monthly->id_periode =$_SESSION["idperiode"];
        $monthly->deskripsi =$request->get('deskripsimonthly');
        $monthly->tanggal =$request->get('tanggal');
        $monthly->harga_satuan =$request->get('hargasatuan');
        $monthly->total =$request->get('total');
        $monthly->subtotal =$request->get('subtotal');
        $monthly->save();
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
