<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CommuneController extends Controller
{
    public function index()
    {

    $requestApi = Http::get('https://public.opendatasoft.com/api/records/1.0/search/?dataset=communes-belges-2019')->json();

    $response = json_decode($requestApi);
    dd($response);
    
    }
}
