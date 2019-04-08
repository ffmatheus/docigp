<?php

namespace App\Data\Models;

use FontLib\Table\Type\name;
use OwenIt\Auditing\Auditable;
use App\Data\Traits\Selectable;
use Illuminate\Notifications\Notifiable;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class User extends Authenticatable implements AuditableContract
{
    use Notifiable, Auditable, Selectable, HasRolesAndAbilities;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'username','congressman_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['roles', 'abilities', 'roles_string'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return array
     */
    public function getJoins()
    {
        return coollect($this->joins);
    }

    public function getRolesAttribute()
    {
        return $this->roles();
    }

    public function getAbilitiesAttribute()
    {
        return $this->abilities();
    }

    public function getRolesStringAttribute()
    {
        $string = '';

        $array = $this->getRoles();

        foreach ($array as $role) {
            if (!($role === end($array))) {
                $string .= $role . ' ';
            } else {
                $string .= $role . ', ';
            }
        }
        return $string;
    }
}
