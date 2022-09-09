<?php

namespace App\Http\Controllers;

use App\Models\Calculo2;
use Illuminate\Http\Request;

class Calculo2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $result = Calculo2::selectRaw('year, sum(kwh_eco) as kwh, sum(co2_eco) as co2')
            ->groupBy('year')
            ->get();
        return response()->json($result);
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
     * @param  \App\Models\Calculo2  $calculo2
     * @return \Illuminate\Http\Response
     */
    public function show(Calculo2 $calculo2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calculo2  $calculo2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calculo2 $calculo2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calculo2  $calculo2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calculo2 $calculo2)
    {
        //
    }
}
