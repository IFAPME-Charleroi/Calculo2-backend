<?php

namespace App\Http\Controllers;

use App\Models\Batiment;
use Illuminate\Http\Request;

class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $year = 2016;

        $array = [
            [49579, 49814, 50045, 50381, 50624, 50890, 50890],
            [42481, 42785, 43119, 43545, 43909, 44247, 44247],
            [21069, 21215, 21378, 21492, 21630, 21801, 21801],
            [20978,	21108,	21264,	21414,	21550,	21688, 21688],
            [148059,	148445,	148896,	149268,	149626,	150074, 150074],
            [50497,	50800,	51068,	51372,	51661,	51938, 51938],
            [98798,	99482,	100230,	101005,	101643,	102219, 102219],
            [132624,133424,	134357,	135140,	136175,	136950, 136950],
            [43470,	43808,	44277,	44608,	44932,	45320, 45320],
            [37992,	38215,	38531,	38804,	39038,	39254, 39254],
            [22928,	23142,	23372,	23583,	23781,	23961, 23961],
            [27193,	27376,	27584,	27726,	27946,	28135, 28135],
            [25158,	25352,	25579,	25820,	26068,	26330, 26330],
            [37413,	37671,	37910,	38120,	38317,	38495, 38495],
            [104939,105565,	106307,	107168,	107910,	108707, 108707],
            [28854,	29033,	29364,	29643,	29939,	30197, 30197],
            [213057,	213787,	214674,	215596,	216429,	217359, 217359],
            [37401,	37578,	37752,	38006,	38190,	38390, 38390],
            [103065,	103611,	104109,	104570,	104973,	105356, 105356],
            [18608,	18775,	18992,	19191,	19395,	19581, 19581],
        ];

//        dd($array);

        for ($i=0; $i < 20; $i++) {
        for ($j=0; $j < 7; $j++) {

            $batiment = new Batiment();
            $batiment->arrondissement_id = $i +1;
            $batiment->year = $year;
            $batiment->buildings = $array[$i][$j];
            $batiment->save();

            $year = $year + 1;
        }
        $year = 2016;
        }
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
     * @param  \App\Models\Batiment  $batiment
     * @return \Illuminate\Http\Response
     */
    public function show(Batiment $batiment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Batiment  $batiment
     * @return \Illuminate\Http\Response
     */
    public function edit(Batiment $batiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Batiment  $batiment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Batiment $batiment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Batiment  $batiment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Batiment $batiment)
    {
        //
    }
    public function getBuildingByDistrict($id)
    {
        $bati = Batiment::where([
            ['arrondissement_id', $id]])
            ->selectRaw('*')
            ->groupBy('year')
            ->get();

        return response()->json($bati);

    }
}
