<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class EmploymentController extends Controller
{
    /**
     * Index method
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $client = new Client();
        $years = ["2022", "2021", "2020", "2019", "2018", "2017", "2016",
            "2015", "2014", "2013", "2012", "2011", "2010", "2009", "2008",
            "2007", "2006", "2005", "2004", "2003", "2002", "2001", "2000",
            "1999", "1998", "1997", "1996", "1995", "1994", "1993", "1992",
            "1991", "1990", "1989", "1988", "1987"];

        $employmentData = [];

        try {
            foreach ($years as $year) {
                $query = [
                    "query" => [
                        [
                            "code" => "Alue", // Region
                            "selection" => [
                                "filter" => "item",
                                "values" => ["SSS"] // All of Finland
                            ]
                        ],
                        [
                            "code" => "Pääasiallinen toiminta", // Main activity
                            "selection" => [
                                "filter" => "item",
                                "values" => ["11"] // Employed population
                            ]
                        ],
                        [
                            "code" => "Sukupuoli", // Gender
                            "selection" => [
                                "filter" => "item",
                                "values" => ["SSS", "1", "2"] // Both genders
                            ]
                        ],
                        [
                            "code" => "Ikä", // Age
                            "selection" => [
                                "filter" => "item",
                                "values" => ["SSS", "0-17", "18-64", "65-"] // All ages
                            ]
                        ],
                        [
                            "code" => "Vuosi", // Year
                            "selection" => [
                                "filter" => "item",
                                "values" => [$year] // Loop through the years
                            ]
                        ]
                    ],
                    "response" => [
                        "format" => "json-stat2" // Specify the response format
                    ]
                ];

                // Make a POST request
                $response = $client->request(
                    'POST', 'https://pxdata.stat.fi:443/PxWeb/api/v1/en/StatFin/tyokay/statfin_tyokay_pxt_115b.px',
                    ['json' => $query]
                );

                // Decode the response
                $data = json_decode($response->getBody()->getContents(), true);

                // Store the response data
                $employmentData[$year] = $data['value'][0] ?? null; // Assuming the 'value' field contains relevant data
            }

            // Pass the data to the view
            return view('employment', ['employmentData' => $employmentData]);

        } catch (\Exception $e) {
            // Return error view in case of failure
            return view('employment', ['employmentData' => null, 'error' => $e->getMessage()]);
        }
    }
}
