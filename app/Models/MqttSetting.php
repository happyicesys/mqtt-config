<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MqttSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_complaint_form_url',
        'name',
        'host',
        'password',
        'port',
        'publish_topic',
        'refund_request_form_url',
        'subscribe_topic_prefix',
        'username',
    ];
}
