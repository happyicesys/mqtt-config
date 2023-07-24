<?php


$SignHttpKey="CVND=WINWIN"

public function getcfg($IMEI="",$Timestamp="0",$Version="0",$Sign="",$SignHttpKey="CVND=WINWIN")
{

        if($IMEI=="")
        {
            exit(0);
        }
        $sign_string = sprintf("IMEI=%s&Timestamp=%s&Version=%s&%s",$IMEI,$Timestamp,$Version,$SignHttpKey);
        $Sign=strtolower($Sign);
        $strSign=strtolower(md5($sign_string));

//http {"data":{"ClientID":"869300039346675","Host":"lg.vendertec.top","Password":"zhouwenjing","Port":"61613","PublishTopic":"CV0","ServerTime":"2019-06-13 20:41:41","SubscribeTopic":"CM","UserName":"cvnd"},"error_code":0,"error_msg":"success"

        if($strSign!=$Sign)
        {

            echo json_encode($this->getresult(1,"Invalid Sign"));
            exit(0);
        }

        $m= Mqttcfg::where("imei",$IMEI)->find();

        if(!$m)
        {
            echo json_encode($this->getresult(2,"Not exsist"));
            exit(0);
        }
}