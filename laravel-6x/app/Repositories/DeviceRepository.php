<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Device;

class DeviceRepository extends BaseRepository
{
    public function getModel()
    {
        return Device::class;
    }
}
