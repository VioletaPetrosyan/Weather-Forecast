<?php


namespace App\Http\Controllers;


use App\Services\ForecastService;
use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function forecastShow()
    {
        return view('forecast.show');
    }

    public function forecastGet(Request $request, ForecastService $forecastService)
    {
        $request->validate([
            'city' => ['required'],
        ]);

        return $forecastService->getForecastForCity($request->city);

    }
}
