<?php

namespace App\Http\Controllers;

use phpseclib\Crypt\RSA;

class RSAController extends Controller
{
    public function encryption(String $plain_text)
    {
        $rsa = new RSA();
        $rsa->loadKey(env('PUBLIC_KEY'));
        $encrypted_message = $rsa->encrypt($plain_text);

        return base64_encode($encrypted_message);
    }

    public function decryption(String $encrypted_message)
    {
        $rsa = new RSA();
        $rsa->loadKey(env('PRIVATE_KEY'));
        $decrypted_message = $rsa->decrypt(base64_decode($encrypted_message));

        return $decrypted_message;
    }
}
