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
        return view('tmastateviewonly.show', ['state_change'=> StateChange::latest_active()]);
    }

    public function securedMessage(Request $request)
    {
        return response()
                ->view('tmastateviewonly.securedmessage', ['state_change'=> StateChange::latest_active()])
                ->header('Content-Type', 'application/javascript');
    }

    public function isSgnatureValid($message,$signature)
    {
        $binSignature = hex2bin($signature);
        $certtext = file_get_contents(env('CRYPTO_WEB_CERT', dirname(__FILE__).'/../../../storage/private/cert.pem'));
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
        $decoded_message = json_decode($request->message);
        $message_date = \DateTime::createFromFormat(\DateTime::ATOM, $decoded_message->timestamp);
        $now = new \DateTime();
        $message_date_diff = abs($now->getTimestamp() - $message_date->getTimestamp());

        if ( ($this->isSgnatureValid($request->message,$request->signature)) && ($message_date_diff < env("CRYPTO_MAX_SKEW_SECONDS")) )
        {
            return response("OK");
        }
        return response("NOK");
    }
}
