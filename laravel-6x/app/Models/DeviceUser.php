<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceUser extends Model
{
    public $timestamps = false;
    protected $table = 'device_users';
    protected $fillable = ['user_id', 'device_id', 'request_id', 'handover_at', 'released_at'];
    protected $primaryKey = 'id';
    /**
     * @var mixed
     */
}
