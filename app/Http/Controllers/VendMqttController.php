<?php

namespace App\Http\Controllers;

use App\Models\DataLog;
use App\Models\VendMqtt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VendMqttController extends Controller
{
    public function create(Request $request)
    {
        DataLog::create([
            'content' => $request->all(),
        ]);

        $vendMqtt = VendMqtt::where('imei', $request->imei)->first();

        if(!$vendMqtt) {
            throw new \Exception('IMEI not found');
        }
        Log::info('IMEI:'.$request->imei.','.$vendMqtt->id);

        $localString = sprintf(
            "IMEI=%s&Timestamp=%s&Version=%s&%s",
            $request->IMEI,
            $request->Timestamp,
            $request->Version,
            VendMqtt::SIGN_KEY
        );
        $localSignedString = strtolower(md5($localString));
        Log::info('Local:'.$localSignedString);
        $vendSignedString = strtolower($request->Sign);
        Log::info('Incoming:'.$vendSignedString);
        if($localSignedString !== $vendSignedString) {
            Log::info('failed');
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
