<?php

namespace App\Infrastructure\Persistence\Eloquent;

use Illuminate\Database\Eloquent\Model;

class EloquentServiceInstance extends Model
{
    protected $table = 'service_instances';

    protected $fillable = [
        'id',
        'service_name',
        'host',
        'port',
        'protocol',
        'status',
        'last_heartbeat_at',
    ];

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'port' => 'integer',
        'last_heartbeat_at' => 'datetime',
    ];
}