<?php

namespace Jybtx\Backstaged\Repositories\Eloquent;

use Jybtx\Backstaged\Models\Permission;
use Prettus\Repository\Eloquent\BaseRepository;

class PermissionRepository extends  BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot(){}
}