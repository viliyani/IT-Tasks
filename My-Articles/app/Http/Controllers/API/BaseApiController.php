<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    // Response Content
    protected $apiResponseContent = [
        'success' => true,
        'data' => [],
        'message' => ''
    ];

    // Response Status Code
    protected $apiResponseStatusCode = 200;

    // Send Response
    public function sendResponse() {
        return response()->json($this->apiResponseContent, $this->apiResponseStatusCode);
    }
}
