<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function encryption(Request $request)
    {
        $rsa = new RSAController();

        return response()->json(array(
            'message' => $rsa->encryption($request->data)
        ),200);
    }

    public function decryption(Request $request)
    {
        $rsa = new RSAController();

        return response()->json(array(
            'message' => $rsa->decryption($request->data)
        ),200);
    }
}
