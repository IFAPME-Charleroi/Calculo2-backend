<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use App\Models\Renovation;
use App\Http\Requests\StoreRenovationRequest;
use App\Http\Requests\UpdateRenovationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;


class RenovationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $parameter1 = 'Economies';
        $parameter2 = 2016;

        $response = DB::select("call GetRenoPurposeYear(?, ?)", [

            $parameter1,
            $parameter2,
        ]);

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreRenovationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRenovationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Renovation $renovation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Renovation $renovation)
    {

        $response = Renovation::find($renovation->id);
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Renovation $renovation
     * @return \Illuminate\Http\Response
     */
    public function edit(Renovation $renovation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateRenovationRequest $request
     * @param \App\Models\Renovation $renovation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRenovationRequest $request, Renovation $renovation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Renovation $renovation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Renovation $renovation)
    {
        //
    }

    public function calculDeperdition($array)
    {
        $parameters = explode(',', $array);

//        dd($parameters);

        $parameter1 = $parameters[0];
        $parameter2 = $parameters[1];
        $parameter3 = $parameters[2];
        $parameter4 = $parameters[3];

        $response = DB::select("call DepStart(?, ?, ?, ?)", [

            $parameter1,
            $parameter2,
            $parameter3,
            $parameter4,
        ]);
        return Response()->json($response);

    }

    public function fetchData()
    {
        $requestApi = Http::get('https://openapi.swcs.be/api/Renovations?Take=2000&Page=1')->json();

        $pages = $requestApi['totalPage'] + 1;

        $array = [];

        ini_set('memory_limit', '512M');
        set_time_limit(0);
        for ($i = 1; $i < $pages; $i++) {
            $url = Http::get('https://openapi.swcs.be/api/Renovations?Take=2000&Page=' . $i)->json();

            array_push($array, $url['data']);
            time_nanosleep(0, 200000000);

        }

//        SELECT * from renovations
//        WHERE purpose LIKE '%Economies%'
//        AND label LIKE '%isolation%toiture%'
//        AND estimated_quantity > 0;

        $array2 = [];

        foreach ($array as $value) {
            foreach ($value as $value2) {
//                if (($value2['purpose'] == ('Economies' || 'Etanchéité')) && Str::contains($value2['label'], ['toiture', 'Toiture'] ) && ($value2['estimatedQuantity'] > 0)) {
                if (($value2['purpose'] == 'Economies') && Str::containsAll($value2['label'], ['oiture', 'solation']) && ($value2['estimatedQuantity'] > 0)) {
                    $array2[] = $value2;
                }
            }
        }
        $arrondissement = Arrondissement::all();

        foreach ($array2 as $data) {

            $arrValue = 0;

            foreach ($arrondissement as $arr)
            {

                if ($arr->entite == $data['district'])
                {
                    $arrValue= $arr->id;
                }
                elseif ($data['district'] == null)
                {
                    $arrValue = 0;
                }
            }

            Renovation::updateOrCreate(
                ['reference' => $data['@id']],
                ['reference' => $data['@id'],
                'label' => $data['label'],
                'district' => $data['district'],
                'status' => $data['status'],
                'year' => $data['year'],
                'month' => $data['month'],
                'purpose' => $data['purpose'],
                'cost' => $data['cost'],
                'estimated_quantity' => $data['estimatedQuantity'],
                'unit_measure_quantity' => $data['unitMeasureQuantity'],
                'is_prime_eligible' => $data['isPrimeEligible'],
                'estimate_prime' => $data['estimatePrime'],
                'agencyName' => $data['agencyName'],
                'agencyAddress' => $data['agencyAddress'],
                'agencyPostalCode' => $data['agencyPostalCode'],
                'arrondissement_id' => $arrValue,
            ]);
        }
    }
}
