<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MqttSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'host',
        'password',
        'port',
        'publish_topic',
        'subscribe_topic_prefix',
        'username',
    ];
}
