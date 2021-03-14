<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
        'validity_s',
    ];

    private function _json_message()
    {
        return json_encode(array(   "uuid"=>$this->statemessage->uuid,
        "updated_at"=>$this->updated_at,
        "timestamp"=>gmdate(\DateTime::ATOM)));
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
        $privkeytext = file_get_contents(env('CRYPTO_WEB_PRIV_KEY', dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'private'.DIRECTORY_SEPARATOR.'privkey.pem'));
        $pkeyid = openssl_pkey_get_private($privkeytext);
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

    public static function isActive(StateChange $_state){
        $now = new Carbon;
       return ($_state->created_at->addSeconds($_state->validity_s) >= $now);
    }

    public static function latest_active(){
        
        $latest = self::latest()->first();
        if (self::isActive($latest) || ( $latest->statemessage->uuid != env('TMA_INACTIVE_UUID',"42917626-92c7-4f16-a5e0-6fab087f42b5"))){       //Only "TMA Inactive expires"
            return $latest;
        }else{
            return self::find(1); //See README.md first state created was "TMA Active"
        }
    }
}
