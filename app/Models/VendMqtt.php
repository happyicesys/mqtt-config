<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendMqtt extends Model
{
    use HasFactory;

    const SIGN_KEY = 'CVND=WINWIN';

    const ERROR_BAD_REQUEST = 400;
    const ERROR_UNAUTHORIZED = 401;
    const ERROR_FORBIDDEN = 403;
    const ERROR_NOT_FOUND = 404;
    const ERROR_METHOD_NOT_ALLOWED = 405;
    const ERROR_REQUEST_TIMEOUT = 408;
    const ERROR_CONFLICT = 409;
    const ERROR_INTERNAL_SERVER_ERROR = 500;
    const ERROR_NOT_IMPLEMENTED = 501;
    const ERROR_SERVICE_UNAVAILABLE = 503;

    const ERRORS_MAPPING = [
        self::ERROR_BAD_REQUEST => 'Bad Request, Parameter Incomplete',
        self::ERROR_UNAUTHORIZED => 'Unauthorized, Invalid Sign',
        self::ERROR_FORBIDDEN => 'Forbidden',
        self::ERROR_NOT_FOUND => 'IMEI not found',
        self::ERROR_METHOD_NOT_ALLOWED => 'Method Not Allowed',
        self::ERROR_REQUEST_TIMEOUT => 'Request Timeout',
        self::ERROR_CONFLICT => 'Conflict',
        self::ERROR_INTERNAL_SERVER_ERROR => 'Internal Server Error',
        self::ERROR_NOT_IMPLEMENTED => 'Not Implemented',
        self::ERROR_SERVICE_UNAVAILABLE => 'Service Unavailable',
    ];


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

    public function mqttSetting()
    {
        return $this->belongsTo(MqttSetting::class);
    }
}
