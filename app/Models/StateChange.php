<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateChange extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'message_id',
    ];

    private function _json_message()
    {
        return json_encode(array(   "uuid"=>$this->statemessage->uuid,
        "timestamp"=>$this->updated_at));
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function statemessage()
    {
        return $this->belongsTo(StateMessage::class, 'message_id');
    }

    public function getJsonAttribute()
    {
        return $this->_json_message();
    }

    public function getSignatureAttribute()
    {
        $hex_signature = "";
        $privkeytext = file_get_contents(env('CRYPTO_WEB_PRIV_KEY', ""));
        $pkeyid = openssl_pkey_get_private($privkeytext);
        $isotimestamp = date("c");
        if ($pkeyid){
            // compute signature
            openssl_sign($this->_json_message(), $signature, $pkeyid,OPENSSL_ALGO_SHA256);
            $hex_signature = bin2hex($signature);
            // free the key from memory
            openssl_free_key($pkeyid);               
        }
        return $hex_signature;
    }

    public function getSecuredMessageAttribute(){
        $message = env('CRYPTO_WEB_BASE_URL','')."?message=".urlencode($this->_json_message())."&signature=".urlencode($this->getSignatureAttribute());
        return $message;
    }
    public function getSecuredMessageVerificationAttribute(){
        $message = env('CRYPTO_WEB_BASE_URL','')."?message=".urlencode($this->_json_message())."&signature=".urlencode($this->getSignatureAttribute());
        return $message;
    }
}
