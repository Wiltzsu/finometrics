<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

use Illuminate\Http\Request;

class PopulationStatisticsController extends Controller
{
    /**
     * Index method.
     *
     * @return string
     */
    public function index()
    {
        $client = new Client();
        $years = [
            "2023", "2022", "2021", "2020", "2019", "2018", "2017", "2016",
            "2015", "2014", "2013", "2012", "2011", "2010", "2009", "2008",
            "2007", "2006", "2005", "2004", "2003", "2002", "2001", "2000",
            "1999", "1998", "1997", "1996", "1995", "1994", "1993", "1992",
            "1991", "1990"
        ];
        $populationData = [];

        try {
            // loop through the years and fetch data for each year
            foreach ($years as $year) {
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
                                "values" => [$year] // Year
                            ]
                        ]
                    ],
                    "response" => [
                        "format" => "json-stat2" // Specify the response format
                    ]
                ];

                // make a post request for each year
                $response = $client->request(
                    'POST', 'https://pxdata.stat.fi:443/PxWeb/api/v1/en/StatFin/vaerak/statfin_vaerak_pxt_11ra.px',
                    ['json' => $query]
                );

                $data = json_decode($response->getBody()->getContents(), true);
                $populationData[$year] = $data['value'][0];
                // echo '<pre>';
                // print_r($populationData[$year]);
                // echo '</pre>';
            }
            // pass data to the view
            return view('population', ['populationData' => $populationData]);

        } catch(\Exception $e) {
            // in case of an error pass null to the view
            return view('population', ['populationData' => null, 'error' => $e->getMessage()]); // phpcs:ignore
        }
    }

    public function populationByAgeGender()
    {
        $client = new Client();
        $ages = [
            "SSS", "0-4", "5-9", "10-14", "15-19", "20-24", "25-29", "30-34",
            "35-39", "40-44", "45-49", "50-54", "55-59", "60-64", "65-69",
            "70-74", "75-79", "80-84", "85-"
        ];

        try {
            foreach ($ages as $age) {
                $query = [
                    "query" => [
                        [
                            "code" => "Vuosi",
                            "selection" => [
                                "filter" => "item",
                                "values" => "2023"
                            ]
                        ],
                        [
                            "code" => "Sukupuoli",
                            "selection" => [
                                "filter" => "item",
                                "values" => [
                                    "SSS",
                                    "1",
                                    "2"
                                ]
                            ]
                        ],
                        [
                            "code" => "Ikä",
                            "selection" => [
                                "filter" => "item",
                                "values" => [$age]
                            ]
                        ]
                    ],
                    "response" => [
                        "format" => "json-stat2"
                    ]
                ];
                var_dump($query);

                $response = $client->request(
                    'POST', 'https://pxdata.stat.fi:443/PxWeb/api/v1/en/StatFin/vaerak/statfin_vaerak_pxt_11rc.px',
                    ['json' => $query]
                );
                var_dump($response);
                $data = json_decode($response->getBody()->getContents(), true);
                $ageGenderData[$age] = $data['value'][0];
                // echo '<pre>';
                // print_r($ageGenderData[$age]);
                // echo '</pre>';
            }
            // pass data to the view
            return view('population', ['ageGenderData' => $ageGenderData]);

        } catch(\Exception $e) {
            // in case of an error pass null to the view
            return view('population', ['ageGenderData' => null, 'error' => $e->getMessage()]); // phpcs:ignore
        }
    }
}
