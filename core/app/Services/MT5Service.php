<?php

namespace App\Services;
use App\MT5\MTWebAPI;
use App\MT5\MTRetCode;
use App\MT5\MTEnDealAction;
use App\Models\Mt5_account;
class MT5Service
{
    protected $api;

    public function __construct(MTWebAPI $api)
    {
        $this->api = $api;
    }

    public function connect($id)
    {
        
        $error = '';
         $settings = Mt5_account::where('id',$id)->first();
        
        $this->api->SetLoggerWriteDebug(config('constants.IS_WRITE_DEBUG_LOG'));
        if (!$this->api->IsConnected()) {
            $error = $this->api->Connect(
                $settings->mt5_server_ip,
                $settings->mt5_server_port,
                26000,
                $settings->mt5_server_web_login,
                $settings->mt5_server_web_password
            );
        }
        return $error;
    }
    public function getApi()
    {
        return $this->api;
    }
}
