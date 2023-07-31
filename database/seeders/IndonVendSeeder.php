<?php

namespace Database\Seeders;

use App\Models\VendMqtt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndonVendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vends = [];

        for($i = 10001; $i <= 10100; $i++) {
            $vends[] = [
                'imei' => '1234567898' . $i,
                'vend_code' => $i,
            ];
        }

        foreach($vends as $vend) {
            VendMqtt::create([
                'host' => 'idn-mqtt.happyice.net',
                'imei' => $vend['imei'],
                'vend_code' => $vend['vend_code'],
                'username' => 'happyice',
                'password' => 'happy888',
                'port' => '1883',
                'publish_topic' => 'CV0',
                'subscribe_topic_prefix' => 'CM',
            ]);
        }
    }
}
