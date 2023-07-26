<?php

namespace App\Http\Controllers;

use App\Models\DataLog;
use App\Models\VendMqtt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VendMqttController extends Controller
{
    public function create(Request $request)
    {
        $vendMqtt = VendMqtt::where('imei', $request->imei)->first();
        if(!$vendMqtt) {
            throw new \Exception('IMEI not found');
        }

        $localString = sprintf(
            "IMEI=%s&Timestamp=%s&Version=%s&%s",
            $request->IMEI,
            $request->Timestamp,
            $request->Version,
            VendMqtt::SIGN_KEY
        );
        $localSignedString = strtolower(md5($localString));

        $vendSignedString = strtolower($request->Sign);

        if($localSignedString !== $vendSignedString) {
            throw new \Exception('Invalid Sign');
        }
        $vendMqtt->update([
            'version' => $request->Version,
        ]);

        $result = [
            'data' => [
                'ClientID' => Carbon::now()->timestamp.$vendMqtt->vend_code,
                'Host' => $vendMqtt->host,
                'Password' => $vendMqtt->password,
                'Port' => $vendMqtt->port,
                'PublishTopic' => $vendMqtt->publish_topic,
                'ServerTime' => Carbon::now()->toDateTimeString(),
                'SubscribeTopic' => $vendMqtt->subscribe_topic_prefix,
                'UserName' => $vendMqtt->username,
            ],
            'error_code' => 0,
            'error_msg' => 'success',
        ];

//http {"data":{"ClientID":"869300039346675","Host":"lg.vendertec.top","Password":"zhouwenjing","Port":"61613","PublishTopic":"CV0","ServerTime":"2019-06-13 20:41:41","SubscribeTopic":"CM","UserName":"cvnd"},"error_code":0,"error_msg":"success"
        return $result;
    }
}
