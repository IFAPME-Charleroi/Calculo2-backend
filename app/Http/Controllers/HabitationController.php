<?php

namespace App\Http\Controllers;

use App\Models\Habitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HabitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestApi = Http::get('https://openapi.swcs.be/api/Habitations?Take=2000&Page=1')->json();


        $pages = $requestApi['totalPage'] +1 ;

        $array=[];
        $array2=[];
        ini_set('memory_limit', -1);
        set_time_limit(0);
        for ($i = 1; $i < $pages; $i++) {
            $url = Http::get('https://openapi.swcs.be/api/Habitations?Take=2000&Page='.$i)->json();

            array_push($array,$url['data']);
            time_nanosleep(0, 200000000);

        }

        foreach ($array as $value) {
            foreach ($value as $value2) {

//                array_push($array2,$value2);

                $habitation = new Habitation();
                $habitation->reference = $value2['@id'];
                $habitation->type = $value2['type'];
                $habitation->market_value = $value2['marketValue'];
                $habitation->province = $value2['province'];
                $habitation->construct_year = $value2['constructYear'];
                $habitation->environment = $value2['environment'];
                $habitation->transport = $value2['transport'];
                $habitation->zone = $value2['zone'];
                $habitation->save();

            }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\Models\Habitation  $habitation
     * @return \Illuminate\Http\Response
     */
    public function show(Habitation $habitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Habitation  $habitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitation $habitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habitation  $habitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitation $habitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habitation  $habitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitation $habitation)
    {
        //
    }
}
