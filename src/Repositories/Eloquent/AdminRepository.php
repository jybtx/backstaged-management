<?php

namespace Jybtx\Backstaged\Repositories\Eloquent;

use Jybtx\Backstaged\Models\Admin;
use Prettus\Repository\Eloquent\BaseRepository;

class AdminRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Admin::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot(){}
}