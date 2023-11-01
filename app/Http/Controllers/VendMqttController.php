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
            'ip_address' => $request->ip(),
            'content' => $request->all(),
        ]);

        $vendMqtt = VendMqtt::query()
            ->with([
                'mqttSetting'
            ])
            ->where('imei', $request->IMEI)
            ->first();


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
            Log::info('failed');
            throw new \Exception('Invalid Sign');
        }
        $vendMqtt->update([
            'version' => $request->Version,
        ]);

        $result = [
            'data' => [
                'ClientID' => Carbon::now()->timestamp.$vendMqtt->vend_code,
                'Host' => $vendMqtt->mqttSetting->host,
                'Password' => $vendMqtt->mqttSetting->password,
                'Port' => $vendMqtt->mqttSetting->port,
                'PublishTopic' => $vendMqtt->mqttSetting->publish_topic,
                'ServerTime' => Carbon::now()->toDateTimeString(),
                'SubscribeTopic' => $vendMqtt->mqttSetting->subscribe_topic_prefix,
                'UserName' => $vendMqtt->mqttSetting->username,
                'payment_gateway_menu_url' => $vendMqtt->mqttSetting->payment_gateway_menu_url,
                'refund_request_form_url' => $vendMqtt->mqttSetting->refund_request_form_url ? $vendMqtt->mqttSetting->refund_request_form_url.'?vendID='.$vendMqtt->vend_code : '',
                'delivery_complaint_form_url' => $vendMqtt->mqttSetting->delivery_complaint_form_url ? $vendMqtt->mqttSetting->delivery_complaint_form_url.'?vendID='.$vendMqtt->vend_code : '',
            ],
            'error_code' => 0,
            'error_msg' => 'success',
        ];

//http {"data":{"ClientID":"869300039346675","Host":"lg.vendertec.top","Password":"zhouwenjing","Port":"61613","PublishTopic":"CV0","ServerTime":"2019-06-13 20:41:41","SubscribeTopic":"CM","UserName":"cvnd"},"error_code":0,"error_msg":"success"
        return $result;
    }
}
