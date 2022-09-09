<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use App\Models\Batiment;
use App\Models\Calculo2;
use App\Models\Renovation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use stdClass;

class ArrondissementController extends Controller
{
    public function index()
    {
        $reno1 = Renovation::where([
            ['district', '!=', 'NULL']
        ])
            ->selectRaw('arrondissement_id, year, count(*) as total')
            ->groupBy('arrondissement_id', 'year')
            ->get();

        $array = [];

        $arrondissements = Arrondissement::all();
//
        foreach ($arrondissements as $item){
            $item->geojson = json_decode($item->geojson);
        }

        foreach ($reno1 as $item){
            $array[$item->arrondissement_id][$item->year] = $item->total;
        }

        foreach ($arrondissements as $arr){
            $arr->total = $array[$arr->id];
        }

        return response()->json($arrondissements);
    }
    public function fetchData()
    {
        $jsonTemplateStart = '{"type":"Feature","properties":"{}","geometry":';
        $jsonTemplateEnd = '}';
        $request = Http::get('https://www.odwb.be/api/records/1.0/search/?dataset=arrondissements-belges0&q=&rows=43')->json();
//        dd($request);
        $array = [];
        foreach ($request['records'] as $value) {
//            dd(json_encode($value['fields']['geo_shape']));
            $array[] = [
                'lang' => $value['fields']['lang'],
                'latitude' => $value['fields']['geo_point_2d'][0],
                'longitude' => $value['fields']['geo_point_2d'][1],
                'ins' => $value['fields']['ins'],
                'entite' => $value['fields']['name1'],
                'shapeLength' => $value['fields']['shape_leng'],
                'shapeArea' => $value['fields']['shape_area'],
                'geojson' => $jsonTemplateStart . json_encode($value['fields']['geo_shape']) . $jsonTemplateEnd,
            ];

        }

        foreach ($array as $data)
        {
            if ($data['lang'] === 'FF' || $data['lang'] === 'Fn') {
                if(Arrondissement::where('ins', $data['ins'])->exists())
                {
                    $arrondissement = Arrondissement::where('ins', $data['ins'])->first();
                    $arrondissement->update($data);
                }
                else
                {
                    Arrondissement::create($data);
                }
            }
        }
    }

    public function getRenoByDistrict($id)
    {
        $reno1 = Renovation::where([
            ['arrondissement_id', $id],
            ['district', '!=', 'NULL']
        ])
            ->selectRaw('year, count(*) as total, sum(cost) as totalCost, sum(estimated_quantity) as totalQuantity, sum(estimate_prime) as totalPrime')
            ->groupBy('year')
            ->get();


        $reno = Renovation::where([
            ['renovations.arrondissement_id', $id],
            ['renovations.district', '!=', 'NULL']
        ])->join('batiments', 'renovations.arrondissement_id', '=', 'batiments.arrondissement_id')
            ->selectRaw('*')
            ->groupBy('batiments.year')
            ->get();

        foreach ($reno as $item){
            foreach ($reno1 as $item1){
                if($item->year == $item1->year){
                    $item->total = $item1->total;
                    $item->totalCost = $item1->totalCost;
                    $item->totalQuantity = $item1->totalQuantity;
                    $item->totalPrime = $item1->totalPrime;
                }
            }
        }

        return response()->json($reno);

    }
}
