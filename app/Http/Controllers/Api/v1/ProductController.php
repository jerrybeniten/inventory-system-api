<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function store(Request $request) {
        return response()->json([
            'message' => 'Merchant shown successfully',
            'merchant' => $request->all(),
        ], 200);
    }
}
