<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendMqtt extends Model
{
    use HasFactory;

    const SIGN_KEY = 'CVND=WINWIN';

    protected $fillable = [
        'client_id',
        'host',
        'imei',
        'password',
        'port',
        'publish_topic',
        'subscribe_topic_prefix',
        'username',
        'vend_code',
        'version',
    ];
}
