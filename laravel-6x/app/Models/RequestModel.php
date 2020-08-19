<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    public $timestamps = false;
    protected $table = 'requests';
    protected $fillable = ['user_id', 'reason', 'status', 'approved_at', 'leader_id'];
    protected $primaryKey = 'id';
}
