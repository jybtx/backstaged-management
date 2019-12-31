<?php

namespace Jybtx\Backstaged\Repositories\Eloquent;

use Jybtx\Backstaged\Models\Menu;
use Prettus\Repository\Eloquent\BaseRepository;

class MenuRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot(){}
}