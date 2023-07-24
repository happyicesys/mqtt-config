<?php

namespace App\Http\Controllers;

use App\Models\DataLog;
use App\Models\VendMqtt;
use Illuminate\Http\Request;

class VendMqttController extends Controller
{
    public function validate(Request $request)
    {
        DataLog::create([
            'content' => $request->all()
        ]);
        // if(!VendMqtt::where('imei', $request->imei)->first()) {
        //     throw new \Exception('IMEI not found');
        // }

        // $localString = sprintf(
        //     "IMEI=%s&Timestamp=%s&Version=%s&%s",
        //     $request->IMEI,
        //     $request->Timestamp,
        //     $request->Version,
        //     VendMqtt::SIGN_KEY
        // );
        // $localSignedString = strtolower(md5($localString));

        // $vendSignedString = strtolower($request->Sign);

        // if($localSignedString !== $vendSignedString) {
        //     throw new \Exception('Invalid Sign');
        // }

        return true;
    }
}
