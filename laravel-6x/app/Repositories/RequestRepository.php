<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\RequestModel;

class RequestRepository extends BaseRepository
{
    public function getModel()
    {
        return RequestModel::class;
    }
}
