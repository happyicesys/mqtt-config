<?php

namespace App\Jobs;

use App\Models\VendMqtt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SyncVend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vends;

    /**
     * Create a new job instance.
     */
    public function __construct($vends)
    {
        $this->vends = $vends;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($vends as $vend) {
            VendMqtt::create([
                'client_id' => $vend['client_id'],
                'host' => $vend['host'],
                'imei' => $vend['imei'],
                'password' => $vend['password'],
                'port' => $vend['port'],
                'publish_topic' => $vend['publish_topic'],
                'subscribe_topic_prefix' => $vend['subscribe_topic_prefix'],
                'username' => $vend['username'],
                'vend_code' => $vend['vend_code'],
                'version' => $vend['version'],
            ]);
        }
    }
}
