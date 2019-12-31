<?php

namespace Jybtx\Backstaged\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pid', 'name', 'icon', 'controller', 'url','active', 'description', 'sort', 'active_model'
    ];
}
