<?php

namespace Jybtx\Backstaged\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'menu_id', 'authority'
    ];
    public $timestamps = false;
}
