<?php

namespace Database\Seeders;

use App\Models\MqttSetting;
use App\Models\VendMqtt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MqttSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mqttSingapore = MqttSetting::create([
            'name' => 'Singapore',
            'host' => 'mqtt.happyice.net',
            'password' => 'happy888',
            'port' => '1883',
            'publish_topic' => 'CV0',
            'subscribe_topic_prefix' => 'CM',
            'username' => 'happyice',
        ]);

        $mqttIndonesia = MqttSetting::create([
            'name' => 'Indonesia',
            'host' => 'idn-mqtt.happyice.net',
            'password' => 'happy888',
            'port' => '1883',
            'publish_topic' => 'CV0',
            'subscribe_topic_prefix' => 'CM',
            'username' => 'happyice',
        ]);

        $vendmqtts = VendMqtt::all();

        foreach($vendmqtts as $vendmqtt) {
            if($vendmqtt->host == $mqttSingapore->host) {
                $vendmqtt->mqtt_setting_id = $mqttSingapore->id;
            } else if($vendmqtt->host == $mqttIndonesia->host) {
                $vendmqtt->mqtt_setting_id = $mqttIndonesia->id;
            }
            $vendmqtt->save();
        }
    }
}
