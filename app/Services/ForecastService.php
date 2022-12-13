<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class ForecastService
{

    const API_URL = 'http://api.weatherapi.com/v1/current.json';

    public function getForecastForCity(string $cityName)
    {
        //http://api.weatherapi.com/v1/current.json?key=25716ac6932942da8c894825221312&q=Phuket&aqi=no

        $client = new Client();

        $key = config('app.forecast_api_key');
        try {
            $data = $client->get(static::API_URL . "?key={$key}&q={$cityName}&aqi=no")->getBody()->getContents();
            $data = json_decode($data, true);
            return response()->json([
                'success' => 1,
                'temp_c' => $data['current']['temp_c'] ?? null,
                'temp_f' => $data['current']['temp_f'] ?? null,
                'icon' => $data['current']['condition']['icon'],
                'text' => $data['current']['condition']['text'],
            ]);

        } catch (ClientException $exception) {
            $result = json_decode($exception->getResponse()->getBody()->getContents(), true);

            return response()->json([
                'success' => 0,
                'error' => $result['error']['message']
            ]);
        } catch (\Throwable $exception) {
            return response()->json([
                'success' => 0,
                'error' => 'Something went wrong!'
            ]);
        }

    }

}
