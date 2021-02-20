<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StateMessage;
use App\Models\StateChange;

class TMAStateViewOnlyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return view('tmastateviewonly.show', ['state_change'=> StateChange::latest()->first()]);
    }

    public function securedMessage(Request $request)
    {
        return response()
                ->view('tmastateviewonly.securedmessage', ['state_change'=> StateChange::latest()->first()])
                ->header('Content-Type', 'application/javascript');
    }

    public function isSgnatureValid($message,$signature)
    {
        $binSignature = hex2bin($signature);
        $certtext = file_get_contents(env('CRYPTO_WEB_CERT', ""));
        $public_key_pem = openssl_pkey_get_public($certtext);
        $r = openssl_verify($message, $binSignature, $public_key_pem,OPENSSL_ALGO_SHA256);

        if ($r == 1)
        {
            return true;
        }
        return false;
    }

    public function checkSecuredMessage(Request $request)
    {
        if ($this->isSgnatureValid($request->message,$request->signature))
        {
            return response("OK");
        }
        return response("NOK");
    }
}
