<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TallyController extends Controller
{
    private $tallyUrl = 'http://localhost:9000'; // Update with your Tally URL and port if different

    public function sendRequestToTally($xmlPayload)
    {
        $client = new Client();
        $response = $client->post($this->tallyUrl, [
            'body' => $xmlPayload,
            'headers' => [
                'Content-Type' => 'application/xml',
            ],
        ]);

        return $response->getBody()->getContents();
    }

    public function index()
    {
        $xml = '<ENVELOPE>
                    <HEADER>
                        <TALLYREQUEST>Export Data</TALLYREQUEST>
                    </HEADER>
                    <BODY>
                        <EXPORTDATA>
                            <REQUESTDESC>
                                <REPORTNAME>List of Accounts</REPORTNAME>
                            </REQUESTDESC>
                        </EXPORTDATA>
                    </BODY>
                </ENVELOPE>';

        $response = $this->sendRequestToTally($xml);

        // Handle or process the response as needed
        return response()->json($response);
    }
}
