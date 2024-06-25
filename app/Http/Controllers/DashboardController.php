<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show($id)
    {
        $client = new Client();

        $kpi1Response = $client->get("https://dashboardiafisioprod1.onrender.com//kpi1/{$id}");
        $kpi2Response = $client->get("https://dashboardiafisioprod1.onrender.com//kpi2/{$id}");

        $kpi1Image = base64_encode($kpi1Response->getBody()->getContents());
        $kpi2Image = base64_encode($kpi2Response->getBody()->getContents());

        return view('fisioterapeuta.dashboard', [
            'kpi1Image' => $kpi1Image,
            'kpi2Image' => $kpi2Image,
        ]);
    }
}
