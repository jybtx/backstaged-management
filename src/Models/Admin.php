<?php

namespace Jybtx\Backstaged\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

	use Notifiable;

    const IS_YES = 1; // 是
    const IS_NO  = 0; // 否

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'role_id', 'is_ban','telphone', 'password', 'avatar', 'remember_token'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
    /**
     * 管理员列表頁顯示
     * @author jybtx
     * @date   2019-11-30
     * @param  [type]     $key [description]
     * @return boolean         [description]
     */
    public function isShowList( $key = null )
    {
        $array = [
            self::IS_YES  => '<div class="badge badge-outline-success">是</div>',
            self::IS_NO   => "<div class='badge badge-outline-danger'>否</div>",
        ];
        if( $key !== null )
        {
            return array_key_exists($key, $array ) ? $array[$key] : $array[self::IS_YES];
        }
        return $array;
    }
    public function isSetStatus( $key = null )
    {
        $array = [
            self::IS_YES  => '是',
            self::IS_NO   => '否',
        ];
        if( $key !== null )
        {
            return array_key_exists($key, $array ) ? $array[$key] : $array[self::IS_YES];
        }
        return $array;
    }
}