<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CausecheckController extends Controller
{
    public function fetchData()
    {
        $key = 'c435a90d306a4ab88ea076038a838d0e';
        $response = Http::get("https://newsapi.org/v2/top-headlines?country=us&category=business&apiKey=$key");
        $data = $response->json();

        return dd($data);
        //view('index', ['data' => $data->articles ?? null]);
    }
}

