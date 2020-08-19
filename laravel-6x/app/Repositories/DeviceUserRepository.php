<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\DeviceUser;

class DeviceUserRepository extends BaseRepository
{
    public function getModel()
    {
        return DeviceUser::class;
    }
}
