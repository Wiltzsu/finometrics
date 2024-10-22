<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client = new Client();

        // Prepare the JSON query for the POST request
        $query = [
            "query" => [
                [
                    "code" => "Tiedot",
                    "selection" => [
                        "filter" => "item",
                        "values" => ["vaesto"] // Population
                    ]
                ],
                [
                    "code" => "Vuosi",
                    "selection" => [
                        "filter" => "item",
                        "values" => ["2023"] // Year
                    ]
                ]
            ],
            "response" => [
                "format" => "json-stat2" // Specify the response format
            ]
        ];

        try {
            // Make a POST request with the JSON body
            $response = $client->request(
                'POST', 'https://pxdata.stat.fi:443/PxWeb/api/v1/en/StatFin/vaerak/statfin_vaerak_pxt_11ra.px', [
                'json' => $query
                ]
            );

            $data = json_decode($response->getBody()->getContents(), true);

            return view('home', ['data' => $data]);
        } catch (\Exception $e) {
            return view('home', ['data' => null]);
        }
    }
}
